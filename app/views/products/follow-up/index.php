<link rel="stylesheet" href="app/views/products/follow-up/styles.css">

<main class="orders-tracking">
  <!-- Cabeçalho da página -->
  <div class="orders-tracking__header">
    <h1>
      <i class="ph ph-shopping-bag-open"></i> Meus Pedidos
    </h1>
  </div>

  <!-- Lista de pedidos -->
  <section class="orders-list">
    <!-- Item individual de acompanhamento de pedido -->
    <div class="follow-up-item">
      
      <!-- Cabeçalho do pedido -->
      <div class="number-orders">
        <p>Pedido: XXX - 07/07/2025</p>

        <!-- Botão: Gerenciar pedido (com ícone/imagem ilustrativa) -->
        <button class="tracking-btn">
          <img src="public/images/manager-order.png" alt="Legging Fitness">
          Gerenciar Pedido
        </button>

        <!-- Botão: Ver detalhes (com ícone de seta à direita) -->
        <button class="tracking-btn">
          Ver Detalhes
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
        <img src="public/images/conjunto-fit.jpg" alt="Conjunto Academia">
        <p>Top Premium</p>
        <p>Vendido por: TATIFITWEAR</p>
        <p>Entregue por: SEDEX</p>
        <p>Qtd: 1</p>

        <!-- Status do produto -->
        <div class="product-status">
          <p>
            <i class="ph ph-warning"></i>
            Pedido a ser enviado!
          </p>
        </div>
      </div>
    </div>
  </section>
</main>
