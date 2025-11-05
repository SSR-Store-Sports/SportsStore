<!-- Importa o arquivo CSS responsável pelos estilos da página -->
<link rel="stylesheet" href="/app/views/users/address/styles.css">

<body>
  <!-- ===========================
       CABEÇALHO DA PÁGINA
  ============================ -->
  <div class="address-header">
    <h1>Endereço de entrega</h1>
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
            <!-- Imagem do produto -->
            <img src="public/images/conjunto-fit.jpg" alt="Conjunto Fitness">
          </div>

          <div class="item-details">
            <h3>Top Linha Premium</h3>
            <p class="color-item">Preto</p>
            <p class="item-size">G</p>
            <div class="price-current">R$ 49,90</div>
          </div>
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

            <!-- Campos de entrada -->
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

            <!-- Botão de envio do formulário -->
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

        <!-- Exemplo de endereço exibido após salvar -->
        <div class="delivery-address">
          <p><strong>Rua:</strong> Rua Arlindo Veiga</p>
          <p><strong>Bairro:</strong> Vila Matilde</p>
          <p><strong>Estado:</strong> SP</p>
          <p><strong>Cidade:</strong> São Paulo</p>
          <p><strong>Número:</strong> 248</p>
          <p><strong>CEP:</strong> 0546-020</p>
        </div>

        <!-- Botão para confirmar o endereço selecionado -->
        <button class="btn-confirm-address">Confirmar Endereço</button>
      </div>
    </section>
  </main>

  <!-- ===========================
       SCRIPT: INTERAÇÃO DO FORMULÁRIO
  ============================ -->
  <script>
    // Referência ao botão de adicionar endereço
    const addButton = document.getElementById('add-address-button');

    // Referência ao formulário de endereço
    const form = document.getElementById('address-form');

    // Ícone dentro do botão
    const icon = addButton.querySelector('i');

    // Evento de clique no botão
    addButton.addEventListener('click', () => {
      // Alterna a exibição do formulário (mostrar/ocultar)
      form.classList.toggle('show');

      // Alterna o ícone entre "plus" e "x"
      if (form.classList.contains('show')) {
        icon.classList.replace('ph-plus', 'ph-x');
      } else {
        icon.classList.replace('ph-x', 'ph-plus');
      }
    });

    // Evento de envio do formulário
    form.addEventListener('submit', (e) => {
      e.preventDefault(); // Impede o recarregamento da página

      alert("✅ Endereço cadastrado com sucesso!");
      form.classList.remove('show'); // Esconde o formulário
      icon.classList.replace('ph-x', 'ph-plus'); // Retorna o ícone original
    });
  </script>
</body>
