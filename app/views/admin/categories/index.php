<?php
require 'config/database.php';

// verifica se permissão do usuário é diferente de admin
if ($_SESSION['role'] !== "admin") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');

  if (!empty($name)) {
    try {
      $stmt = $db->prepare("INSERT INTO tatifit_categories (name) VALUES (:name)");
      $stmt->execute([':name' => $name]);
      $message = "✅ Categoria cadastrada com sucesso!";
    } catch (Exception $e) {
      $message = "❌ Erro: " . $e->getMessage();
    }
  } else {
    $message = "❌ Nome da categoria é obrigatório!";
  }
}

// Buscar categorias existentes
$categories = $db->query("SELECT * FROM tatifit_categories ORDER BY name")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/categories/styles.css">

<body>
  <main class="product-page">
    <div class="categories-header">
            <nav class="breadcrumb">
                <span><a href="/admin">Admin</a></span> > <span>Cadastro de Produto</span>
            </nav>
            <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
        </div>


    <div class="product-card">
      <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a>
      <h1>Cadastro de Categoria</h1>
      <p>Adicione uma nova categoria de produtos.</p>

      <?php if ($message): ?>
        <div class="alert <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>"><?= $message ?></div>
      <?php endif; ?>

      <form action="" method="POST" class="product-form">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nome da Categoria</label>
            <input type="text" name="name" id="name" placeholder="Ex: Conjuntos, Camisetas" required>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Cadastrar Categoria</button>
        </div>
      </form>

      <h2>Categorias Existentes</h2>
      <div class="categories-list">
        <?php foreach ($categories as $category): ?>
          <div class="category-item"><?= htmlspecialchars($category['name']) ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>
</body>