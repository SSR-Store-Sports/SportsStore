<?php
require 'config/database.php';

// Verificar se ID do produto foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "<script>alert('Produto não encontrado.'); window.location.href = '/produtos';</script>";
  exit();
}

$productId = (int) $_GET['id'];

// produtos com categoria
$stmt = $db->prepare("
    SELECT p.*, c.name as category_name 
    FROM tatifit_products p 
    LEFT JOIN tatifit_categories c ON p.category_id = c.id 
    WHERE p.id = :id AND p.status = 'Ativo'
");
$stmt->execute([':id' => $productId]);
$product = $stmt->fetch();

if (!$product) {
  echo "<script>alert('Produto não encontrado.'); window.location.href = '/produtos';</script>";
  exit();
}

$stockStmt = $db->prepare("SELECT DISTINCT size, stock_quantity FROM tatifit_stocks WHERE products_id = :id AND stock_quantity > 0");
$stockStmt->execute([':id' => $productId]);
$stockOptions = $stockStmt->fetchAll();

$sizes = array_unique(array_column($stockOptions, 'size'));
$colors = [];

$relatedStmt = $db->prepare("
    SELECT p.*, c.name as category_name 
    FROM tatifit_products p 
    LEFT JOIN tatifit_categories c ON p.category_id = c.id 
    WHERE p.id != :current_id
    ORDER BY 
        CASE WHEN p.category_id = :category_id THEN 0 ELSE 1 END,
        RAND() 
    LIMIT 4
");
$relatedStmt->execute([':category_id' => $product['category_id'], ':current_id' => $productId]);
$relatedProducts = $relatedStmt->fetchAll();

?>

<link rel="stylesheet" href="/app/views/products/product-selected/styles.css" />

<body>
  <main class="product-selected-main">
    <div class="product-container">
      <div class="product-image">
        <img src="<?= htmlspecialchars($product['url_image'] ?? '/public/images/product.jpg') ?>"
          alt="<?= htmlspecialchars($product['name']) ?>">
        <div class="image-gallery">
          <img src="<?= htmlspecialchars($product['url_image'] ?? '/public/images/product.jpg') ?>" alt="Imagem 1"
            class="thumb active">
        </div>
      </div>

      <div class="product-details">
        <div class="product-header">
          <h1><?= htmlspecialchars($product['name']) ?></h1>
          <div class="product-rating">
            <div class="stars">
              <?php
              $rating = $product['rating'] ?? 0;
              for ($i = 1; $i <= 5; $i++) {
                echo $i <= $rating ? '<i class="ph ph-star-fill"></i>' : '<i class="ph ph-star"></i>';
              }
              ?>
            </div>
            <span>(<?= number_format($product['rating'] ?? 0, 1) ?>) <?= $product['rating_count'] ?? 0 ?>
              avaliações</span>
          </div>
        </div>

        <div class="price-section">
          <div class="price">
            <span class="current-price">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
            <?php if (!empty($product['old_price'])): ?>
              <span class="old-price">R$ <?= number_format($product['old_price'], 2, ',', '.') ?></span>
            <?php endif; ?>
          </div>
          <?php if (!empty($product['installments_info'])): ?>
            <div class="installments">
              <i class="ph ph-credit-card"></i>
              <span><?= htmlspecialchars($product['installments_info']) ?></span>
            </div>
          <?php endif; ?>
        </div>

        <div class="product-description">
          <h3>Descrição</h3>
          <div class="description-content">
            <p class="description-text">
              <?= htmlspecialchars($product['description'] ?? 'Produto de alta qualidade da nossa coleção.') ?></p>
            <?php if (strlen($product['description'] ?? '') > 150): ?>
              <button type="button" class="btn-toggle-description">Ver mais</button>
            <?php endif; ?>
          </div>
          <?php if (!empty($product['category_name'])): ?>
            <p class="category-info"><strong>Categoria:</strong> <?= htmlspecialchars($product['category_name']) ?></p>
          <?php endif; ?>
        </div>

        <form id="productForm" class="product-form">
          <?php if (!empty($colors)): ?>
            <div class="color-selection">
              <h3>Cor</h3>
              <div class="color-options">
                <?php foreach ($colors as $index => $color): ?>
                  <input type="radio" id="color<?= $index ?>" name="color" value="<?= htmlspecialchars($color) ?>"
                    <?= $index === 0 ? 'required' : '' ?>>
                  <label for="color<?= $index ?>" class="color-option"
                    title="<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if (!empty($sizes)): ?>
            <div class="size-selection">
              <h3>Tamanho</h3>
              <div class="size-options">
                <?php foreach ($sizes as $index => $size): ?>
                  <input type="radio" id="size<?= $size ?>" name="size" value="<?= htmlspecialchars($size) ?>" <?= $index === 0 ? 'required' : '' ?>>
                  <label for="size<?= $size ?>" class="size-option"><?= htmlspecialchars($size) ?></label>
                <?php endforeach; ?>
              </div>
              <a href="/guia-tamanhos" class="size-guide"><i class="ph ph-ruler"></i> Guia de tamanhos</a>
            </div>
          <?php endif; ?>

          <div class="quantity-selection">
            <h3>Quantidade</h3>
            <div class="quantity-controls">
              <button type="button" class="qty-btn" id="decreaseQty"><i class="ph ph-minus"></i></button>
              <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
              <button type="button" class="qty-btn" id="increaseQty"><i class="ph ph-plus"></i></button>
            </div>
            <span class="stock-info"><i class="ph ph-check-circle"></i>Disponível em estoque</span>
          </div>

          <div class="action-buttons">
            <button type="button" class="btn-add-cart" onclick="addToCart()">
              <i class="ph ph-shopping-cart"></i>
              Adicionar ao Carrinho
            </button>
            <!-- <button type="button" class="btn-buy-now">
              <i class="ph ph-lightning"></i>
              Comprar Agora
            </button> -->
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

    <?php if (!empty($relatedProducts)): ?>
      <section class="related-products">
        <div class="related-header">
          <h2>Produtos Relacionados</h2>
          <p>Você também pode gostar</p>
        </div>

        <div class="products-grid">
          <?php foreach ($relatedProducts as $relatedProduct): ?>
            <div class="product-card">
              <a href="/produto?id=<?= $relatedProduct['id'] ?>" class="product-link">
                <div class="product-image-container">
                  <img src="<?= htmlspecialchars($relatedProduct['url_image'] ?? '/public/images/product.jpg') ?>"
                    alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
                </div>
                <div class="product-info-card">
                  <h3><?= htmlspecialchars($relatedProduct['name']) ?></h3>
                  <div class="product-rating-small">
                    <?php
                    $rating = $relatedProduct['rating'] ?? 0;
                    for ($i = 1; $i <= 5; $i++) {
                      echo $i <= $rating ? '<i class="ph ph-star-fill"></i>' : '<i class="ph ph-star"></i>';
                    }
                    ?>
                    <span>(<?= number_format($relatedProduct['rating'] ?? 0, 1) ?>)</span>
                  </div>
                  <div class="product-price-card">
                    <span class="price-current">R$ <?= number_format($relatedProduct['price'], 2, ',', '.') ?></span>
                    <?php if (!empty($relatedProduct['old_price'])): ?>
                      <span class="price-old">R$ <?= number_format($relatedProduct['old_price'], 2, ',', '.') ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>
  </main>

  <script src="/public/js/product-selected.js"></script>
</body>