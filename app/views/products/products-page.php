<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tatifitwear</title>

  <!-- CSS externo -->
  <link rel="stylesheet" href="app\views\products\styles.css">
</head>

<body class="bg-black text-white">

  <!-- Seção de botões -->
  <section class="section-botoes">
    <button class="btn">PRODUTOS</button>
    <button class="btn">TOP’S</button>
    <button class="btn">CALÇAS</button>
    <button class="btn">SHORTS</button>
    <button class="btn">CONJUNTOS</button>
  </section>

  <!-- Seção de produtos -->
  <section class="products-section">
    <div class="products-container">

      <!-- Card 1 -->
      <div class="product-card">
        <img src="public\images\image 14.jpg" class="product-image" alt="Top Fitness">
        <div class="product-info">
          <h3 class="product-title">TOP FITNESS</h3>
          <p class="product-price">R$ 50,00</p>
          <p class="product-installments">10x de R$ 7,99</p>
          <a href="cart" class="product-button">Adicionar ao carrinho</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="product-card">
        <img src="public/images/shorts-fit.jpg" class="product-image" alt="Shorts Fitness">
        <div class="product-info">
          <h3 class="product-title">SHORTS FITNESS</h3>
          <p class="product-price">R$ 45,00</p>
          <p class="product-installments">10x de R$ 8,99</p>
          <a href="cart" class="product-button">Adicionar ao carrinho</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="product-card">
        <img src="public/images/conjunto-fit.jpg" class="product-image" alt="Conjunto Fitness">
        <div class="product-info">
          <h3 class="product-title">CONJUNTO FITNESS</h3>
          <p class="product-price">R$ 120,00</p>
          <p class="product-installments">10x de R$ 9,99</p>
          <a href="cart" class="product-button">Adicionar ao carrinho</a>
        </div>
      </div>

    </div>
  </section>

</body>
</html>
