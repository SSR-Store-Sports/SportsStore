<?php
require 'config/database.php';

if (empty($_SESSION['user_id'])) {
  echo "<script>alert('Você precisa estar logado.'); window.location.href = '/auth/login';</script>";
  exit();
}

$userId = $_SESSION['user_id'];

$stmt = $db->prepare("SELECT * FROM tatifit_users_address WHERE user_id = :user_id LIMIT 1");
$stmt->execute([':user_id' => $userId]);
$address = $stmt->fetch();

// Buscar dados do último pedido
$lastOrder = $_SESSION['last_order'] ?? null;
if (!$lastOrder) {
  echo "<script>alert('Pedido não encontrado.'); window.location.href = '/carrinho';</script>";
  exit();
}

$orderNumber = 'PED' . str_pad($lastOrder['id'], 6, '0', STR_PAD_LEFT);
$orderDate = date('d/m/Y H:i');
$cartItems = $lastOrder['items'];
$totalPrice = $lastOrder['total'];

// Limpar carrinho e dados da sessão
$_SESSION['cart'] = [];
unset($_SESSION['last_order']);
?>

<link rel="stylesheet" href="/app/views/users/payment-confirmed/styles.css">

<body>
  <div class="confirmation-header">
    <div class="header-content">
      <h1><i class="ph ph-check-circle"></i> Pedido Confirmado!</h1>
      <p>Seu pagamento foi processado com sucesso</p>
    </div>

    <div class="checkout-progress">
      <div class="progress-step completed">
        <div class="step-circle"><i class="ph ph-check"></i></div>
        <span>Carrinho</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step completed">
        <div class="step-circle"><i class="ph ph-check"></i></div>
        <span>Endereço</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step completed">
        <div class="step-circle"><i class="ph ph-check"></i></div>
        <span>Pagamento</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step active">
        <div class="step-circle"><i class="ph ph-check"></i></div>
        <span>Confirmação</span>
      </div>
    </div>
  </div>

  <main class="confirmation-main">
    <section class="success-message">
      <div class="success-icon">
        <i class="ph ph-check-circle"></i>
      </div>
      <h2>Pagamento Aprovado!</h2>
      <p>Obrigado pela sua compra. Seu pedido foi confirmado e será processado em breve.</p>
      
      <div class="order-info">
        <div class="info-item">
          <span class="label">Número do Pedido:</span>
          <span class="value"><?= $orderNumber ?></span>
        </div>
        <div class="info-item">
          <span class="label">Código da Transação:</span>
          <span class="value"><?= $lastOrder['transaction_code'] ?></span>
        </div>
        <div class="info-item">
          <span class="label">Data do Pedido:</span>
          <span class="value"><?= $orderDate ?></span>
        </div>
        <div class="info-item">
          <span class="label">Total Pago:</span>
          <span class="value">R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
        </div>
      </div>

      <div class="action-buttons">
        <a href="/acompanhamento" class="btn-track">
          <i class="ph ph-magnifying-glass"></i>
          Acompanhar Pedido
        </a>
        <a href="/produtos" class="btn-continue">
          <i class="ph ph-shopping-bag"></i>
          Continuar Comprando
        </a>
      </div>
    </section>

    <section class="order-details">
      <div class="order-summary">
        <h3><i class="ph ph-package"></i> Resumo do Pedido</h3>
        
        <div class="items-list">
          <?php foreach ($cartItems as $item): ?>
            <div class="order-item">
              <img src="<?= htmlspecialchars($item['image'] ?? '/public/images/product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
              <div class="item-details">
                <h4><?= htmlspecialchars($item['name']) ?></h4>
                <span>Quantidade: <?= $item['quantity'] ?></span>
              </div>
              <div class="item-price">
                R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="order-total">
          <div class="total-line">
            <span>Subtotal:</span>
            <span>R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
          </div>
          <div class="total-line">
            <span>Frete:</span>
            <span class="free">Grátis</span>
          </div>
          <div class="total-line final">
            <span>Total:</span>
            <span>R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
          </div>
        </div>
      </div>

      <?php if ($address): ?>
      <div class="delivery-details">
        <h3><i class="ph ph-truck"></i> Entrega</h3>
        <div class="delivery-info">
          <p><strong><?= htmlspecialchars($address['recipient_name']) ?></strong></p>
          <p><?= htmlspecialchars($address['street']) ?>, <?= htmlspecialchars($address['number'] ?? 'S/N') ?></p>
          <p><?= htmlspecialchars($address['neighborhood']) ?> - <?= htmlspecialchars($address['city']) ?>/<?= htmlspecialchars($address['state']) ?></p>
          <p>CEP: <?= htmlspecialchars($address['cep']) ?></p>
          <div class="delivery-time">
            <i class="ph ph-clock"></i>
            <span>Prazo de entrega: 3-5 dias úteis</span>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </section>
  </main>
</body>