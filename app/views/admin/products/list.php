<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// buscar produtos com categoria
$products = $db->query("
    SELECT p.*, c.name as category_name 
    FROM tatifit_products p 
    LEFT JOIN tatifit_categories c ON p.category_id = c.id 
    ORDER BY p.date_created DESC
")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <span>Lista de Produtos</span>
      </nav>
      <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
      <h1>Lista de Produtos</h1>
      <p>Gerencie todos os produtos cadastrados na loja.</p>

      <div class="products-header">
        <div class="products-count">
          <span><?= count($products) ?> produtos encontrados</span>
        </div>
        <!-- <a href="/admin/produtos/cadastrar" class="btn-add-product">
          <i class="ph ph-plus"></i>
          Novo Produto
        </a> -->
      </div>

      <div class="products-grid">
        <?php foreach ($products as $product): ?>
          <div class="product-item">
            <div class="product-image">
              <img src="<?= htmlspecialchars($product['url_image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
              <div class="product-overlay">
                <div class="product-actions">
                  <button class="btn-action btn-edit" onclick="editProduct(<?= $product['id'] ?>)" title="Editar">
                    <i class="ph ph-pencil"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="product-info">
              <div class="product-header">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <span class="status <?= strtolower($product['status']) ?>"><?= $product['status'] ?></span>
              </div>
              <p class="category"><i class="ph ph-tag"></i><?= htmlspecialchars($product['category_name']) ?></p>
              <div class="product-footer">
                <p class="price">R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                <span class="product-id">#<?= $product['id'] ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>


  <script>
    function editProduct(id) {
      window.location.href = `/admin/produtos/editar?id=${id}`;
    }
  </script>
</body>