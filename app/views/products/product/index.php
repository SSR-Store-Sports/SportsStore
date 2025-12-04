<?php
require_once 'config/database.php';

// Obter os valores: página atual, item de pesquisa, categoria de pesquisa
$pageValueDefault = (int) 1; // primeira página padrão
$itemsPerPage = (int) 6; // itens por página
$pageCurrent = isset($_GET['page']) ? (int) $_GET['page'] : $pageValueDefault;
$searchProduct = isset($_GET['name']) ? (string) trim($_GET['name']) : null;
$searchCategorie = isset($_GET['categoria']) ? (string) trim($_GET['categoria']) : null;

// função que retorna itens que devem ser esquecidos por página
function calcPagination(int $page, $items): int
{
  return ($page - 1) * $items;
}

$valueFilters = [
  'pageCurrent' => (int) $pageCurrent,
  'searchProduct' => (string) $searchProduct,
  'searchCategorie' => (string) $searchCategorie,
];

$offset = calcPagination($valueFilters['pageCurrent'], $itemsPerPage);

$whereParts = [];
$params = [];
$whereSQL = "WHERE status = 'Ativo'";

// pesquisa por nome
if (!empty($valueFilters['searchProduct'])) {
  $_SESSION['searchProduct'] = $valueFilters['searchProduct'];

  $whereParts[] = "name LIKE :name";
  $params[':name'] = '%' . $valueFilters['searchProduct'] . '%';
}

// pesquisa por categoria
if (!empty($valueFilters['searchCategorie'])) {
  $_SESSION['searchCategorie'] = $valueFilters['searchCategorie'];

  $whereParts[] = "category_id = :categoria";
  $params[':categoria'] = $valueFilters['searchCategorie'];
}

if (count($whereParts) > 0) {
  $whereSQL .= " AND " . implode(" AND ", $whereParts);
}

try {
  $countStmt = $db->prepare("SELECT COUNT(*) AS total FROM tatifit_products $whereSQL");
  $countStmt->execute($params);
  $totalProducts = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
  $totalPages = ceil($totalProducts / $itemsPerPage);

  $sql = "SELECT * FROM tatifit_products $whereSQL LIMIT :limit OFFSET :offset";
  $stmt = $db->prepare($sql);

  foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
  }

  $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

  $dataOfferProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  error_log("Erro na consulta de produtos: " . $e->getMessage());
  echo "Ops! Não foi possível carregar os produtos. Tente novamente.";
};

?>

<link rel="stylesheet" href="app/views/products/product/styles.css">

<body>
  <section class="section-botoes">
    <a href="/produtos" class="btn">Todos os Produtos</a>
    <?php
    // Buscar categorias do banco
    $categoriesStmt = $db->query("SELECT id, name FROM tatifit_categories ORDER BY name");
    $categories = $categoriesStmt->fetchAll();

    foreach ($categories as $category) {
      $activeClass = (isset($_GET['categoria']) && $_GET['categoria'] == $category['id']) ? 'active' : '';
      echo "<a href='/produtos?categoria={$category['id']}' class='btn $activeClass'>" . htmlspecialchars($category['name']) . "</a>";
    }
    ?>
  </section>

  <section class="section-cards">
    <h1>Todos os Produtos</h1>

    <div class="products-container">
      <?php foreach ($dataOfferProducts as $product): ?>
        <div class="product-card">
          <a href="/produto?id=<?= $product['id'] ?>">

            <?php if ($product['is_new'] == 1): ?>
              <div class="product-badge"><span class="badge-new">Lançamento</span></div>
            <?php endif; ?>

            <div class="product-image">
              <img src="<?= htmlspecialchars($product['url_image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
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
                  $stars = str_repeat('<i class="ph-fill ph-star" style="color:#FFD700;"></i>', floor($product['rating']));
                  $stars .= str_repeat('<i class="ph ph-star" style="color:#ccc;"></i>', 5 - floor($product['rating']));
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
                <?php if (!empty($product['old_price'])): ?>
                  <span class="product-old-price">
                    R$ <?= number_format($product['old_price'], 2, ',', '.') ?>
                  </span>
                <?php endif; ?>

                <span class="product-price">
                  R$ <?= number_format($product['price'], 2, ',', '.') ?>
                </span>
              </div>

              <?php if (!empty($product['installments_info'])): ?>
                <p class="product-installments"><?= htmlspecialchars($product['installments_info']) ?></p>
              <?php endif; ?>

              <div class="product-actions">
                <a href="/produto?id=<?= $product['id'] ?>" class="product-button">Comprar</a>
                <!-- <button class="btn-wishlist"><i class="ph ph-heart"></i></button> -->
              </div>

            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="pagination">
      <?php if ($valueFilters['pageCurrent'] > 1): ?>
        <a href="?page=<?= $valueFilters['pageCurrent'] - 1 ?>" class="pagination-btn">← Anterior</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="pagination-btn <?= $i === $valueFilters['pageCurrent'] ? 'active' : '' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>

      <?php if ($valueFilters['pageCurrent'] < $totalPages): ?>
        <a href="?page=<?= $valueFilters['pageCurrent'] + 1 ?>" class="pagination-btn">Próximo →</a>
      <?php endif; ?>
    </div>

  </section>
</body>