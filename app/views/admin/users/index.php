<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

?>

<link rel="stylesheet" href="/app/views/admin/users/styles.css">
<script src="/public/js/users.js" defer></script>

<body>
    <main class="users-main">
        <div class="users-header">
            <h1><i class="ph ph-users"></i> Gerenciar Usuários</h1>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Buscar usuário..." id="searchUsers">
                </div>
                <select class="role-filter">
                    <option value="">Todos os Perfis</option>
                    <option value="user">Clientes</option>
                    <option value="admin">Administradores</option>
                </select>
            </div>
        </div>

        <div class="users-stats">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="ph ph-users-three"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalUsers ?></span>
                    <span class="stat-label">Total</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon clients">
                    <i class="ph ph-user"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $regularUsers ?></span>
                    <span class="stat-label">Clientes</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon admins">
                    <i class="ph ph-shield-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $adminUsers ?></span>
                    <span class="stat-label">Administradores</span>
                </div>
            </div>
        </div>

        <div class="users-table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Perfil</th>
                        <th>Pedidos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr data-role="<?= $user['role'] ?>">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <i class="ph ph-user-circle"></i>
                                </div>
                                <strong><?= htmlspecialchars($user['name']) ?></strong>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['telefone']) ?></td>
                        <td><?= htmlspecialchars($user['cpf']) ?></td>
                        <td>
                            <span class="role-badge <?= $user['role'] ?>">
                                <?= $user['role'] === 'admin' ? 'Administrador' : 'Cliente' ?>
                            </span>
                        </td>
                        <td class="orders-count"><?= $user['orders_count'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-view" title="Ver perfil">
                                    <i class="ph ph-eye"></i>
                                </button>
                                <button class="btn-edit" title="Editar usuário">
                                    <i class="ph ph-pencil"></i>
                                </button>
                                <button class="btn-role" title="Alterar perfil">
                                    <i class="ph ph-user-gear"></i>
                                </button>
                                <button class="btn-delete" title="Desativar usuário">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal Alterar Perfil -->
    <div id="roleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Alterar Perfil do Usuário</h2>
                <button class="close-modal">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Usuário: <strong id="userName"></strong></p>
                <div class="form-group">
                    <label>Novo Perfil:</label>
                    <select id="newRole">
                        <option value="user">Cliente</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancelar</button>
                    <button type="button" class="btn-save">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</body>