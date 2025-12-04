<?php
require 'config/database.php';

if (empty($_SESSION['user_id'])) {
  echo "<script>alert('Você precisa estar logado.'); window.location.href = '/auth/login';</script>";
  exit();
}

$userId = $_SESSION['user_id'];

// itens do carrinho da sessão
$cartItems = $_SESSION['cart'] ?? [];
$totalPrice = 0;
foreach ($cartItems as $item) {
  $totalPrice += $item['price'] * $item['quantity'];
}

// endereço do usuário
$stmt = $db->prepare("SELECT * FROM tatifit_users_address WHERE user_id = :user_id LIMIT 1");
$stmt->execute([':user_id' => $userId]);
$address = $stmt->fetch();

// Processar cadastro de novo endereço
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_address'])) {
  $addressData = [
    ':cep' => trim($_POST['cep'] ?? ''),
    ':street' => trim($_POST['street'] ?? ''),
    ':number' => trim($_POST['number'] ?? '') ?: null,
    ':complement' => trim($_POST['complement'] ?? '') ?: null,
    ':neighborhood' => trim($_POST['neighborhood'] ?? ''),
    ':city' => trim($_POST['city'] ?? ''),
    ':state' => trim($_POST['state'] ?? ''),
    ':recipient_name' => trim($_POST['recipient_name'] ?? ''),
    ':contact_phone' => trim($_POST['contact_phone'] ?? ''),
    ':type' => trim($_POST['type'] ?? 'Casa'),
    ':user_id' => $userId
  ];

  try {
    if ($address) {
      // atualizar existente
      $stmt = $db->prepare("UPDATE tatifit_users_address SET cep = :cep, street = :street, number = :number, complement = :complement, neighborhood = :neighborhood, city = :city, state = :state, recipient_name = :recipient_name, contact_phone = :contact_phone, type = :type WHERE user_id = :user_id");
      $stmt->execute($addressData);
    } else {
      // inserir endereço novo
      $stmt = $db->prepare("INSERT INTO tatifit_users_address (cep, street, number, complement, neighborhood, city, state, recipient_name, contact_phone, type, user_id) VALUES (:cep, :street, :number, :complement, :neighborhood, :city, :state, :recipient_name, :contact_phone, :type, :user_id)");
      $stmt->execute($addressData);
    }
    echo "<script>alert('✅ Endereço salvo com sucesso!'); window.location.href = '/endereco';</script>";
    exit();
  } catch (Exception $e) {
    $error = "Erro ao salvar endereço: " . $e->getMessage();
  }
}
?>

<link rel="stylesheet" href="/app/views/users/address/styles.css">

