<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($products)) {
  $stockData = [
    'size' => trim($_POST['size'] ?? ''),
    'color' => trim($_POST['color'] ?? ''),
    'stock_quantity' => trim($_POST['stock_quantity'] ?? ''),
    'products_id' => trim($_POST['products_id'] ?? ''),
    'suppliers_id' => trim($_POST['suppliers_id'] ?? '') ?: null,
  ];

  try {
    $stmt = $db->prepare("INSERT INTO tatifit_stocks (size, color, stock_quantity, products_id, suppliers_id) VALUES (:size, :color, :stock_quantity, :products_id, :suppliers_id)");
    $stmt->execute($stockData);
    $message = "✅ Estoque cadastrado com sucesso!";
  } catch (Exception $e) {
    $message = "❌ Erro: " . $e->getMessage();
  }
}

// Buscar produtos e fornecedores para os selects
$products = $db->query("SELECT id, name FROM tatifit_products WHERE status = 'Ativo' ORDER BY name")->fetchAll();
$suppliers = $db->query("SELECT id, name FROM tatifit_suppliers ORDER BY name")->fetchAll();

if (empty($products)) {
  $message = "⚠️ Você precisa cadastrar pelo menos um produto antes de gerenciar estoque. <a href='/admin/produtos/cadastrar'>Cadastrar produto</a>";
}
?>

<link rel="stylesheet" href="/app/views/admin/stock/styles.css">

<body>
  <main class="product-page">
    <div class="stocks-header">
      <nav class="breadcrumb">
        <span><a href="/admin">Admin</a></span> > <span>Cadastro de Produto</span>
      </nav>
      <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
    </div>

    <div class="product-card">
      <h1>Cadastro de Estoque</h1>
      <p>Adicione variações de estoque para os produtos.</p>

      <?php if ($message): ?>
        <div class="alert <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>"><?= $message ?></div>
      <?php endif; ?>

      <form action="" method="POST" class="product-form">
        <div class="form-row">
          <div class="form-group">
            <label for="products_id">Produto</label>
            <select name="products_id" required>
              <option value="">Selecione um produto</option>
              <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="suppliers_id">Fornecedor (Opcional)</label>
            <select name="suppliers_id">
              <option value="">Selecione um fornecedor</option>
              <?php foreach ($suppliers as $supplier): ?>
                <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="size">Tamanho</label>
            <select name="size" required>
              <option value="P">P</option>
              <option value="M">M</option>
              <option value="G">G</option>
              <option value="GG">GG</option>
              <option value="XG">XG</option>
            </select>
          </div>

          <div class="form-group">
            <label for="color">Cor</label>
            <select name="color" required>
              <option value="Vermelho">Vermelho</option>
              <option value="Azul">Azul</option>
              <option value="Preto">Preto</option>
              <option value="Branco">Branco</option>
              <option value="Verde">Verde</option>
              <option value="Laranja">Laranja</option>
            </select>
          </div>

          <div class="form-group">
            <label for="stock_quantity">Quantidade</label>
            <input type="number" name="stock_quantity" min="0" required>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Cadastrar Estoque</button>
        </div>
      </form>
    </div>
  </main>
</body>