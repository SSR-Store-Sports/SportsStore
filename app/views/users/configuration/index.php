<?php

if (empty($_SESSION['email'])) {
    echo "<script>window.location.href = '/auth/login';</script>";
    exit();
}

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
            <h2><?= htmlspecialchars($_SESSION['name'] ?? 'Usuário') ?></h2>
            <p><?= htmlspecialchars($_SESSION['email'] ?? 'email@exemplo.com') ?></p>
          </div>
        </div>

        <nav>
          <button class="menu-item active">Informações Pessoais</button>
          <button class="menu-item">Endereços</button>
          <button class="menu-item">Histórico Pedidos</button>
          <button class="menu-item">Pagamentos</button>
        </nav>
      </aside>

      <main class="config-content">
        <form action="/user/update" method="POST" class="form">
          <h3>Informações Pessoais</h3>

          <div class="form-row">
            <div class="form-group">
              <label for="name">Nome completo</label>
              <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone'] ?? '') ?>">
            </div>

            <div class="form-group">
              <label for="cpf">CPF</label>
              <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($user['cpf'] ?? '') ?>">
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
            <button type="submit" class="btn-save">Salvar Alterações</button>
            <a href="/auth/logout" class="btn-logout">Sair da Conta</a>
          </div>
        </form>
      </main>
    </div>
  </section>
</body>
