<link rel="stylesheet" href="/app/views/products/product-selected/styles.css" />

<body>
  <main class="product-selected-main">
    <div class="product-container">
      <div class="product-image">
        <img src="/public/images/product.jpg" alt="Top Fitness">
        <div class="image-gallery">
          <img src="/public/images/product.jpg" alt="Imagem 1" class="thumb active">
          <img src="/public/images/product.jpg" alt="Imagem 2" class="thumb">
          <img src="/public/images/product.jpg" alt="Imagem 3" class="thumb">
        </div>
      </div>

      <div class="product-details">
        <div class="product-header">
          <h1>Top Fitness Premium</h1>
          <div class="product-rating">
            <div class="stars">
              <i class="ph ph-star-fill"></i>
              <i class="ph ph-star-fill"></i>
              <i class="ph ph-star-fill"></i>
              <i class="ph ph-star-fill"></i>
              <i class="ph ph-star"></i>
            </div>
            <span>(4.2) 127 avaliações</span>
          </div>
        </div>

        <div class="price-section">
          <div class="price">
            <span class="current-price">R$ 89,90</span>
            <span class="old-price">R$ 120,00</span>
          </div>
          <div class="installments">
            <i class="ph ph-credit-card"></i>
            <span>ou 3x de R$ 29,97 sem juros</span>
          </div>
        </div>

        <div class="product-description">
          <h3>Descrição</h3>
          <p>Top fitness de alta qualidade, confeccionado com tecido respirável e tecnologia dry-fit. Ideal para treinos
            intensos e atividades esportivas. Oferece máximo conforto e liberdade de movimento.</p>
        </div>

        <form id="productForm" class="product-form">
          <div class="color-selection">
            <h3>Cor</h3>
            <div class="color-options">
              <input type="radio" id="color1" name="color" value="rosa" required>
              <label for="color1" class="color-option" style="background-color: #e91e63;"></label>

              <input type="radio" id="color2" name="color" value="preto">
              <label for="color2" class="color-option" style="background-color: #000;"></label>

              <input type="radio" id="color3" name="color" value="branco">
              <label for="color3" class="color-option" style="background-color: #fff; border: 2px solid #ddd;"></label>

              <input type="radio" id="color4" name="color" value="azul">
              <label for="color4" class="color-option" style="background-color: #2196f3;"></label>
            </div>
          </div>

          <div class="size-selection">
            <h3>Tamanho</h3>
            <div class="size-options">
              <input type="radio" id="sizeP" name="size" value="P" required>
              <label for="sizeP" class="size-option">P</label>

              <input type="radio" id="sizeM" name="size" value="M">
              <label for="sizeM" class="size-option">M</label>

              <input type="radio" id="sizeG" name="size" value="G">
              <label for="sizeG" class="size-option">G</label>

              <input type="radio" id="sizeGG" name="size" value="GG">
              <label for="sizeGG" class="size-option">GG</label>
            </div>
            <a href="#" class="size-guide"><i class="ph ph-ruler"></i> Guia de tamanhos</a>
          </div>

          <div class="quantity-selection">
            <h3>Quantidade</h3>
            <div class="quantity-controls">
              <button type="button" class="qty-btn" id="decreaseQty"><i class="ph ph-minus"></i></button>
              <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
              <button type="button" class="qty-btn" id="increaseQty"><i class="ph ph-plus"></i></button>
            </div>
            <span class="stock-info"><i class="ph ph-check-circle"></i> 15 unidades em estoque</span>
          </div>

          <div class="action-buttons">
            <button type="submit" class="btn-add-cart">
              <i class="ph ph-shopping-cart"></i>
              Adicionar ao Carrinho
            </button>
            <button type="button" class="btn-buy-now">
              <i class="ph ph-lightning"></i>
              Comprar Agora
            </button>
          </div>
        </form>

        <div class="product-info">
          <div class="info-item">
            <i class="ph ph-truck"></i>
            <span>Frete grátis para compras acima de R$ 150</span>
          </div>
          <div class="info-item">
            <i class="ph ph-arrow-clockwise"></i>
            <span>Troca grátis em até 30 dias</span>
          </div>
          <div class="info-item">
            <i class="ph ph-shield-check"></i>
            <span>Compra 100% segura</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="/public/js/product-selected.js"></script>
</body>