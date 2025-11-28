<?php

if (empty($_SESSION['email'])) {
  echo "<script>window.location.href = '/auth/login';</script>";
  exit();
}

require 'config/database.php';

$userID = trim($_SESSION['user_id'] ?? '');
$message = "";

if ($userID) {
  try {
    $stmt = $db->prepare("SELECT * FROM tatifit_users WHERE id = :userID");
    $stmt->execute([':userID' => $userID]);
    $user = $stmt->fetch();

    if ($user) {
      $response = $user;
    } else {
      $error = 'Usuário não encontrado!';
    }

  } catch (PDOException $e) {
    // Tratamento de erro robusto
    error_log("Erro de Obter Perfil de Usuário no BD: " . $e->getMessage());
    $error = "Ocorreu um erro ao tentar obter perfil de usuário. Tente novamente mais tarde.";
  }
};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $password = trim($_POST['password'] ?? '');
  $passwordConfirm = trim($_POST['confirm-password'] ?? '');

  if ($password === $passwordConfirm) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
      $stmt = $db->prepare("UPDATE tatifit_users SET password = :password WHERE id = :userID");
      $stmt->execute([':password' => $passwordHash, ':userID' => $userID]);

      $message = ($stmt->rowCount() > 0) ? 'Senha atualizada com sucesso!' : 'Nenhuma alteração realizada.';
    } catch (PDOException $e) {
      error_log("Erro de Atualizar Senha no BD: " . $e->getMessage());
      $message = "Ocorreu um erro ao tentar atualizar a senha. Tente novamente mais tarde.";
    }
  } else {
    $message = 'As senhas não coincidem!';
  }
};

?>

<link rel="stylesheet" href="/app/views/users/configuration/styles.css">

<body>
  <section class="user-config">
    <div class="config-header">
      <h1>Configurações da Conta</h1>
      <p>Gerencie suas informações pessoais, endereços e preferências de compra.</p>
    </div>

    <div class="config-container">
      <aside class="config-menu">
        <div class="profile">
          <!-- <img src="/public/images/user-default.png" alt="Usuário" class="avatar"> -->
          <div class="profile-info">
            <h2><?= htmlspecialchars($_response['name'] ?? 'Usuário') ?></h2>
            <p><?= htmlspecialchars($response['email'] ?? 'email@exemplo.com') ?></p>
          </div>
        </div>

        <nav>
          <button class="menu-item active">Informações Pessoais</button>
          <!-- <button class="menu-item">Endereços</button>
          <button class="menu-item">Histórico Pedidos</button>
          <button class="menu-item">Pagamentos</button> -->
        </nav>
      </aside>

      <main class="config-content">
        <form method="POST" class="form">
          <h3>Informações Pessoais</h3>

          <div class="form-row">
            <div class="form-group">
              <label for="name">Nome completo</label>
              <input disabled type="text" id="name" name="name" value="<?= htmlspecialchars($response['name'] ?? '') ?>">
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input disabled type="email" id="email" name="email" value="<?= htmlspecialchars($response['email'] ?? '') ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input disabled type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($response['phone'] ?? '') ?>">
            </div>

            <div class="form-group">
              <label for="cpf">CPF</label>
              <input disabled type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($response['cpf'] ?? '') ?>">
            </div>
          </div>

          <h3>Alterar Senha</h3>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Nova senha</label>
              <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
              <label for="confirm-password">Confirmar senha</label>
              <input type="password" id="confirm-password" name="confirm-password">
            </div>
          </div>

          <div class="form-actions">
            <?php if (isset($message) && !empty($message)): ?>
              <div class="error-container">
                <p class="error"><?= $message ?></p>
              </div>
            <?php endif; ?>

            <button type="submit" class="btn-save">Salvar Alterações</button>
            <a href="/auth/logout" class="btn-logout">Sair da Conta</a>
          </div>
        </form>
      </main>
    </div>
  </section>
</body>