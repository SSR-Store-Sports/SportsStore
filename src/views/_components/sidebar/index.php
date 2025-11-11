<link rel="stylesheet" href="/app/views/_components/sidebar/styles.css">

<div class="sidebar-overlay" id="sidebarOverlay"></div>
<aside class="sidebar" id="sidebar">
  <nav class="sidebar-nav">
    <div class="nav-section">
      <h4>Navegação</h4>
      <ul>
        <li><a href="/"><i class="ph ph-house"></i> Home</a></li>
        <li><a href="/produtos"><i class="ph ph-package"></i> Produtos</a></li>
        <li><a href="/carrinho"><i class="ph ph-shopping-cart"></i> Carrinho</a></li>
        <li><a href="/check">check</a></li>
      </ul>
    </div>

    <div class="nav-section">
      <h4>Conta</h4>
      <ul>
        <li><a href="/auth/login"><i class="ph ph-sign-in"></i> Login</a></li>
        <li><a href="/auth/registro"><i class="ph ph-user-plus"></i> Cadastrar</a></li>
        <li><a href="/configuracoes"><i class="ph ph-user-plus"></i> Meu endereço</a></li>
        <li><a href="/configuracoes"><i class="ph ph-gear"></i> Configurações</a></li>
        <li><a href="/endereco"><i class="ph ph-gear"></i>Endereço</a></li>
        <li><a href="/acompanhamento"><i class="ph ph-gear"></i>Acompanhamento</a></li>
        <li><a href="/historico"><i class="ph ph-gear"></i>Historico</a></li>
        <li><a href="/produto-selecionado"><i class="ph ph-gear"></i>Produto selecionado</a></li>
      </ul>
    </div>

    <div class="nav-section">
      <h4>Administração</h4>
      <ul>
        <li><a href="/admin"><i class="ph ph-shield-check"></i> Painel Admin</a></li>
        <li><a href="/admin/produtos"><i class="ph ph-shield-check"></i> Painel Admin Produto</a></li>
      </ul>
    </div>

    <div class="nav-section">
      <h4>Termos de Serviço</h4>
      <ul>
        <li><a href="/admin"><i class="ph ph-shield-check"></i>Consulte</a></li>
      </ul>
    </div>
  </nav>

  <div class="sidebar-header">
    <div class="user-info">
      <div class="user-avatar">
        <i class="ph ph-user"></i>
      </div>
      <div class="user-details">
        <h3>Minha Conta</h3>
        <p>Bem-vindo!</p>
      </div>
    </div>
    <button class="sidebar-close" id="sidebarClose">
      <i class="ph ph-x"></i>
    </button>
  </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
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