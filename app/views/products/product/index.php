<?php 
require 'config/database.php';

$stmt = $db->prepare("SELECT * FROM tatifit_products");
$stmt->execute();

$dataOfferProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="app/views/products/product/styles.css">

<body>
  <section class="section-botoes">
    <button class="btn">Todos os Produtos</button>
    <button class="btn">Tops</button>
    <button class="btn">Calças</button>
    <button class="btn">Shorts</button>
    <button class="btn">Conjuntos</button>
    <button class="btn">Acessórios</button>
  </section>

  <section>
    <div class="products-container">
      <?php foreach ($dataOfferProducts as $product): ?>
      <div class="product-card">

        <?php if ($product['is_new'] == 1): ?> 
          <div class="product-badge">
            <span class="badge-new">Lançamento</span>
          </div>
        <?php endif; ?>
        
        <div class="product-image">
          <img 
            src="<?= htmlspecialchars($product['url_image']) ?>" 
            alt="<?= htmlspecialchars($product['name']) ?>"
          /> 
        </div>

        <div class="product-info">
          <?php if (isset($product['discount_percent'])): ?>
            <div class="product-discount"><?= $product['discount_percent'] ?>% OFF</div>
          <?php endif; ?>

          <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>

          <div class="product-rating">
            <?php 
              $maxStars = 5;

              $filledStars = (int) floor($product['rating']);
              $emptyStars = $maxStars - $filledStars;

              $stars = str_repeat('<i class="ph-fill ph-star" style="color:#FFD700;"></i>', $filledStars);
              $stars .= str_repeat('<i class="ph ph-star" style="color:#ccc;"></i>', $emptyStars);
            ?>
            <span class="stars"><?= $stars ?></span>
            <span class="rating-count">(<?= (int)$product['rating_count'] ?>)</span>
          </div>

          <?php if ($product['free_shipping']): ?>
            <div class="free-shipping">Frete Grátis</div>
          <?php endif; ?>

          <div>
            <?php if (isset($product['old_price'])): ?>
              <span 
                class="product-old-price"
              >
                R$ <?= number_format($product['old_price'], 2, ',', '.') ?>
              </span>
            <?php endif; ?>
            
            <span 
              class="product-price"
            >
              R$ <?= number_format($product['price'], 2, ',', '.') ?>
            </span>
          </div>

          <?php if (!empty($product['installments_info'])): ?>
            <p 
              class="product-installments">
                <?= htmlspecialchars($product['installments_info']) ?>
            </p>
          <?php endif; ?>
          <div class="product-actions">
            <a href="cart" class="product-button">Comprar</a>
            <button class="btn-wishlist" title="Adicionar aos favoritos">
              <i class="ph ph-heart"></i>
            </button>
          </div>
        </div>
      </div>

      <?php endforeach; ?>
    </div>
  </section>

</body>
