<?php

$name = trim($_SESSION['name'] ?? "");
$email = trim($_SESSION['email'] ?? "");
$role = trim($_SESSION['role'] ?? "");

?>

<link rel="stylesheet" href="/app/views/_components/sidebar/styles.css">

<div class="sidebar-overlay" id="sidebarOverlay"></div>
<aside class="sidebar" id="sidebar">
  <nav class="sidebar-nav">

    <div class="nav-section">
      <h4>Navegação</h4>
      <ul>
        <li><a href="/"><i class="ph ph-house"></i>Home</a></li>
        <li><a href="/produtos"><i class="ph ph-package"></i>Produtos</a></li>
        <li><a href="/carrinho"><i class="ph ph-shopping-cart"></i>Carrinho</a></li>
      </ul>
    </div>

    <div class="nav-section">
      <h4>Conta</h4>
      <ul>
        <?php if (empty($email)): ?>
          <li><a href="/auth/login"><i class="ph ph-sign-in"></i>Login</a></li>
          <li><a href="/auth/registro"><i class="ph ph-user-plus"></i>Cadastrar</a></li>
        <?php else: ?>
          <li><a href="/historico"><i class="ph ph-clock-clockwise"></i>Histórico</a></li>
          <li><a href="/acompanhamento"><i class="ph ph-map-pin"></i>Acompanhamento</a></li>
          <li><a href="/users/"><i class="ph ph-gear"></i>Configurações</a></li>
          <li><a href="/auth/logout"><i class="ph ph-sign-out"></i>Sair</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <?php if (isset($role) && $role === 'admin'): ?>
      <div class="nav-section">
        <h4>Administração</h4>
        <ul>
          <li><a href="/admin"><i class="ph ph-gauge"></i>Painel Administrativo</a></li>
        </ul>
      </div>
    <?php endif; ?>

    <div class="nav-section">
      <h4>Base de Conhecimento</h4>
      <ul>
        <li><a href="/"><i class="ph ph-ruler"></i>Guia de tamanhos</a></li>
        <li><a href="/"><i class="ph ph-heart"></i>Como cuidar das peças</a></li>
        <li><a href="/"><i class="ph ph-arrow-clockwise"></i>Política de trocas</a></li>
      </ul>
    </div>

    <div class="nav-section">
      <h4>Termos de Serviço</h4>
      <ul>
        <li><a href="/"><i class="ph ph-file-text"></i>Termos</a></li>
        <li><a href="/"><i class="ph ph-shield-check"></i>Privacidade</a></li>
      </ul>
    </div>
  </nav>

  <div class="sidebar-header">
    <div class="user-info">
      <div class="user-avatar">
        <i class="ph ph-user"></i>
      </div>
      <div class="user-details">
        <?php if ($email): ?>
          <h3>Olá, <?= $name ?></h3>
          <p><?= $email; ?></p>
        <?php else: ?>
          <h3>Minha Conta</h3>
          <p>Bem-vindo. <a href="/auth/login">Entre agora!</a></p>
        <?php endif; ?>
      </div>
    </div>
    <button class="sidebar-close" id="sidebarClose">
      <i class="ph ph-x"></i>
    </button>
  </div>
</aside>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarClose = document.getElementById('sidebarClose');

    function openSidebar() {
      sidebar.classList.add('active');
      sidebarOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
      sidebar.classList.remove('active');
      sidebarOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    menuToggle?.addEventListener('click', openSidebar);
    sidebarClose?.addEventListener('click', closeSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);
  });
</script>