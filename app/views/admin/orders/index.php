<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Buscar pedidos com informações do usuário
$orders = $db->query("
    SELECT o.id, o.total_price as price, o.status, o.date_creation, u.name, u.email 
    FROM tatifit_orders o 
    JOIN tatifit_users u ON o.user_id = u.id 
    ORDER BY o.date_creation DESC
")->fetchAll();

// Estatísticas por status
$stats = [
    'Pendente' => 0,
    'Em Processamento' => 0,
    'Enviado' => 0,
    'Entregue' => 0
];

foreach ($orders as $order) {
    if (isset($stats[$order['status']])) {
        $stats[$order['status']]++;
    }
}

?>

<link rel="stylesheet" href="/app/views/admin/orders/styles.css">
<script src="/public/js/orders.js" defer></script>

<body>
    <main class="orders-main">
        <nav class="">
            <a href="/admin">Admin</a> > <span>Gerenciar Pedidos</span>
        </nav>
        <div class="orders-header">
            <h1><i class="ph ph-shopping-bag"></i> Gerenciar Pedidos</h1>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Buscar por cliente ou ID..." id="searchOrders">
                </div>
                <select class="status-filter">
                    <option value="">Todos os Status</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Em Processamento">Em Processamento</option>
                    <option value="Enviado">Enviado</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
        </div>

        <div class="orders-stats">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="ph ph-clock"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['Pendente'] ?></span>
                    <span class="stat-label">Pendentes</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon processing">
                    <i class="ph ph-gear"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['Em Processamento'] ?></span>
                    <span class="stat-label">Processando</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon shipped">
                    <i class="ph ph-truck"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['Enviado'] ?></span>
                    <span class="stat-label">Enviados</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon delivered">
                    <i class="ph ph-check-circle"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['Entregue'] ?></span>
                    <span class="stat-label">Entregues</span>
                </div>
            </div>
        </div>

        <div class="orders-table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="order-id">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <div class="customer-info">
                                <strong><?= htmlspecialchars($order['name']) ?></strong>
                                <span><?= htmlspecialchars($order['email']) ?></span>
                            </div>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($order['date_creation'])) ?></td>
                        <td class="order-value">R$ <?= number_format($order['price'], 2, ',', '.') ?></td>
                        <td>
                            <span class="status-badge <?= $order['status'] ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-view" title="Ver detalhes">
                                    <i class="ph ph-eye"></i>
                                </button>
                                <button class="btn-edit" title="Editar status">
                                    <i class="ph ph-pencil"></i>
                                </button>
                                <button class="btn-print" title="Imprimir">
                                    <i class="ph ph-printer"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button class="btn-page" disabled>
                <i class="ph ph-caret-left"></i>
            </button>
            <span class="page-info">Página 1 de 5</span>
            <button class="btn-page">
                <i class="ph ph-caret-right"></i>
            </button>
        </div>
    </main>
</body>