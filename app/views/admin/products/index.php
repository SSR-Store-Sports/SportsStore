<?php 
require 'config/database.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->prepare("INSERT INTO tatifit_products 
    (name, descrição, price, old_price, discount_percent, free_shipping, rating, rating_count, installments_info, is_new, amount, status, url_image)
    VALUES (:name, :descricao, :price, :old_price, :discount_percent, :free_shipping, :rating, :rating_count, :installments_info, :is_new, :amount, :status, :url_image)
  ");

  $stmt->execute([
    ':name' => $_POST['name'],
    ':descricao' => $_POST['descricao'],
    ':price' => $_POST['price'],
    ':old_price' => $_POST['old_price'] ?? null,
    ':discount_percent' => $_POST['discount_percent'] ?? null,
    ':free_shipping' => isset($_POST['free_shipping']) ? 1 : 0,
    ':rating' => $_POST['rating'] ?? 0,
    ':rating_count' => $_POST['rating_count'] ?? 0,
    ':installments_info' => $_POST['installments_info'] ?? null,
    ':is_new' => isset($_POST['is_new']) ? 1 : 0,
    ':amount' => $_POST['amount'] ?? 0,
    ':status' => $_POST['status'],
    ':url_image' => $_POST['url_image']
  ]);

  $message = "✅ Produto cadastrado com sucesso!";
}
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <h1>Cadastro de Produto</h1>
      <p>Adicione um novo item à loja com todas as informações necessárias.</p>


      <?php if ($message): ?>
        <div class="alert success"><?= $message ?></div>
      <?php endif; ?>

      <form method="POST" class="product-form">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nome do Produto</label>
            <input type="text" name="name" id="name" placeholder="Ex: Conjunto Fitness Top + Legging" required>
          </div>

          <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" rows="3" placeholder="Descrição breve do produto"></textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="price">Preço Atual (R$)</label>
            <input type="number" name="price" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="old_price">Preço Antigo (R$)</label>
            <input type="number" name="old_price" step="0.01">
          </div>
          <div class="form-group">
            <label for="discount_percent">Desconto (%)</label>
            <input type="number" name="discount_percent" min="0" max="100">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="amount">Estoque</label>
            <input type="number" name="amount" min="0">
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select name="status">
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
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
            <input type="text" name="url_image" id="url_image" placeholder="https://exemplo.com/imagem.jpg" oninput="previewImage()">
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
