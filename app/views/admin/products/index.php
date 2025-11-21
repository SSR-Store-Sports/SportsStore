<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productRegisterd = [
    'name' => trim($_POST['name'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'price' => trim($_POST['price'] ?? ''),
    'old_price' => trim($_POST['old_price'] ?? ''),
    'discount_percent' => trim($_POST['discount_percent'] ?? ''),
    'free_shipping' => trim($_POST['free_shipping'] ?? ''),
    'rating' => trim($_POST['rating'] ?? ''),
    'rating_count' => trim($_POST['rating_count'] ?? ''),
    'installments_info' => trim($_POST['installments_info'] ?? ''),
    'is_new' => trim($_POST['is_new'] ?? ''),
    'amount' => trim($_POST['amount'] ?? ''),
    'status' => trim($_POST['status'] ?? ''),
    'url_image' => trim($_POST['url_image'] ?? ''),
  ];

  try {
    $db->beginTransaction();

    $stmt = $db->prepare("INSERT INTO tatifit_products 
    (name, description, price, old_price, discount_percent, free_shipping, rating, rating_count, installments_info, is_new, amount, status, url_image, author_id)
    VALUES (:name, :description, :price, :old_price, :discount_percent, :free_shipping, :rating, :rating_count, :installments_info, :is_new, :amount, :status, :url_image, :author_id)
  ");

    $params = [
      ':name' => $productRegisterd['name'],
      ':description' => $productRegisterd['description'],
      ':price' => $productRegisterd['price'],
      ':old_price' => $productRegisterd['old_price'],
      ':discount_percent' => $productRegisterd['discount_percent'],
      ':free_shipping' => $productRegisterd['free_shipping'] ? 1 : 0,
      ':rating' => $productRegisterd['rating'],
      ':rating_count' => $productRegisterd['rating_count'],
      ':installments_info' => $productRegisterd['installments_info'],
      ':is_new' => $productRegisterd['is_new'] ? 1 : 0,
      ':amount' => $productRegisterd['amount'],
      ':status' => $productRegisterd['status'],
      ':url_image' => $productRegisterd['url_image'],
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
    <div class="product-card">
      <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a>
      <h1>Cadastro de Produto</h1>
      <p>Adicione um novo item à loja com todas as informações necessárias.</p>

      <?php if ($message): ?>
        <div class="alert success"><?= $message ?></div>
      <?php endif; ?>

      <form action="" method="POST" class="product-form">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nome do Produto</label>
            <input type="text" name="name" id="name" placeholder="Ex: Conjunto Fitness Top + Legging" required>
          </div>

          <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" rows="3" placeholder="Descrição breve do produto"></textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="price">Preço Atual (R$)</label>
            <input type="number" name="price" step="0.01" required>
          </div>
          
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status">
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
          </div>

          <!-- <div class="form-group">
            <label for="old_price">Preço Antigo (R$)</label>
            <input type="number" name="old_price" step="0.01">
          </div> -->
          <!-- <div class="form-group">
            <label for="discount_percent">Desconto (%)</label>
            <input type="number" name="discount_percent" min="0" max="100">
          </div> -->
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="amount">Estoque</label>
            <input type="number" name="amount" min="0">
          </div>

          <div class="form-group">
            <label for="installments_info">Parcelamento</label>
            <input type="text" name="installments_info" placeholder="Ex: 12x de R$ 10,00 sem juros">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="rating">Avaliação Média</label>
            <input type="number" name="rating" step="0.1" min="0" max="5">
          </div>

          <div class="form-group">
            <label for="rating_count">Qtd. de Avaliações</label>
            <input type="number" name="rating_count" min="0">
          </div>
        </div>

        <div class="form-row toggles">
          <label><input type="checkbox" name="free_shipping"> Frete Grátis</label>
          <label><input type="checkbox" name="is_new"> Produto Novo</label>
        </div>

        <div class="form-row image-section">
          <div class="form-group image-input">
            <label for="url_image">URL da Imagem</label>
            <input type="text" name="url_image" id="url_image" placeholder="https://exemplo.com/imagem.jpg"
              oninput="previewImage()">
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
      const url = document.getElementById('url_image').value;
      document.getElementById('preview').src = url || 'https://via.placeholder.com/250x250?text=Pré+visualização';
    }
  </script>
</body>