<?php
require 'config/database.php';

$itemsPerPage = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$countStmt = $db->query("SELECT COUNT(*) as total FROM tatifit_products");
$totalProducts = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalProducts / $itemsPerPage);

$stmt = $db->prepare("SELECT * FROM tatifit_products LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
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

  <section class="section-cards">
    <h1>Todos os Produtos</h1>
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
            <div class="product-block">
              <div class="product-discount"><?= $product['discount_percent'] ?>% OFF</div>
            </div>
          <?php endif; ?>

          <div class="product-title-rating">
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
          </div>

          <?php if ($product['free_shipping']): ?>
            <div class="product-block">
              <div class="free-shipping">Frete Grátis</div>
            </div>
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
            <a href="/produto" class="product-button">Comprar</a>
            <button class="btn-wishlist" title="Adicionar aos favoritos">
              <i class="ph ph-heart"></i>
            </button>
          </div>
        </div>
      </div>

      <?php endforeach; ?>
    </div>

    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="pagination-btn">← Anterior</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="pagination-btn <?= $i === $page ? 'active' : '' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="pagination-btn">Próximo →</a>
      <?php endif; ?>
    </div>
  </section>

</body>
