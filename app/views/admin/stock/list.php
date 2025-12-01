<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Buscar estoque com informações do produto
$stocks = $db->query("
    SELECT s.*, p.name as product_name, sup.name as supplier_name 
    FROM tatifit_stocks s 
    JOIN tatifit_products p ON s.products_id = p.id 
    LEFT JOIN tatifit_suppliers sup ON s.suppliers_id = sup.id 
    ORDER BY p.name, s.size, s.color
")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <span>Lista de Estoque</span>
      </nav>
      <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a>
      <h1>Lista de Estoque</h1>
      <p>Controle de estoque por produto, tamanho e cor.</p>

      <div class="stock-table">
        <table>
          <thead>
            <tr>
              <th>Produto</th>
              <th>Tamanho</th>
              <th>Cor</th>
              <th>Quantidade</th>
              <th>Fornecedor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stocks as $stock): ?>
              <tr>
                <td><?= htmlspecialchars($stock['product_name']) ?></td>
                <td><?= htmlspecialchars($stock['size']) ?></td>
                <td><?= htmlspecialchars($stock['color']) ?></td>
                <td class="quantity <?= $stock['stock_quantity'] < 10 ? 'low' : '' ?>">
                  <?= $stock['stock_quantity'] ?>
                </td>
                <td><?= htmlspecialchars($stock['supplier_name'] ?? 'N/A') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <style>
    .stock-table {
      margin-top: 2rem;
      overflow-x: auto;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }
    
    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background: #f8f9fa;
      font-weight: 600;
    }
    
    tr:hover {
      background: #f8f9fa;
    }
    
    .quantity.low {
      color: #c62828;
      font-weight: bold;
    }
  </style>
</body>