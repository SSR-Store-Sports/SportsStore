<!-- Importa o arquivo CSS responsável pelos estilos da página -->
<link rel="stylesheet" href="/app/views/users/address/styles.css">

<body>
<!-- ===========================
     CABEÇALHO DA PÁGINA
=========================== -->
<div class="address-header">
  <h1>Endereço de entrega</h1>

  <!-- ===== Barra de Progresso do Checkout ===== -->
  <div class="checkout-progress">
    <ul>
      <li class="active">Carrinho</li>
      <li class="active current">Endereço</li>
      <li>Pagamento</li>
      <li>Confirmação</li>
    </ul>
  </div>
</div>



  <main class="address-main">
    <!-- ===========================
         SEÇÃO: RESUMO DO PEDIDO
    ============================ -->
    <section class="address-content">
      <div class="address-items">
        <h2><i class="ph ph-package"></i>Resumo do pedido</h2>

        <!-- Item de exemplo do pedido -->
        <div class="item">
          <div class="item-image">
            <img src="public/images/conjunto-fit.jpg" alt="Conjunto Fitness">
          </div>

          <div class="item-details">
            <h3>Top Linha Premium</h3>
            <p class="color-item">Preto</p>
            <p class="item-size">G</p>
            <div class="price-current">R$ 49,90</div>
          </div>
        </div>

        <!-- ===== Subtotal / Total ===== -->
        <div class="order-summary">
          <p>Subtotal: <strong>R$ 49,90</strong></p>
          <p>Frete: <strong>R$ 9,90</strong></p>
          <hr>
          <p>Total: <strong>R$ 59,80</strong></p>
        </div>

        <!-- ===== Cupom de Desconto ===== -->
        <div class="discount-code">
          <input type="text" placeholder="Digite seu cupom" />
          <button class="btn-apply-coupon">
            <span data-text="Aplicar Cupom">Aplicar Cupom</span>
            <div class="scan-line"></div>
          </button>
        </div>

        <!-- ===========================
             SEÇÃO: ADICIONAR ENDEREÇO
        ============================ -->
        <div class="add-address">
          <h2>Finalize seu pedido com o endereço perfeito!</h2>

          <!-- Botão que exibe/esconde o formulário -->
          <button id="add-address-button" class="btn-add-address">
            <i class="ph ph-plus"></i>
          </button>

          <!-- Formulário oculto por padrão -->
          <form id="address-form" class="address-form">
            <h3>Cadastre seu endereço</h3>

            <label>Brasil</label>
            <input type="text" placeholder="Nome" />
            <input type="text" placeholder="Sobrenome" />
            <input type="text" placeholder="CEP" />
            <input type="text" placeholder="Endereço" />
            <input type="text" placeholder="Número" />
            <input type="text" placeholder="Apartamento, bloco etc. (opcional)" />
            <input type="text" placeholder="Bairro" />
            <input type="text" placeholder="Cidade" />
            <input type="text" placeholder="São Paulo" />
            <input type="text" placeholder="Telefone" />

            <button type="submit" class="btn-save-address">Salvar Endereço</button>
          </form>
        </div>
      </div>
    </section>

    <!-- ===========================
         SEÇÃO: DETALHES DO ENDEREÇO
    ============================ -->
    <section class="address-details">
      <div class="address-info-block">
        <h2 class="address-info-title">
          <i class="ph ph-map-pin-plus"></i> Endereço
        </h2>

        <div class="delivery-address">
          <p><strong>Rua:</strong> Rua Arlindo Veiga</p>
          <p><strong>Bairro:</strong> Vila Matilde</p>
          <p><strong>Estado:</strong> SP</p>
          <p><strong>Cidade:</strong> São Paulo</p>
          <p><strong>Número:</strong> 248</p>
          <p><strong>CEP:</strong> 0546-020</p>
        </div>

        <!-- Novo botão de edição -->
        <button class="btn-edit-address"><span>Editar Endereço</span></button>

        <!-- Mapa ilustrativo -->
        <div class="address-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3473.6088428075577!2d-46.69501382022828!3d-23.660689023892804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce50402ebbf84f%3A0xa5d75dec15d9823f!2sR.%20Arlindo%20Veiga%20dos%20Santos%20-%20Campo%20Grande%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004671-300!5e1!3m2!1spt-BR!2sbr!4v1762366036614!5m2!1spt-BR!2sbr"
            width="100%"
            height="300"
            style="border:0; border-radius: 12px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
        
        <button class="btn-confirm-address">Confirmar Endereço</button>
      </div>

      <!-- ===== Selos de segurança ===== -->
      <div class="trust-badges">
        <img src="public/images/verificar.png" alt="Site Seguro">
        <img src="public/images/cartao-de-credito.png" alt="Formas de pagamento">
      </div>
    </section>
  </main>

  <!-- ===========================
       SCRIPT: INTERAÇÃO DO FORMULÁRIO
  ============================ -->
  <script>
    const addButton = document.getElementById('add-address-button');
    const form = document.getElementById('address-form');
    const icon = addButton.querySelector('i');

    addButton.addEventListener('click', () => {
      form.classList.toggle('show');
      if (form.classList.contains('show')) {
        icon.classList.replace('ph-plus', 'ph-x');
      } else {
        icon.classList.replace('ph-x', 'ph-plus');
      }
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      alert("✅ Endereço cadastrado com sucesso!");
      form.classList.remove('show');
      icon.classList.replace('ph-x', 'ph-plus');
    });
  </script>
</body>
