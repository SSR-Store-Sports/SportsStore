<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Buscar categorias com contagem de produtos
$categories = $db->query("
    SELECT c.*, COUNT(p.id) as products_count 
    FROM tatifit_categories c 
    LEFT JOIN tatifit_products p ON c.id = p.category_id 
    GROUP BY c.id 
    ORDER BY c.name
")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <span>Lista de Categorias</span>
      </nav>
      <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
      <h1>Lista de Categorias</h1>
      <p>Todas as categorias cadastradas no sistema.</p>

      <div class="categories-grid">
        <?php foreach ($categories as $category): ?>
          <div class="category-card">
            <h3><?= htmlspecialchars($category['name']) ?></h3>
            <p><?= $category['products_count'] ?> produto(s)</p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>

  <style>
    .categories-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1rem;
      margin-top: 2rem;
    }
    
    .category-card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 1.5rem;
      text-align: center;
    }
    
    .category-card h3 {
      margin: 0 0 0.5rem 0;
      color: var(--text-color-pink);
    }
    
    .category-card p {
      margin: 0;
      color: #666;
      font-size: 0.9rem;
    }
  </style>
</body>