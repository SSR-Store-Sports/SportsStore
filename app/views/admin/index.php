<link rel="stylesheet" href="/app/views/admin/styles.css">
<link href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" rel="stylesheet">

<body>
    <main class="admin-main">
        <div class="admin-header">
            <h1><i class="ph ph-shield-check"></i> Painel Administrativo</h1>
            <p>Gerencie sua loja de forma eficiente</p>
        </div>
        
        <div class="admin-grid">
            <div class="admin-card">
                <div class="card-header">
                    <div class="card-icon products">
                        <i class="ph ph-package"></i>
                    </div>
                    <h3>Produtos</h3>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <a href="/admin/produtos/cadastrar" class="btn-action primary">
                            <i class="ph ph-plus"></i>
                            <span>Cadastrar Produto</span>
                        </a>
                        <a href="/admin/estoque" class="btn-action secondary">
                            <i class="ph ph-warehouse"></i>
                            <span>Gerenciar Estoque</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <div class="card-icon suppliers">
                        <i class="ph ph-truck"></i>
                    </div>
                    <h3>Fornecedores</h3>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <a href="/admin/fornecedores/cadastrar" class="btn-action primary">
                            <i class="ph ph-plus"></i>
                            <span>Cadastrar Fornecedor</span>
                        </a>
                        <a href="/admin/fornecedores" class="btn-action secondary">
                            <i class="ph ph-list"></i>
                            <span>Lista de Fornecedores</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <div class="card-icon orders">
                        <i class="ph ph-shopping-bag"></i>
                    </div>
                    <h3>Pedidos</h3>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <a href="/admin/pedidos" class="btn-action primary">
                            <i class="ph ph-clipboard-text"></i>
                            <span>Gerenciar Pedidos</span>
                        </a>
                        <a href="/admin/devolucoes" class="btn-action secondary">
                            <i class="ph ph-arrow-clockwise"></i>
                            <span>Devoluções</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <div class="card-icon users">
                        <i class="ph ph-users"></i>
                    </div>
                    <h3>Usuários</h3>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <a href="/admin/usuarios" class="btn-action primary">
                            <i class="ph ph-user-gear"></i>
                            <span>Gerenciar Usuários</span>
                        </a>
                        <a href="/admin/relatorios" class="btn-action secondary">
                            <i class="ph ph-chart-bar"></i>
                            <span>Relatórios</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>