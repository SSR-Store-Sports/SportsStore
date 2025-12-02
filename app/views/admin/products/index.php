<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

$categories = $db->query("SELECT id, name FROM tatifit_categories ORDER BY name")->fetchAll();
if (empty($categories)) {
  $message = "⚠️ Você precisa cadastrar pelo menos uma categoria antes de adicionar produtos. <a href='/admin/categorias/cadastrar'>Cadastrar categoria</a>";
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($categories)) {
  $uploadedImage = '';

  if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!in_array($_FILES['product_image']['type'], $allowedTypes)) {
      $message = "❌ Apenas arquivos JPG, JPEG e PNG são permitidos.";
    } elseif ($_FILES['product_image']['size'] > $maxSize) {
      $message = "❌ Arquivo muito grande. Máximo 5MB.";
    } else {
      $uploadDir = 'public/uploads/products/';
      $fileName = uniqid() . '_' . basename($_FILES['product_image']['name']);
      $uploadPath = $uploadDir . $fileName;

      if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadPath)) {
        $uploadedImage = '/public/uploads/products/' . $fileName;
      } else {
        $message = "❌ Erro ao fazer upload da imagem.";
      }
    }
  } else {
    $message = "❌ Imagem é obrigatória.";
  }

  $productRegisterd = [
    'name' => trim($_POST['name'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'price' => trim($_POST['price'] ?? ''),
    'category_id' => trim($_POST['category_id'] ?? ''),
    'free_shipping' => trim($_POST['free_shipping'] ?? ''),
    'installments_info' => trim($_POST['installments_info'] ?? ''),
    'is_new' => trim($_POST['is_new'] ?? ''),

    'status' => trim($_POST['status'] ?? ''),
    'url_image' => $uploadedImage,
  ];

  try {
    $db->beginTransaction();

    $stmt = $db->prepare("INSERT INTO tatifit_products 
    (name, description, price, free_shipping, installments_info, is_new, status, url_image, category_id, author_id)
    VALUES (:name, :description, :price, :free_shipping, :installments_info, :is_new, :status, :url_image, :category_id, :author_id)
  ");

    $params = [
      ':name' => $productRegisterd['name'],
      ':description' => $productRegisterd['description'],
      ':price' => $productRegisterd['price'],
      ':free_shipping' => $productRegisterd['free_shipping'] ? 1 : 0,
      ':installments_info' => $productRegisterd['installments_info'],
      ':is_new' => $productRegisterd['is_new'] ? 1 : 0,
      ':status' => $productRegisterd['status'],
      ':url_image' => $productRegisterd['url_image'],
      ':category_id' => $productRegisterd['category_id'],
      ':author_id' => $_SESSION['user_id'],
    ];

    $result = $stmt->execute($params);

    $db->commit();
    $message = "✅ Produto cadastrado com sucesso!";
  } catch (Exception $e) {
    $db->rollback();
    echo "Erro: " . $e->getMessage();
  }
}

?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="products-header">
      <nav class="breadcrumb">
        <span><a href="/admin">Admin</a></span> > <span>Cadastro de Produto</span>
      </nav>
      <!-- <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a> -->
    </div>

    <div class="product-card">
      <h1>Cadastro de Produto</h1>
      <p>Adicione um novo item à loja com todas as informações necessárias.</p>

      <?php if ($message): ?>
        <div class="alert <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>"><?= $message ?></div>
      <?php endif; ?>

      <form action="" method="POST" class="product-form" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nome do Produto</label>
            <input type="text" name="name" id="name" placeholder="Ex: Conjunto Fitness Top + Legging" required>
          </div>

          <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" required>
              <option value="">Selecione uma categoria</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="hr3"></div>

        <div class="form-row">
          <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" rows="3" placeholder="Descrição breve do produto"></textarea>
          </div>
        </div>

        <div class="hr3"></div>

        <div class="form-row">
          <div class="form-group">
            <label for="price">Preço (R$)</label>
            <input type="number" name="price" step="0.01" required>
          </div>

          <div class="form-group">
            <label for="installments_info">Parcelamento</label>
            <select name="installments_info">
              <option value="À vista">À vista</option>
              <option value="2x sem juros">2x sem juros</option>
              <option value="3x sem juros">3x sem juros</option>
              <option value="6x sem juros">6x sem juros</option>
              <option value="10x sem juros">10x sem juros</option>
              <option value="12x sem juros">12x sem juros</option>
            </select>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select name="status">
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
          </div>
        </div>

        <div class="hr3"></div>

        <div class="form-row toggles">
          <label><input type="checkbox" name="free_shipping"> Frete Grátis</label>
          <label><input type="checkbox" name="is_new"> Produto Novo</label>
        </div>

        <div class="form-row image-section">
          <div class="form-group image-input">
            <label>Imagem do Produto</label>
            <div class="upload-area" onclick="document.getElementById('product_image').click()">
              <i class="ph ph-upload"></i>
              <p>Clique aqui para fazer upload</p>
              <span>PNG, JPG ou JPEG (máx. 5MB)</span>
            </div>
            <input type="file" name="product_image" id="product_image" accept="image/*" onchange="previewImage()" style="display: none;" required>
          </div>
          <div class="image-preview">
            <img id="preview" src="https://via.placeholder.com/250x250?text=Pré+visualização" alt="Pré-visualização">
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Cadastrar Produto</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    function previewImage() {
      const file = document.getElementById('product_image').files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>