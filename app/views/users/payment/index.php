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

if (!$address) {
  echo "<script>alert('Cadastre um endereço primeiro.'); window.location.href = '/endereco';</script>";
  exit();
}

$cartItems = $_SESSION['cart'] ?? [];
$totalPrice = 0;
foreach ($cartItems as $item) {
  $totalPrice += $item['price'] * $item['quantity'];
}

if (empty($cartItems)) {
  echo "<script>alert('Carrinho vazio.'); window.location.href = '/carrinho';</script>";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process_payment'])) {
  $paymentMethod = $_POST['payment_method'] ?? '';
  
  if (empty($paymentMethod)) {
    $error = "Selecione um método de pagamento.";
  } else {
    try {
      $db->beginTransaction();
      
      $stmt = $db->prepare("INSERT INTO tatifit_orders (total_price, shipping_price, status, user_id, address_id) VALUES (:total_price, :shipping_price, :status, :user_id, :address_id)");
      $stmt->execute([
        ':total_price' => $totalPrice,
        ':shipping_price' => 0,
        ':status' => 'Pendente',
        ':user_id' => $userId,
        ':address_id' => $address['id']
      ]);
      
      $orderId = $db->lastInsertId();
      
      foreach ($cartItems as $item) {
        $stmt = $db->prepare("INSERT INTO tatifit_order_items (quantity, unit_price, order_id, stock_id) VALUES (:quantity, :unit_price, :order_id, :stock_id)");
        $stmt->execute([
          ':quantity' => $item['quantity'],
          ':unit_price' => $item['price'],
          ':order_id' => $orderId,
          ':stock_id' => 1
        ]);
      }
      
      $transactionCode = 'TXN' . date('Ymd') . $orderId . rand(100, 999);
      $stmt = $db->prepare("INSERT INTO tatifit_payments (transaction_code, status, payment_method, amount, order_id) VALUES (:transaction_code, :status, :payment_method, :amount, :order_id)");
      $stmt->execute([
        ':transaction_code' => $transactionCode,
        ':status' => 'Aprovado',
        ':payment_method' => $paymentMethod,
        ':amount' => $totalPrice,
        ':order_id' => $orderId
      ]);
      
      $stmt = $db->prepare("UPDATE tatifit_orders SET status = 'Em Processamento' WHERE id = :id");
      $stmt->execute([':id' => $orderId]);
      
      $db->commit();
      
      $_SESSION['last_order'] = [
        'id' => $orderId,
        'transaction_code' => $transactionCode,
        'total' => $totalPrice,
        'items' => $cartItems
      ];
      
      echo "<script>window.location.href = '/confirmacao';</script>";
      exit();
      
    } catch (Exception $e) {
      $db->rollback();
      $error = "Erro ao processar pagamento: " . $e->getMessage();
    }
  }
}
?>

<link rel="stylesheet" href="/app/views/users/payment/styles.css">

<body>
  <div class="payment-header">
    <div class="header-content">
      <h1><i class="ph ph-credit-card"></i> Pagamento</h1>
      <p>Escolha a forma de pagamento para finalizar sua compra</p>
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
      <div class="progress-step active">
        <div class="step-circle">3</div>
        <span>Pagamento</span>
      </div>
      <div class="progress-line"></div>
      <div class="progress-step">
        <div class="step-circle">4</div>
        <span>Confirmação</span>
      </div>
    </div>
  </div>

  <main class="payment-main">
    <section class="payment-content">
      <div class="payment-methods">
        <h2><i class="ph ph-wallet"></i> Método de Pagamento</h2>
        
        <form method="POST" id="paymentForm">
          <div class="payment-options">
            <label class="payment-option">
              <input type="radio" name="payment_method" value="pix" required>
              <div class="option-content">
                <div class="option-icon">
                  <i class="ph ph-qr-code"></i>
                </div>
                <div class="option-info">
                  <h3>PIX</h3>
                  <p>Pagamento instantâneo</p>
                </div>
                <div class="option-price">
                  R$ <?= number_format($totalPrice, 2, ',', '.') ?>
                </div>
              </div>
            </label>

            <label class="payment-option">
              <input type="radio" name="payment_method" value="credit" required>
              <div class="option-content">
                <div class="option-icon">
                  <i class="ph ph-credit-card"></i>
                </div>
                <div class="option-info">
                  <h3>Cartão de Crédito</h3>
                  <p>Em até 12x sem juros</p>
                  <span class="installments">12x de R$ <?= number_format($totalPrice / 12, 2, ',', '.') ?></span>
                </div>
                <div class="option-price">
                  R$ <?= number_format($totalPrice, 2, ',', '.') ?>
                </div>
              </div>
            </label>

            <label class="payment-option">
              <input type="radio" name="payment_method" value="debit" required>
              <div class="option-content">
                <div class="option-icon">
                  <i class="ph ph-bank"></i>
                </div>
                <div class="option-info">
                  <h3>Cartão de Débito</h3>
                  <p>Débito à vista</p>
                </div>
                <div class="option-price">
                  R$ <?= number_format($totalPrice, 2, ',', '.') ?>
                </div>
              </div>
            </label>
          </div>

          <?php if (isset($error)): ?>
            <div class="error-message">
              <i class="ph ph-warning"></i>
              <?= $error ?>
            </div>
          <?php endif; ?>

          <input type="hidden" name="process_payment" value="1">
          <button type="submit" class="btn-pay">
            <i class="ph ph-lock"></i>
            Finalizar Pagamento
          </button>
        </form>
      </div>
    </section>

    <section class="payment-summary">
      <div class="order-summary">
        <h2><i class="ph ph-receipt"></i> Resumo do Pedido</h2>
        
        <div class="summary-items">
          <?php foreach ($cartItems as $item): ?>
            <div class="summary-item">
              <img src="<?= htmlspecialchars($item['image'] ?? '/public/images/product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
              <div class="item-info">
                <h4><?= htmlspecialchars($item['name']) ?></h4>
                <span>Qtd: <?= $item['quantity'] ?></span>
              </div>
              <div class="item-price">
                R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="summary-totals">
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
            <span id="finalTotal">R$ <?= number_format($totalPrice, 2, ',', '.') ?></span>
          </div>
        </div>
      </div>

      <div class="delivery-info">
        <h3><i class="ph ph-truck"></i> Entrega</h3>
        <div class="address-summary">
          <p><strong><?= htmlspecialchars($address['recipient_name']) ?></strong></p>
          <p><?= htmlspecialchars($address['street']) ?>, <?= htmlspecialchars($address['number'] ?? 'S/N') ?></p>
          <p><?= htmlspecialchars($address['neighborhood']) ?> - <?= htmlspecialchars($address['city']) ?>/<?= htmlspecialchars($address['state']) ?></p>
          <p>CEP: <?= htmlspecialchars($address['cep']) ?></p>
        </div>
      </div>

      <div class="security-badges">
        <div class="badge">
          <i class="ph ph-shield-check"></i>
          <span>Compra Segura</span>
        </div>
        <div class="badge">
          <i class="ph ph-lock"></i>
          <span>SSL Certificado</span>
        </div>
      </div>
    </section>
  </main>

  <script>

  </script>
</body>