<?php
require 'config/database.php';

// verifica se permissão do usuário é diferente de admin
if ($_SESSION['role'] !== "admin") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

$message = '';
$messageType = '';

// Verificar se ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Produto não encontrado.'); window.location.href = '/admin/produtos/listar';</script>";
    exit();
}

$productId = (int)$_GET['id'];

// Buscar produto
$stmt = $db->prepare("SELECT * FROM tatifit_products WHERE id = :id");
$stmt->execute([':id' => $productId]);
$product = $stmt->fetch();

if (!$product) {
    echo "<script>alert('Produto não encontrado.'); window.location.href = '/admin/produtos/listar';</script>";
    exit();
}

// Buscar categorias
$categories = $db->query("SELECT * FROM tatifit_categories ORDER BY name")->fetchAll();

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $old_price = !empty($_POST['old_price']) ? (float)$_POST['old_price'] : null;
    $category_id = (int)$_POST['category_id'];
    $status = $_POST['status'];
    $url_image = $product['url_image']; // Manter imagem atual

    // Validações básicas
    if (empty($name) || empty($price) || empty($category_id)) {
        $message = 'Preencha todos os campos obrigatórios.';
        $messageType = 'error';
    } else {
        try {
            $stmt = $db->prepare("
                UPDATE tatifit_products 
                SET name = :name, description = :description, price = :price, 
                    old_price = :old_price, category_id = :category_id, status = :status,
                    date_update = CURRENT_TIMESTAMP
                WHERE id = :id
            ");
            
            $result = $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':old_price' => $old_price,
                ':category_id' => $category_id,
                ':status' => $status,
                ':id' => $productId
            ]);

            if ($result) {
                $message = 'Produto atualizado com sucesso!';
                $messageType = 'success';
                // Recarregar dados do produto
                $stmt = $db->prepare("SELECT * FROM tatifit_products WHERE id = :id");
                $stmt->execute([':id' => $productId]);
                $product = $stmt->fetch();
            } else {
                $message = 'Erro ao atualizar produto.';
                $messageType = 'error';
            }
        } catch (Exception $e) {
            $message = 'Erro: ' . $e->getMessage();
            $messageType = 'error';
        }
    }
}
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <a href="/admin/produtos/listar">Produtos</a> > <span>Editar Produto</span>
      </nav>
      <a href="/admin/produtos/listar" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a>
      <h1>Editar Produto</h1>
      <p>Atualize as informações do produto.</p>

      <?php if ($message): ?>
        <div class="alert <?= $messageType ?>">
          <?= htmlspecialchars($message) ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="product-form">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nome do Produto *</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
          </div>
          <div class="form-group">
            <label for="category_id">Categoria *</label>
            <select id="category_id" name="category_id" required>
              <option value="">Selecione uma categoria</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Descrição</label>
          <textarea id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="price">Preço *</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="<?= $product['price'] ?>" required>
          </div>
          <div class="form-group">
            <label for="old_price">Preço Anterior</label>
            <input type="number" id="old_price" name="old_price" step="0.01" min="0" value="<?= $product['old_price'] ?>">
          </div>
          <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required>
              <option value="Ativo" <?= $product['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
              <option value="Inativo" <?= $product['status'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
          </div>
        </div>

        <?php if ($product['url_image']): ?>
        <div class="form-group">
          <label>Imagem Atual</label>
          <div class="image-preview">
            <img src="<?= htmlspecialchars($product['url_image']) ?>" alt="Imagem do produto">
          </div>
        </div>
        <?php endif; ?>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Atualizar Produto</button>
        </div>
      </form>
    </div>
  </main>
</body>