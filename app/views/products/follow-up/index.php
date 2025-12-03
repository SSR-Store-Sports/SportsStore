<link rel="stylesheet" href="app/views/products/follow-up/styles.css">

<main class="orders-tracking">
  <!-- =====================================================
       CABEÇALHO DA PÁGINA ("Meus Pedidos")
  ====================================================== -->
  <div class="orders-tracking_header">
    <h1 class="orders-header">
      <i class="ph ph-shopping-bag-open"></i> Meus Pedidos
    </h1>
    <span class="orders-count">2 produtos</span>
  </div>

  <!-- =====================================================
       LISTA DE PEDIDOS
  ====================================================== -->
  <section class="orders-list">

    <!-- =====================================================
         PEDIDO 1
    ====================================================== -->
    <div class="follow-up-item">

      <!-- Cabeçalho do pedido -->
      <div class="number-orders">
        <p>Pedido: #001 - 07/07/2025</p>

        <!-- Botão: Gerenciar pedido
        <button class="tracking-btn">
          <i class="ph ph-shopping-cart"></i>
          <span>Gerenciar Pedido</span>
        </button>-->

        <!-- Botão: Ver detalhes -->
        <button class="tracking-btn">
          <span>Ver Detalhes</span>
          <i class="ph ph-caret-right"></i>
        </button>
      </div>

      <!-- Informações de pagamento -->
      <div class="payment-orders">
        <i class="ph ph-cardholder"></i>
        Pagamento via cartão de crédito
      </div>

      <!-- Detalhes do item -->
      <div class="details-item">
        <div class="details-item-info">
          <img src="public/images/conjunto-fit.jpg" alt="Conjunto Academia">
          <div class="details-texts">
            <p>Top Premium</p>
            <p>Vendido por: TATIFITWEAR</p>
            <p>Entregue por: SEDEX</p>
            <p>Qtd: 1</p>
          </div>
        </div>

        <div class="product-status">
          <i class="ph ph-warning"></i>
          Pedido a ser enviado!
        </div>
      </div>
    </div>

    <!-- =====================================================
         PEDIDO 2
    ====================================================== -->
    <div class="follow-up-item">

      <!-- Cabeçalho do pedido -->
      <div class="number-orders">
        <p>Pedido: #002 - 15/07/2025</p>

        <!-- Botão: Gerenciar pedido 
        <button class="tracking-btn">
          <i class="ph ph-shopping-cart"></i>
          <span>Gerenciar Pedido</span>
        </button>-->

        <!-- Botão: Ver detalhes -->
        <button class="tracking-btn">
          <span>Ver Detalhes</span>
          <i class="ph ph-caret-right"></i>
        </button>
      </div>

      <!-- Informações de pagamento -->
      <div class="payment-orders">
        <i class="ph ph-cardholder"></i>
        Pagamento via PIX
      </div>

      <!-- Detalhes do item -->
      <div class="details-item">
        <div class="details-item-info">
          <img src="public/images/shorts-fit.jpg" alt="Legging Fitness">
          <div class="details-texts">
            <p>Top Premium</p>
            <p>Vendido por: TATIFITWEAR</p>
            <p>Entregue por: SEDEX</p>
            <p>Qtd: 2</p>
          </div>
        </div>

        <div class="status-transporte">
          <i class="ph ph-truck"></i>
          Pedido em transporte!
        </div>
      </div>
    </div>

  </section>
</main>
