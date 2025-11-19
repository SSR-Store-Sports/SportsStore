<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_SESSION['name'];
  $message = "";
  // echo "<pre>POST recebido: ";
  // var_dump($_POST);
  // echo "</pre>";

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
    (name, descrição, price, old_price, discount_percent, free_shipping, rating, rating_count, installments_info, is_new, amount, status, url_image)
    VALUES (:name, :descricao, :price, :old_price, :discount_percent, :free_shipping, :rating, :rating_count, :installments_info, :is_new, :amount, :status, :url_image)
  ");

    $stmtUser->execute([
      ':name' => $productRegisterd['name'],
      ':descricao' => $productRegisterd['description'],
      ':price' => $productRegisterd['price'],
      ':old_price' => $productRegisterd['old_price'],
      ':discount_percent' => $productRegisterd['discount_percent'],
      ':role' => 'user',
    ]);

    $message = "✅ Produto cadastrado com sucesso!";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {


  try {
    $db->beginTransaction();

    // Inserir usuário
    $sqlOnlyUser = 'INSERT INTO tatifit_users (name, email, password, telefone, cpf, role) VALUES (:name, :email, :password, :telefone, :cpf, :role)';
    $stmtUser = $db->prepare($sqlOnlyUser);
    $stmtUser->execute([
      ':name' => $userRegistered['name'],
      ':email' => $userRegistered['email'],
      ':password' => password_hash($userRegistered['password'], PASSWORD_DEFAULT),
      ':telefone' => $userRegistered['phone'],
      ':cpf' => $userRegistered['cpf'],
      ':role' => 'user',
    ]);

    $lastUserId = $db->lastInsertId();
    $sqlOnlyAddress = 'INSERT INTO tatifit_users_address (type, cep, street, neighborhood, number, city, state, user_id) VALUES (:type, :cep, :street, :neighborhood, :number, :city, :state, :user_id)';
    $stmtAddress = $db->prepare($sqlOnlyAddress);
    $stmtAddress->execute([
      ':type' => 'Residencial',
      ':cep' => $userRegistered['cep'],
      ':street' => $userRegistered['street'],
      ':neighborhood' => $userRegistered['neighborhood'],
      ':number' => $userRegistered['number'],
      ':city' => $userRegistered['city'],
      ':state' => $userRegistered['state'],
      ':user_id' => $lastUserId,
    ]);

    $db->commit();
    echo "<script>window.location.href = '/check';</script>";
    exit();
  } catch (PDOException $e) {
    $db->rollback();
    echo "Erro: " . $e->getMessage();
  }
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

      <form action="" method="POST" class="product-form">
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