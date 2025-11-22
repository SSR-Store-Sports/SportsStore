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

// $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
// $stmt->bindParam(':id', $userId); // Assuming $userId is defined
// $stmt->execute();
// $user = $stmt->fetch(); // Fetches a single row
// print_r($user);

// Exemplo de consulta segura
// $stmt = $db->prepare("SELECT * FROM tatifit_products");
// $stmt->execute();

// $dataOfferProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($dataOfferProducts as $user) {
//   echo "User: " . $user['name'] . "<br>";
// }

?>

<link rel="stylesheet" href="/app/views/styles.css">

<main>
<section class="carrossel">
  <button class="btn-prev">
    <i class="ph ph-arrow-left icon"></i>
  </button>

  <div class="imgs-carrossel">

    <div class="slide slide-cta">
      <img src="public/images/banner_black_friday.gif" alt="Slide animado" />

      <a href="/produtos" class="btn-saiba-mais">
        Ver produtos
      </a>
    </div>

    <div class="slide group-slide">
      <img src="/public/images/modelo02.png" alt="" />
      <img src="/public/images/modelo03.png" alt="" />
      <img src="/public/images/modelo1.jpg" alt="" />
    </div>

  </div>

  <button class="btn-next">
    <i class="ph ph-arrow-right icon"></i>
  </button>
</section>



  <div class="message-payment">
    <div class="group-payment">
      <p><i class="ph ph-truck"></i> Frete <span>grátis</span> para todo Brasil</p>
      <p><i class="ph ph-credit-card"></i> <span>10% OFF</span> no PIX</p>
      <p><i class="ph ph-shield-check"></i> Compra <span>100% segura</span></p>
      <p><i class="ph ph-clock"></i> Entrega em até <span>48h</span></p>
      <p><i class="ph ph-arrow-clockwise"></i> <span>30 dias</span> para troca</p>
      <p><i class="ph ph-medal"></i> Produtos <span>premium</span></p>
      <p><i class="ph ph-heart"></i> Mais de <span>10mil</span> clientes satisfeitos</p>
      <p><i class="ph ph-lightning"></i> Envio <span>expresso</span> disponível</p>
    </div>

    <div aria-hidden class="group-payment">
      <p><i class="ph ph-truck"></i> Frete <span>grátis</span> para todo Brasil</p>
      <p><i class="ph ph-credit-card"></i> <span>10% OFF</span> no PIX</p>
      <p><i class="ph ph-shield-check"></i> Compra <span>100% segura</span></p>
      <p><i class="ph ph-clock"></i> Entrega em até <span>48h</span></p>
      <p><i class="ph ph-arrow-clockwise"></i> <span>30 dias</span> para troca</p>
      <p><i class="ph ph-medal"></i> Produtos <span>premium</span></p>
      <p><i class="ph ph-heart"></i> Mais de <span>10mil</span> clientes satisfeitos</p>
      <p><i class="ph ph-lightning"></i> Envio <span>expresso</span> disponível</p>
    </div>
  </div>
</div>

  <section class="products">
    <section class="section-botoes">
      <a href="/produtos"><button class="btn">Todos os Produtos</button></a>
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
      <?php if ($dataOfferProducts): ?>
        <?php foreach ($dataOfferProducts as $product): ?>
        <div class="product" data-id="<?= $product['id'] ?>">
          <div class="discount-badge"><?= $product['discount'] ?>% OFF</div>

          <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />

          <div class="deitals-product">
            <h2><?= $product['name'] ?></h2>

            <div class="price-product">
              <span class="original-price">R$ <?= $product['originalPrice'] ?>
              </span>
              <h3>R$ <?= $product['price'] ?></h3>
              <p>ou <?= $product['installments'] ?></p>
            </div>

            <button class="add-to-cart" data-product-id="<?= $product['id'] ?>">
              Adicionar ao carrinho
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div>
          <div>
            <h1>Parece que não há nenhum pedido cadastrado!</h1>
            <i class="ph ph-smiley-sad"></i>
          </div>

          <p>Tente novamente mais tarde.</p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <div class="message-buy">
    <i class="ph ph-truck icon"></i>

    <div>
      <h3>Retire Diretamente na Loja</h3>
      <span>Compre seu produto online e retire na loja</span>
    </div>
  </div>

<script>
  const track = document.querySelector(".imgs-carrossel");
  const slides = document.querySelectorAll(".slide");
  let index = 0;

  // AUTOPLAY
  let auto = setInterval(nextSlide, 4000);

  // Pausa ao passar o mouse
  track.addEventListener("mouseenter", () => clearInterval(auto));
  track.addEventListener("mouseleave", () => {
    auto = setInterval(nextSlide, 4000);
  });

  // Atualiza posição do slide
  function updateSlide() {
    const offset = index * -100;
    slides.forEach(slide => {
      slide.style.transform = `translateX(${offset}%)`;
    });
  }

  // Próximo e anterior
  function nextSlide() {
    index = (index + 1) % slides.length;
    updateSlide();
  }

  function prevSlide() {
    index = (index - 1 + slides.length) % slides.length;
    updateSlide();
  }

  document.querySelector(".btn-next").addEventListener("click", nextSlide);
  document.querySelector(".btn-prev").addEventListener("click", prevSlide);

  // SWIPE MOBILE
  let startX = 0;
  let endX = 0;

  track.addEventListener("touchstart", e => {
    startX = e.touches[0].clientX;
  });

  track.addEventListener("touchmove", e => {
    endX = e.touches[0].clientX;
  });

  track.addEventListener("touchend", () => {
    const diff = startX - endX;
    if (diff > 50) {
      nextSlide(); // Swipe para esquerda
    } else if (diff < -50) {
      prevSlide(); // Swipe para direita
    }
  });

  // Inicializa
  updateSlide();
</script>
  

</main>

