<?php

$dataOfferProducts = [
  [
    "id" => 1,
    "name" => "Top Fitness Feminino",
    "price" => 45.90,
    "originalPrice" => 59.90,
    "discount" => 23,
    "installments" => "3X de R$ 15,30",
    "image" => "/public/images/product.jpg",
    "category" => "Tops",
    "stock" => 15
  ],
  [
    "id" => 2,
    "name" => "Conjunto Fitness",
    "price" => 89.90,
    "originalPrice" => 120.00,
    "discount" => 25,
    "installments" => "4X de R$ 22,48",
    "image" => "/public/images/conjunto-fit.jpg",
    "category" => "Conjuntos",
    "stock" => 8
  ],
  [
    "id" => 3,
    "name" => "Shorts Fitness",
    "price" => 35.90,
    "originalPrice" => 49.90,
    "discount" => 28,
    "installments" => "2X de R$ 17,95",
    "image" => "/public/images/shorts-fit.jpg",
    "category" => "Shorts",
    "stock" => 22
  ],
  [
    "id" => 4,
    "name" => "Legging Premium",
    "price" => 69.90,
    "originalPrice" => 89.90,
    "discount" => 22,
    "installments" => "3X de R$ 23,30",
    "image" => "/public/images/product.jpg",
    "category" => "Leggings",
    "stock" => 12
  ],
  [
    "id" => 5,
    "name" => "Top Esportivo Pro",
    "price" => 55.90,
    "originalPrice" => 75.90,
    "discount" => 26,
    "installments" => "3X de R$ 18,63",
    "image" => "/public/images/product.jpg",
    "category" => "Tops",
    "stock" => 18
  ]
];

?>

<link rel="stylesheet" href="/app/views/styles.css">

<main>
  <section class="carrossel">
    <button>
      <i class="ph ph-arrow-left icon"></i>
    </button>

    <div class="imgs-carrossel">
      <img src="/public/images/modelo01.png" alt="" />
      <img src="/public/images/modelo02.png" alt="" />
      <img src="/public/images/modelo03.png" alt="" />  
    </div>

    <button>
      <i class="ph ph-arrow-right icon"></i>
    </button>
  </section>

  <div class="message-payment">
    <p>Frete <span>Grátis</span> OFF NO <strong>PIX</strong></p>
  </div>

  <section class="products">
    <section class="section-botoes">
      <a href="/products"><button class="btn">Todos os Produtos</button></a>
      <button class="btn">Tops</button>
      <button class="btn">Calças</button>
      <button class="btn">Shorts</button>
      <button class="btn">Conjuntos</button>
      <button class="btn">Acessórios</button>
    </section>

    <div class="root-header">
      <h1>Ofertas Especiais</h1>
      <p>Os Melhores Preços Disponíveis!</p>
    </div>

    <div class="root-products">
      <?php foreach ($dataOfferProducts as $product): ?>
        <div class="product" data-id="<?=$product['id'] ?>">
          <div class="discount-badge"><?=$product['discount'] ?>% OFF</div>
          
          <img src="<?=$product['image'] ?>" alt="<?=$product['name'] ?>" />
          
          <div class="deitals-product">
            <h2><?=$product['name'] ?></h2>
            
            <div class="price-product">
              <span class="original-price">R$ <?=$product['originalPrice'] ?>
              </span>
              <h3>R$ <?=$product['price'] ?></h3>
              <p>ou <?=$product['installments'] ?></p>
            </div>

            <button class="add-to-cart" data-product-id="<?=$product['id'] ?>">
              Adicionar ao carrinho
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div class="message-buy">
    <i class="ph ph-truck icon"></i>

    <div>
      <h3>Retire Diretamente na Loja</h3>
      <span>Compre seu produto online e retire na loja</span>
    </div>
  </div>
</main>