<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Buscar fornecedores
$suppliers = $db->query("SELECT * FROM tatifit_suppliers ORDER BY name")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <span>Lista de Fornecedores</span>
      </nav>
      <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
      <h1>Lista de Fornecedores</h1>
      <p>Todos os fornecedores cadastrados no sistema.</p>

      <div class="suppliers-table">
        <table>
          <thead>
            <tr>
              <th>Nome</th>
              <th>Telefone</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($suppliers as $supplier): ?>
              <tr>
                <td><?= htmlspecialchars($supplier['name']) ?></td>
                <td><?= htmlspecialchars($supplier['telephone']) ?></td>
                <td><?= htmlspecialchars($supplier['type']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <style>
    .suppliers-table {
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
  </style>
</body>