<body>
  <div class="address-header">
    <div class="header-content">
      <h1><i class="ph ph-map-pin"></i> Endereço de entrega</h1>
      <p>Confirme ou cadastre seu endereço para finalizar a compra</p>
    </div>

    <div class="checkout-progress">
      <div class="progress-step completed">
        <div class="step-circle"><i class="ph ph-check"></i></div>
        <span>Carrinho</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step active">
        <div class="step-circle">2</div>
        <span>Endereço</span>
      </div>
      <div class="progress-line"></div>
      <div class="progress-step">
        <div class="step-circle">3</div>
        <span>Pagamento</span>
      </div>
      <div class="progress-line"></div>
      <div class="progress-step">
        <div class="step-circle">4</div>
        <span>Confirmação</span>
      </div>
    </div>
  </div>
  
  <main class="address-main">
    <section class="address-content">
      <div class="address-items">
        <h2><i class="ph ph-package"></i>Resumo do pedido</h2>

        <?php if (empty($cartItems)): ?>
          <p>Carrinho vazio</p>
        <?php else: ?>
          <?php foreach ($cartItems as $item): ?>
            <div class="item">
              <div class="item-image">
                <img src="<?= htmlspecialchars($item['image'] ?? '/public/images/product.jpg') ?>"
                  alt="<?= htmlspecialchars($item['name']) ?>">
              </div>
              <div class="item-details">
                <h3><?= htmlspecialchars($item['name']) ?></h3>
                <p class="item-size">Qtd: <?= $item['quantity'] ?></p>
                <div class="price-current">R$ <?= number_format($item['price'], 2, ',', '.') ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <div class="order-summary">
          <p>Subtotal: <strong>R$ <?= number_format($totalPrice, 2, ',', '.') ?></strong></p>
          <p>Frete: <strong>Grátis</strong></p>
          <hr>
          <p>Total: <strong>R$ <?= number_format($totalPrice, 2, ',', '.') ?></strong></p>
        </div>

        <!-- <div class="discount-code">
          <input type="text" placeholder="Digite seu cupom" />
          <button class="btn-apply-coupon">
            <span data-text="Aplicar Cupom">Aplicar Cupom</span>
            <div class="scan-line"></div>
          </button>
        </div> -->

        <div class="add-address">
          <h2>Finalize seu pedido com o endereço perfeito!</h2>

          <button id="add-address-button" class="btn-add-address">
            <i class="ph ph-plus"></i>
          </button>

          <form id="address-form" class="address-form" method="POST">
            <h3><?= $address ? 'Editar endereço' : 'Cadastre seu endereço' ?></h3>

            <input type="text" name="recipient_name" placeholder="Nome completo"
              value="<?= htmlspecialchars($address['recipient_name'] ?? '') ?>" required />
            <input type="text" name="cep" placeholder="CEP" value="<?= htmlspecialchars($address['cep'] ?? '') ?>"
              required />
            <input type="text" name="street" placeholder="Endereço"
              value="<?= htmlspecialchars($address['street'] ?? '') ?>" required />
            <input type="text" name="number" placeholder="Número"
              value="<?= htmlspecialchars($address['number'] ?? '') ?>" />
            <input type="text" name="complement" placeholder="Complemento (opcional)"
              value="<?= htmlspecialchars($address['complement'] ?? '') ?>" />
            <input type="text" name="neighborhood" placeholder="Bairro"
              value="<?= htmlspecialchars($address['neighborhood'] ?? '') ?>" required />
            <input type="text" name="city" placeholder="Cidade" value="<?= htmlspecialchars($address['city'] ?? '') ?>"
              required />
            <input type="text" name="state" placeholder="Estado"
              value="<?= htmlspecialchars($address['state'] ?? '') ?>" required />
            <input type="text" name="contact_phone" placeholder="Telefone"
              value="<?= htmlspecialchars($address['contact_phone'] ?? '') ?>" required />
            <select name="type" required>
              <option value="Casa" <?= ($address['type'] ?? '') === 'Casa' ? 'selected' : '' ?>>Casa</option>
              <option value="Trabalho" <?= ($address['type'] ?? '') === 'Trabalho' ? 'selected' : '' ?>>Trabalho</option>
              <option value="Outro" <?= ($address['type'] ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
            </select>

            <input type="hidden" name="save_address" value="1">
            <button type="submit" class="btn-save-address">Salvar Endereço</button>
          </form>
        </div>
      </div>
    </section>

    <section class="address-details">
      <div class="address-info-block">
        <h2 class="address-info-title">
          <i class="ph ph-map-pin-plus"></i> Endereço
        </h2>

        <div class="delivery-address">
          <?php if ($address): ?>
            <p><strong>Nome:</strong> <?= htmlspecialchars($address['recipient_name']) ?></p>
            <p><strong>Rua:</strong> <?= htmlspecialchars($address['street']) ?></p>
            <p><strong>Número:</strong> <?= htmlspecialchars($address['number'] ?? 'S/N') ?></p>
            <p><strong>Bairro:</strong> <?= htmlspecialchars($address['neighborhood']) ?></p>
            <p><strong>Cidade:</strong> <?= htmlspecialchars($address['city']) ?></p>
            <p><strong>Estado:</strong> <?= htmlspecialchars($address['state']) ?></p>
            <p><strong>CEP:</strong> <?= htmlspecialchars($address['cep']) ?></p>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($address['contact_phone']) ?></p>
          <?php else: ?>
            <p>Nenhum endereço cadastrado. Use o formulário acima para adicionar.</p>
          <?php endif; ?>
        </div>

        <!-- Novo botão de edição -->
        <!-- <button class="btn-edit-address"><span>Editar Endereço</span></button> -->

        <!-- Mapa -->
        <div class="address-map" id="map">
          <?php if ($address): ?>
            <iframe width="100%" height="300" frameborder="0" style="border:0; border-radius: 12px;"
              src="https://www.openstreetmap.org/export/embed.html?bbox=-46.7,-23.6,-46.6,-23.5&layer=mapnik&marker=-23.55,-46.65">
            </iframe>
          <?php else: ?>
            <div class="map-placeholder">
              <i class="ph ph-map-pin"></i>
              <p>Cadastre um endereço para ver no mapa</p>
            </div>
          <?php endif; ?>
        </div>

        <button class="btn-confirm-address">Confirmar Endereço</button>
      </div>

      <!-- ===== Selos de segurança ===== -->
      <div class="trust-badges">
        <img src="public/images/verificar.png" alt="Site Seguro">
        <img src="public/images/cartao-de-credito.png" alt="Formas de pagamento">
      </div>
    </section>
  </main>

  <!-- ===========================
       SCRIPT: INTERAÇÃO DO FORMULÁRIO
  ============================ -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addButton = document.getElementById('add-address-button');
      const form = document.getElementById('address-form');
      const icon = addButton.querySelector('i');
      const cepInput = document.querySelector('input[name="cep"]');

      addButton.addEventListener('click', () => {
        form.classList.toggle('show');
        icon.classList.toggle('ph-plus');
        icon.classList.toggle('ph-x');
      });

      // Busca CEP automaticamente
      if (cepInput) {
        cepInput.addEventListener('blur', function() {
          const cep = this.value.replace(/\D/g, '');
          if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
              .then(response => response.json())
              .then(data => {
                if (!data.erro) {
                  document.querySelector('input[name="street"]').value = data.logradouro;
                  document.querySelector('input[name="neighborhood"]').value = data.bairro;
                  document.querySelector('input[name="city"]').value = data.localidade;
                  document.querySelector('input[name="state"]').value = data.uf;
                  updateMap(data);
                }
              })
              .catch(() => console.log('Erro ao buscar CEP'));
          }
        });
      }

      // Confirmar endereço
      document.querySelector('.btn-confirm-address').addEventListener('click', function() {
        <?php if ($address): ?>
          window.location.href = '/pagamento';
        <?php else: ?>
          alert('Cadastre um endereço primeiro');
          form.classList.add('show');
        <?php endif; ?>
      });
    });

    function updateMap(data) {
      // Mapa estático do OpenStreetMap (gratuito)
      const mapContainer = document.getElementById('map');
      mapContainer.innerHTML = `
        <iframe width="100%" height="300" frameborder="0" style="border:0; border-radius: 12px;"
          src="https://www.openstreetmap.org/export/embed.html?bbox=-46.7,-23.6,-46.6,-23.5&layer=mapnik">
        </iframe>
        <div class="map-info">
          <p><i class="ph ph-map-pin"></i> ${data.logradouro}, ${data.bairro} - ${data.localidade}/${data.uf}</p>
        </div>
      `;
    }
  </script>
</body>