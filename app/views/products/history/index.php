<link rel="stylesheet" href="app/views/products/history/styles.css">

<main class="purchase-history">
  <!-- =====================================================
       CABEÇALHO DA PÁGINA ("Histórico de Compras")
  ====================================================== -->
  <div class="purchase-history_header">
    <h1 class="history-header">
      <i class="ph ph-clock-counter-clockwise"></i> Histórico de Compras
    </h1>
    <span class="history-count">3 pedidos</span>
  </div>

  <!-- =====================================================
       LISTA DE COMPRAS
  ====================================================== -->
  <section class="history-list">

    <!-- =====================================================
         PEDIDO 1 — ENTREGUE
    ====================================================== -->
    <div class="history-item">
      <!-- Cabeçalho -->
      <div class="history-number">
        <p>Pedido: - 05/07/2025</p>

        <button class="history-btn">
          <span>Ver Detalhes</span>
          <i class="ph ph-caret-right"></i>
        </button>
      </div>

      <!-- Pagamento -->
      <div class="history-payment">
        <i class="ph ph-cardholder"></i>
        Pagamento via cartão de crédito (Mastercard)
      </div>

      <!-- Detalhes -->
      <div class="history-details">
        <div class="history-details-info">
          <img src="public/images/conjunto-fit.jpg" alt="Legging Fitness">
          <div class="history-texts">
            <p>Legging Premium Preta</p>
            <p>Vendido por: FITSTORE</p>
            <p>Entregue por: SEDEX</p>
            <p>Qtd: 1</p>
          </div>
        </div>

        <div class="history-status history-status--delivered">
          <i class="ph ph-check-circle"></i>
          Pedido entregue em 10/07/2025
        </div>
      </div>
    </div>

    <!-- =====================================================
         PEDIDO 2 — CANCELADO
    ====================================================== -->
    <div class="history-item">
      <div class="history-number">
        <p>Pedido: 12/07/2025</p>
        <button class="history-btn">
          <span>Ver Detalhes</span>
          <i class="ph ph-caret-right"></i>
        </button>
      </div>

      <div class="history-payment">
        <i class="ph ph-pix-logo"></i>
        Pagamento via PIX
      </div>

      <div class="history-details">
        <div class="history-details-info">
          <img src="public/images/conjunto-fit.jpg" alt="Top Fitness">
          <div class="history-texts">
            <p>Top Fitness Rosa</p>
            <p>Vendido por: TATIFITWEAR</p>
            <p>Entregue por: Transportadora Express</p>
            <p>Qtd: 2</p>
          </div>
        </div>

        <div class="history-status history-status--canceled">
          <i class="ph ph-x-circle"></i>
          Pedido cancelado
        </div>
      </div>
    </div>

    <!-- =====================================================
         PEDIDO 3 — ENTREGUE RECENTEMENTE
    ====================================================== -->
    <div class="history-item">
      <div class="history-number">
        <p>Pedido: - 20/07/2025</p>
        <button class="history-btn">
          <span>Ver Detalhes</span>
          <i class="ph ph-caret-right"></i>
        </button>
      </div>

      <div class="history-payment">
        <i class="ph ph-cardholder"></i>
        Pagamento via cartão de crédito (Visa)
      </div>

      <div class="history-details">
        <div class="history-details-info">
          <img src="public/images/shorts-fit.jpg" alt="Shorts Fitness">
          <div class="history-texts">
            <p>Shorts Fitness Azul</p>
            <p>Vendido por: MOVEFIT</p>
            <p>Entregue por: SEDEX</p>
            <p>Qtd: 1</p>
          </div>
        </div>

        <div class="history-status history-status--delivered">
          <i class="ph ph-check-circle"></i>
          Pedido entregue em 25/07/2025
        </div>
      </div>
    </div>

  </section>
</main>
