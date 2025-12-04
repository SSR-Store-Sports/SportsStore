<?php
require 'config/database.php';

if (empty($_SESSION['user_id'])) {
  echo "<script>alert('Você precisa estar logado.'); window.location.href = '/auth/login';</script>";
  exit();
}

$userId = $_SESSION['user_id'];

$stmt = $db->prepare("
  SELECT 
    o.id, o.total_price, o.status, o.date_creation,
    p.payment_method, p.transaction_code,
    COUNT(oi.id) as total_items
  FROM tatifit_orders o
  LEFT JOIN tatifit_payments p ON o.id = p.order_id
  LEFT JOIN tatifit_order_items oi ON o.id = oi.order_id
  WHERE o.user_id = :user_id
  GROUP BY o.id
  ORDER BY o.date_creation DESC
");
$stmt->execute([':user_id' => $userId]);
$orders = $stmt->fetchAll();

function getStatusInfo($status) {
  switch($status) {
    case 'Pendente': return ['icon' => 'ph-clock', 'text' => 'Aguardando processamento', 'class' => 'status-pending'];
    case 'Em Processamento': return ['icon' => 'ph-package', 'text' => 'Preparando pedido', 'class' => 'status-processing'];
    case 'Enviado': return ['icon' => 'ph-truck', 'text' => 'Em transporte', 'class' => 'status-shipped'];
    case 'Entregue': return ['icon' => 'ph-check-circle', 'text' => 'Entregue', 'class' => 'status-delivered'];
    case 'Cancelado': return ['icon' => 'ph-x-circle', 'text' => 'Cancelado', 'class' => 'status-cancelled'];
    default: return ['icon' => 'ph-question', 'text' => $status, 'class' => 'status-unknown'];
  }
}
?>

<link rel="stylesheet" href="app/views/products/follow-up/styles.css">

<main class="orders-tracking">
  <div class="orders-tracking_header">
    <h1 class="orders-header">
      <i class="ph ph-shopping-bag-open"></i> Meus Pedidos
    </h1>
    <span class="orders-count"><?= count($orders) ?> pedido(s)</span>
  </div>

  <section class="orders-list">
    <?php if (empty($orders)): ?>
      <div class="empty-orders">
        <i class="ph ph-shopping-bag"></i>
        <h3>Nenhum pedido encontrado</h3>
        <p>Você ainda não fez nenhum pedido.</p>
        <a href="/produtos" class="btn-shop">Continuar Comprando</a>
      </div>
    <?php else: ?>
      <?php foreach ($orders as $order): ?>
        <?php 
          $statusInfo = getStatusInfo($order['status']);
          $orderNumber = 'PED' . str_pad($order['id'], 6, '0', STR_PAD_LEFT);
          $orderDate = date('d/m/Y', strtotime($order['date_creation']));
          
          // Buscar itens do pedido (fallback para stock_id = 1)
          $itemsStmt = $db->prepare("
            SELECT oi.quantity, oi.unit_price, 
                   COALESCE(p.name, 'Produto') as name, 
                   COALESCE(p.url_image, '/public/images/product.jpg') as url_image
            FROM tatifit_order_items oi
            LEFT JOIN tatifit_stocks s ON oi.stock_id = s.id
            LEFT JOIN tatifit_products p ON s.products_id = p.id
            WHERE oi.order_id = :order_id
          ");
          $itemsStmt->execute([':order_id' => $order['id']]);
          $items = $itemsStmt->fetchAll();
        ?>
        
        <div class="follow-up-item">
          <div class="number-orders">
            <p>Pedido: <?= $orderNumber ?> - <?= $orderDate ?></p>
            <button class="tracking-btn" onclick="openOrderModal('<?= $orderNumber ?>', '<?= $orderDate ?>', '<?= number_format($order['total_price'], 2, ',', '.') ?>', '<?= $order['payment_method'] ?? 'N/A' ?>', '<?= $statusInfo['text'] ?>')">
              <span>Ver Detalhes</span>
              <i class="ph ph-caret-right"></i>
            </button>
          </div>

          <div class="payment-orders">
            <i class="ph ph-credit-card"></i>
            Pagamento via <?= ucfirst($order['payment_method'] ?? 'N/A') ?>
          </div>

          <div class="order-summary">
            <div class="order-total">
              <span>Total: R$ <?= number_format($order['total_price'], 2, ',', '.') ?></span>
              <span><?= $order['total_items'] ?> item(s)</span>
            </div>
            
            <div class="<?= $statusInfo['class'] ?>">
              <i class="ph <?= $statusInfo['icon'] ?>"></i>
              <?= $statusInfo['text'] ?>
            </div>
          </div>

          <?php if (!empty($items)): ?>
            <div class="order-items">
              <?php foreach (array_slice($items, 0, 2) as $item): ?>
                <div class="details-item">
                  <div class="details-item-info">
                    <img src="<?= htmlspecialchars($item['url_image'] ?? '/public/images/product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="details-texts">
                      <p><?= htmlspecialchars($item['name']) ?></p>
                      <p>Vendido por: TATIFITWEAR</p>
                      <p>Qtd: <?= $item['quantity'] ?></p>
                      <p>Preço: R$ <?= number_format($item['unit_price'], 2, ',', '.') ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              
              <?php if (count($items) > 2): ?>
                <div class="more-items">
                  <span>+ <?= count($items) - 2 ?> item(s) adicional(is)</span>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<!-- Modal -->
<div id="orderModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Detalhes do Pedido</h2>
      <span class="close" onclick="closeOrderModal()">&times;</span>
    </div>
    <div class="modal-body" id="modalBody">
      <!-- Conteúdo carregado via JS -->
    </div>
  </div>
</div>

<script>
function openOrderModal(orderNumber, orderDate, total, paymentMethod, status) {
  const modal = document.getElementById('orderModal');
  const modalBody = document.getElementById('modalBody');
  
  modalBody.innerHTML = `
    <div class="order-detail">
      <div class="detail-row">
        <span class="label">Número:</span>
        <span class="value">${orderNumber}</span>
      </div>
      <div class="detail-row">
        <span class="label">Data:</span>
        <span class="value">${orderDate}</span>
      </div>
      <div class="detail-row">
        <span class="label">Total:</span>
        <span class="value">R$ ${total}</span>
      </div>
      <div class="detail-row">
        <span class="label">Pagamento:</span>
        <span class="value">${paymentMethod}</span>
      </div>
      <div class="detail-row">
        <span class="label">Status:</span>
        <span class="value">${status}</span>
      </div>
    </div>
  `;
  
  modal.style.display = 'block';
}

function closeOrderModal() {
  document.getElementById('orderModal').style.display = 'none';
}

window.onclick = function(event) {
  const modal = document.getElementById('orderModal');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}
</script>
