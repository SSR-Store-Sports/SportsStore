<?php
require 'config/database.php';

// Verificar se usuário está logado
// if (empty($_SESSION['user_id'])) {
//     echo "<script>alert('Você precisa estar logado para acessar o carrinho.'); window.location.href = '/auth/login';</script>";
//     exit();
// }

// $userId = $_SESSION['user_id'];

// Iniciliza array de carrinho se estiver vazio
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adicionar produto ao carrinho
if (isset($_GET['produto'])) {
    $productId = (int)$_GET['produto'];

    // Verificar se produto existe
    $stmt = $db->prepare("SELECT id, name, price, url_image FROM tatifit_products WHERE id = :id AND status = 'Ativo'");
    $stmt->execute([':id' => $productId]);
    $product = $stmt->fetch();

    if ($product) {
        // Adicionar à sessão
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['url_image'],
                'quantity' => 1
            ];
        }
    }

    echo "<script>window.location.href = '/carrinho';</script>";
    exit();
}

// Remover produto do carrinho
if (isset($_POST['remove_product'])) {
    $productId = (int)$_POST['product_id'];
    unset($_SESSION['cart'][$productId]);
    echo "<script>window.location.href = '/carrinho';</script>";
    exit();
}

// Atualizar quantidade
if (isset($_POST['update_quantity'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0 && isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
    echo "<script>window.location.href = '/carrinho';</script>";
    exit();
}

// Buscar itens do carrinho
$cartItems = $_SESSION['cart'] ?? [];

// Calcular totais
$totalItems = 0;
$totalPrice = 0;

foreach ($cartItems as $item) {
    $totalItems += $item['quantity'];
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<link rel="stylesheet" href="/app/views/products/cart/styles.css">

<main class="cart-main">
    <div class="cart-header">
        <h1><i class="ph ph-shopping-cart"></i> Carrinho de compras</h1>
        <span class="cart-count"><?= $totalItems ?> produto(s)</span>
    </div>

    <div class="cart-content">
        <div class="cart-items">
            <?php if (empty($cartItems)): ?>
                <div class="empty-cart">
                    <i class="ph ph-shopping-cart"></i>
                    <h3>Seu carrinho está vazio</h3>
                    <p>Adicione produtos e eles aparecerão aqui</p>
                    <a href="/produtos" class="continue-shopping">Continuar comprando</a>
                </div>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <input type="checkbox" class="item-checkbox" checked>
                        <div class="item-image">
                            <img src="<?= htmlspecialchars($item['image'] ?? '/public/images/product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        </div>
                        <div class="item-details">
                            <a href="/produto?id=<?= $item['id'] ?>">
                                <h3><?= htmlspecialchars($item['name']) ?></h3>
                            </a>
                            <p class="item-brand">SportsStore</p>
                            <div class="item-badges">
                                <span class="badge-shipping">Frete grátis</span>
                            </div>
                            <div class="item-actions">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <button type="submit" name="remove_product" class="action-btn remove-btn">
                                        <i class="ph ph-trash"></i> Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="item-quantity">
                            <label>Quantidade:</label>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn" onclick="changeQuantity(<?= $item['id'] ?>, -1)">-</button>
                                <input type="number" name="quantity" class="quantity" value="<?= $item['quantity'] ?>" min="1" onchange="updateQuantity(<?= $item['id'] ?>, this.value)">
                                <button type="button" class="qty-btn" onclick="changeQuantity(<?= $item['id'] ?>, 1)">+</button>
                            </div>
                            <p class="stock-info">Disponível</p>
                        </div>
                        <div class="item-price">
                            <div class="price-info">
                                <div class="price-current">R$ <?= number_format($item['price'], 2, ',', '.') ?></div>
                                <div class="price-installments">Total: R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="cart-sidebar">
            <div class="cart-summary">
                <h2>Resumo da compra</h2>
                <div class="summary-line">
                    <span>Produtos (<?= $totalItems ?>)</span>
                    <span>R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
                </div>
                <div class="summary-line">
                    <span>Frete</span>
                    <span class="free-shipping">Grátis</span>
                </div>
                <div class="summary-line total">
                    <span>Total</span>
                    <span>R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
                </div>
                <?php if ($totalPrice > 0): ?>
                    <div class="installments-info">
                        <p>em até <strong>12x de R$ <?= number_format($totalPrice / 12, 2, ',', '.') ?></strong> sem juros</p>
                    </div>
                <?php endif; ?>
                <a href="/endereco" class="checkout-btn">
                    <i class="ph ph-credit-card"></i>
                    Finalizar compra
                </a>
                <div class="security-info">
                    <i class="ph ph-shield-check"></i>
                    <span>Compra 100% segura</span>
                </div>
            </div>

            <div class="shipping-calculator">
                <h3>Calcular frete</h3>
                <div class="cep-input">
                    <input type="text" placeholder="Digite seu CEP" maxlength="9">
                    <button class="calc-btn">Calcular</button>
                </div>
                <a target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php" class="cep-link">Não sei meu CEP</a>
            </div>
        </div>
    </div>
</main>

<script>
    function changeQuantity(productId, change) {
        const inputs = document.querySelectorAll('input[name="quantity"]');
        let targetInput = null;

        inputs.forEach(input => {
            const cartItem = input.closest('.cart-item');
            const hiddenInput = cartItem.querySelector('input[name="product_id"]');
            if (hiddenInput && hiddenInput.value == productId) {
                targetInput = input;
            }
        });

        if (targetInput) {
            const currentValue = parseInt(targetInput.value);
            const newValue = Math.max(1, currentValue + change);
            updateQuantity(productId, newValue);
        }
    }

    function updateQuantity(productId, quantity) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/carrinho';
        form.innerHTML = `
        <input type="hidden" name="product_id" value="${productId}">
        <input type="hidden" name="quantity" value="${quantity}">
        <input type="hidden" name="update_quantity" value="1">
    `;
        document.body.appendChild(form);
        form.submit();
    }
</script>

<style>
    .empty-cart {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-cart i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    .empty-cart h3 {
        margin: 1rem 0 0.5rem 0;
        color: #333;
    }

    .continue-shopping {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.8rem 1.5rem;
        background: var(--bg-tertiary);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: 0.3s;
    }

    .continue-shopping:hover {
        background: #c83f8d;
    }

    .price-total {
        font-weight: bold;
        color: var(--text-color-pink);
        margin-top: 0.5rem;
    }

    .quantity-form {
        display: inline;
    }
</style>