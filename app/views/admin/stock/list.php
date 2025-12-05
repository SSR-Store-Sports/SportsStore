<?php
require 'config/database.php';

// verifica se permissão do usuário é diferente de admin
if ($_SESSION['role'] !== "admin") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

// Buscar estoque com informações do produto
$query = $db->query("
    SELECT s.*, p.name as product_name, sup.name as supplier_name 
    FROM tatifit_stocks s 
    JOIN tatifit_products p ON s.products_id = p.id 
    LEFT JOIN tatifit_suppliers sup ON s.suppliers_id = sup.id 
    ORDER BY p.name, s.size
");

if ($query === false) {
    die('Erro na consulta SQL');
}

$stocks = $query->fetchAll();
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
              <th>Quantidade</th>
              <th>Fornecedor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stocks as $stock): ?>
              <tr>
                <td><?= htmlspecialchars($stock['product_name']) ?></td>
                <td><span class="size-badge"><?= htmlspecialchars($stock['size']) ?></span></td>
                <td class="quantity <?= $stock['stock_quantity'] < 10 ? 'low' : '' ?>">
                  <?= $stock['stock_quantity'] ?> unidades
                </td>
                <td><?= htmlspecialchars($stock['supplier_name'] ?? 'N/A') ?></td>
                <td>
                  <button class="btn-edit-stock" onclick="editStock(<?= $stock['id'] ?>)">
                    <i class="ph ph-pencil"></i>
                  </button>
                </td>
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
    
    .size-badge {
      background: var(--primary-color);
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }
    
    .btn-edit-stock {
      background: #28a745;
      color: white;
      border: none;
      padding: 8px;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
    }
    
    .btn-edit-stock:hover {
      background: #218838;
    }
    
    @media (max-width: 768px) {
      .stock-table {
        font-size: 0.9rem;
      }
      
      th, td {
        padding: 0.5rem;
      }
    }
  </style>
  <script>
    function editStock(id) {
      // Redirecionar para página de edição de estoque quando implementada
      alert('Função de edição de estoque será implementada em breve.');
    }
  </script>
</body>