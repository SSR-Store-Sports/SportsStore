<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Obter os valores: página atual, item de pesquisa, categoria de pesquisa
$pageValueDefault = (int) 1; // primeira página padrão
$itemsPerPage = (int) 6; // itens por página
$pageCurrent = isset($_GET['page']) ? (int) $_GET['page'] : $pageValueDefault;
$searchUsers = isset($_GET['searchUsers']) ? (string) trim($_GET['name']) : null;

// função que retorna itens que devem ser esquecidos por página
function calcPagination(int $page, $items): int
{
    return ($page - 1) * $items;
}

$valueFilters = [
    'pageCurrent' => (int) $pageCurrent,
    'searchUsers' => (string) $searchUsers,
];

$offset = calcPagination($valueFilters['pageCurrent'], $itemsPerPage);

try {
    $countStmt = $db->prepare("SELECT 
        COUNT(id) AS total,
        SUM(CASE
            WHEN role = 'user' THEN 1
            ELSE 0
        END) AS total_users,
        SUM(CASE
            WHEN role = 'admin' THEN 1
            ELSE 0
        END) AS total_admins
    FROM
        tatifit_users;");
    $countStmt->execute();
    $results = $countStmt->fetch(PDO::FETCH_ASSOC);

    $totalRegistros = $results['total'];
    $totalUsers     = $results['total_users'];
    $totalAdmins    = $results['total_admins'];

    $totalPages = ceil($totalRegistros / $itemsPerPage);

    $sql = "SELECT u.id, u.name, u.email, u.phone, u.cpf, u.role, COUNT(o.id) as orders_count 
            FROM tatifit_users u 
            LEFT JOIN tatifit_orders o ON u.id = o.user_id 
            GROUP BY u.id 
            LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $dataUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Erro na consulta de produtos: " . $e->getMessage());
    echo "Erro na consulta de usuários.";
};

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
                    <button class="search-button">Pesquisar</button>
                </div>
                <!-- <select class="role-filter">
                    <option value="">Todos os Perfis</option>
                    <option value="user">Clientes</option>
                    <option value="admin">Administradores</option>
                </select> -->
            </div>
        </div>

        <div class="users-stats">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="ph ph-users-three"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalRegistros ?></span>
                    <span class="stat-label">Total</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon clients">
                    <i class="ph ph-user"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalUsers ?></span>
                    <span class="stat-label">Clientes</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon admins">
                    <i class="ph ph-shield-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalAdmins ?></span>
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
                    <?php foreach ($dataUsers as $user): ?>
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
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td><?= htmlspecialchars($user['cpf']) ?></td>
                            <td>
                                <span class="role-badge <?= $user['role'] ?>">
                                    <?= $user['role'] === 'admin' ? 'Administrador' : 'Cliente' ?>
                                </span>
                            </td>
                            <td class="orders-count"><?= $user['orders_count'] ?? 0 ?></td>
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

        <div class="users-cards">
            <?php foreach ($dataUsers as $user): ?>
                <div class="user-card" data-role="<?= $user['role'] ?>">
                    <div class="user-card-header">
                        <div class="user-avatar">
                            <i class="ph ph-user-circle"></i>
                        </div>
                        <div class="user-card-info">
                            <div class="user-card-name"><?= htmlspecialchars($user['name']) ?></div>
                            <div class="user-card-email"><?= htmlspecialchars($user['email']) ?></div>
                        </div>
                    </div>

                    <div class="user-card-details">
                        <div class="user-card-detail">
                            <span class="user-card-label">Telefone</span>
                            <span class="user-card-value"><?= htmlspecialchars($user['phone']) ?></span>
                        </div>
                        <div class="user-card-detail">
                            <span class="user-card-label">CPF</span>
                            <span class="user-card-value"><?= htmlspecialchars($user['cpf']) ?></span>
                        </div>
                    </div>

                    <div class="user-card-actions">
                        <div class="user-card-role">
                            <span class="role-badge <?= $user['role'] ?>">
                                <?= $user['role'] === 'admin' ? 'Administrador' : 'Cliente' ?>
                            </span>
                            <span class="user-card-orders"><?= $user['orders_count'] ?? 0 ?> pedidos</span>
                        </div>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

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

    <div class="pagination">
    <?php if ($valueFilters['pageCurrent'] > 1): ?>
      <a href="?page=<?= $valueFilters['pageCurrent'] - 1 ?>" class="pagination-btn">← Anterior</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?= $i ?>" class="pagination-btn <?= $i === $valueFilters['pageCurrent'] ? 'active' : '' ?>">
        <?= $i ?>
      </a>
    <?php endfor; ?>

    <?php if ($valueFilters['pageCurrent'] < $totalPages): ?>
      <a href="?page=<?= $valueFilters['pageCurrent'] + 1 ?>" class="pagination-btn">Próximo →</a>
    <?php endif; ?>
  </div>
</body>