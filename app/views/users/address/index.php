<?php
require 'config/database.php';

// Verificar se usuário está logado
if (empty($_SESSION['user_id'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location.href = '/auth/login';</script>";
    exit();
}

$userId = $_SESSION['user_id'];

// Buscar itens do carrinho da sessão
$cartItems = $_SESSION['cart'] ?? [];
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

// Buscar endereço do usuário
$stmt = $db->prepare("SELECT * FROM tatifit_users_address WHERE user_id = :user_id LIMIT 1");
$stmt->execute([':user_id' => $userId]);
$address = $stmt->fetch();

// Processar cadastro de novo endereço
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_address'])) {
    $addressData = [
        'cep' => trim($_POST['cep'] ?? ''),
        'street' => trim($_POST['street'] ?? ''),
        'number' => trim($_POST['number'] ?? ''),
        'complement' => trim($_POST['complement'] ?? ''),
        'neighborhood' => trim($_POST['neighborhood'] ?? ''),
        'city' => trim($_POST['city'] ?? ''),
        'state' => trim($_POST['state'] ?? ''),
        'recipient_name' => trim($_POST['recipient_name'] ?? ''),
        'contact_phone' => trim($_POST['contact_phone'] ?? ''),
        'type' => 'Casa'
    ];
    
    try {
        if ($address) {
            // Atualizar endereço existente
            $stmt = $db->prepare("UPDATE tatifit_users_address SET cep = :cep, street = :street, number = :number, complement = :complement, neighborhood = :neighborhood, city = :city, state = :state, recipient_name = :recipient_name, contact_phone = :contact_phone WHERE user_id = :user_id");
            $addressData[':user_id'] = $userId;
            $stmt->execute($addressData);
        } else {
            // Inserir novo endereço
            $stmt = $db->prepare("INSERT INTO tatifit_users_address (cep, street, number, complement, neighborhood, city, state, recipient_name, contact_phone, type, user_id) VALUES (:cep, :street, :number, :complement, :neighborhood, :city, :state, :recipient_name, :contact_phone, :type, :user_id)");
            $addressData[':type'] = 'Casa';
            $addressData[':user_id'] = $userId;
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
<!-- ===========================
     CABEÇALHO DA PÁGINA
=========================== -->
<div class="address-header">
  <h1>Endereço de entrega</h1>

  <!-- ===== Barra de Progresso do Checkout ===== -->
  <div class="checkout-progress">
    <ul>
      <li class="active">Carrinho</li>
      <li class="active current">Endereço</li>
      <li>Pagamento</li>
      <li>Confirmação</li>
    </ul>
  </div>
</div>



  <main class="address-main">
    <!-- ===========================
         SEÇÃO: RESUMO DO PEDIDO
    ============================ -->
    <section class="address-content">
      <div class="address-items">
        <h2><i class="ph ph-package"></i>Resumo do pedido</h2>

        <?php if (empty($cartItems)): ?>
          <p>Carrinho vazio</p>
        <?php else: ?>
          <?php foreach ($cartItems as $item): ?>
          <div class="item">
            <div class="item-image">
              <img src="<?= htmlspecialchars($item['image'] ?? '/public/images/product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
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

        <!-- ===== Cupom de Desconto ===== -->
        <div class="discount-code">
          <input type="text" placeholder="Digite seu cupom" />
          <button class="btn-apply-coupon">
            <span data-text="Aplicar Cupom">Aplicar Cupom</span>
            <div class="scan-line"></div>
          </button>
        </div>

        <!-- ===========================
             SEÇÃO: ADICIONAR ENDEREÇO
        ============================ -->
        <div class="add-address">
          <h2>Finalize seu pedido com o endereço perfeito!</h2>

          <!-- Botão que exibe/esconde o formulário -->
          <button id="add-address-button" class="btn-add-address">
            <i class="ph ph-plus"></i>
          </button>

          <form id="address-form" class="address-form" method="POST">
            <h3><?= $address ? 'Editar endereço' : 'Cadastre seu endereço' ?></h3>

            <input type="text" name="recipient_name" placeholder="Nome completo" value="<?= htmlspecialchars($address['recipient_name'] ?? '') ?>" required />
            <input type="text" name="cep" placeholder="CEP" value="<?= htmlspecialchars($address['cep'] ?? '') ?>" required />
            <input type="text" name="street" placeholder="Endereço" value="<?= htmlspecialchars($address['street'] ?? '') ?>" required />
            <input type="text" name="number" placeholder="Número" value="<?= htmlspecialchars($address['number'] ?? '') ?>" />
            <input type="text" name="complement" placeholder="Complemento (opcional)" value="<?= htmlspecialchars($address['complement'] ?? '') ?>" />
            <input type="text" name="neighborhood" placeholder="Bairro" value="<?= htmlspecialchars($address['neighborhood'] ?? '') ?>" required />
            <input type="text" name="city" placeholder="Cidade" value="<?= htmlspecialchars($address['city'] ?? '') ?>" required />
            <input type="text" name="state" placeholder="Estado" value="<?= htmlspecialchars($address['state'] ?? '') ?>" required />
            <input type="text" name="contact_phone" placeholder="Telefone" value="<?= htmlspecialchars($address['contact_phone'] ?? '') ?>" required />

            <input type="hidden" name="save_address" value="1">
            <button type="submit" class="btn-save-address">Salvar Endereço</button>
          </form>
        </div>
      </div>
    </section>

    <!-- ===========================
         SEÇÃO: DETALHES DO ENDEREÇO
    ============================ -->
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
        <button class="btn-edit-address"><span>Editar Endereço</span></button>

        <!-- Mapa ilustrativo -->
        <div class="address-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3473.6088428075577!2d-46.69501382022828!3d-23.660689023892804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce50402ebbf84f%3A0xa5d75dec15d9823f!2sR.%20Arlindo%20Veiga%20dos%20Santos%20-%20Campo%20Grande%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004671-300!5e1!3m2!1spt-BR!2sbr!4v1762366036614!5m2!1spt-BR!2sbr"
            width="100%"
            height="300"
            style="border:0; border-radius: 12px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
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
    const addButton = document.getElementById('add-address-button');
    const form = document.getElementById('address-form');
    const icon = addButton.querySelector('i');

    addButton.addEventListener('click', () => {
      form.classList.toggle('show');
      if (form.classList.contains('show')) {
        icon.classList.replace('ph-plus', 'ph-x');
      } else {
        icon.classList.replace('ph-x', 'ph-plus');
      }
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      alert("✅ Endereço cadastrado com sucesso!");
      form.classList.remove('show');
      icon.classList.replace('ph-x', 'ph-plus');
    });
  </script>
</body>
