<?php
require 'config/database.php';

try {
  $stmt = $db->prepare("
    SELECT 
      id,
      name,
      price,
      old_price,
      discount_percent,
      installments_info,
      url_image,
      status
    FROM tatifit_products 
    WHERE status = 'Ativo' 
      AND (
        (old_price IS NOT NULL AND price < old_price) 
        OR discount_percent > 0
      )
    ORDER BY discount_percent DESC, price ASC
    LIMIT 6
  ");

  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dataOfferProducts = [];
  foreach ($products as $product) {
    $discount = $product['discount_percent'] ?? 0;
    $originalPrice = $product['old_price'] ?? $product['price'];

    if ($discount == 0 && $product['old_price'] > 0) {
      $discount = round((($originalPrice - $product['price']) / $originalPrice) * 100);
    }

    $dataOfferProducts[] = [
      'id' => $product['id'],
      'name' => $product['name'],
      'price' => number_format($product['price'], 2, '.', ''),
      'originalPrice' => number_format($originalPrice, 2, '.', ''),
      'discount' => $discount,
      'installments' => $product['installments_info'] ?? 'À vista',
      'image' => $product['url_image'] ?? '/public/images/product.jpg'
    ];
  }
} catch (Exception $e) {
  error_log("Erro ao buscar ofertas: " . $e->getMessage());
  $dataOfferProducts = [];
}

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
      </div>

      <div class="slide group-slide">
        <img src="/public/images/modelo02.png" alt="" />
        <img src="/public/images/modelo03.png" alt="" />
        <img src="/public/images/modelo1.jpg" alt="" />

        <a href="/produtos" class="btn-saiba-mais">
          Ver produtos
        </a>
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
      <?php
      // Buscar categorias do banco
      $categoriesStmt = $db->query("SELECT id, name FROM tatifit_categories ORDER BY name");
      $categories = $categoriesStmt->fetchAll();

      foreach ($categories as $category) {
        echo "<a href='/produtos?categoria={$category['id']}'><button class='btn'>" . htmlspecialchars($category['name']) . "</button></a>";
      }
      ?>
    </section>

    <div class="root-header">
      <h1>Ofertas Especiais</h1>
      <p>Os Melhores Preços Disponíveis!</p>
    </div>

    <div class="root-products">
      <?php if ($dataOfferProducts): ?>
        <?php foreach ($dataOfferProducts as $product): ?>
          <div class="product" data-id="<?= $product['id'] ?>">
            <?php if ($product['discount'] > 0): ?>
              <div class="discount-badge"><?= $product['discount'] ?>% OFF</div>
            <?php endif; ?>

            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />

            <div class="deitals-product">
              <h2><?= htmlspecialchars($product['name']) ?></h2>

              <div class="price-product">
                <?php if ($product['originalPrice'] != $product['price']): ?>
                  <span class="original-price">R$ <?= number_format($product['originalPrice'], 2, ',', '.') ?></span>
                <?php endif; ?>
                <h3>R$ <?= number_format($product['price'], 2, ',', '.') ?></h3>
                <p><?= htmlspecialchars($product['installments']) ?></p>
              </div>

              <a href="/carrinho?produto=<?= $product['id'] ?>" class="add-to-cart">
                Adicionar ao carrinho
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty-state">
          <div class="empty-state-content">
            <i class="ph ph-smiley-sad empty-icon"></i>
            <h1 class="empty-title">Parece que não há nenhum produto cadastrado!</h1>
            <p class="empty-message">Tente novamente mais tarde.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <div class="message-buy">
    <div class="group-message">
      <div class="message-item">
        <i class="ph ph-truck icon"></i>
        <div>
          <h3>Retire Diretamente na Loja</h3>
          <span>Compre seu produto online e retire na loja</span>
        </div>
      </div>

      <div class="message-item">
        <i class="ph ph-shopping-bag-open icon"></i>
        <div>
          <h3>Preço justo e que cabe no seu bolso</h3>
          <span>Compre agora, e não perca a oportunidade!</span>
        </div>
      </div>
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