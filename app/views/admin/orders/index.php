<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

?>

<link rel="stylesheet" href="/app/views/admin/orders/styles.css">
<script src="/public/js/orders.js" defer></script>

<body>
    <main class="orders-main">
        <div class="orders-header">
            <h1><i class="ph ph-shopping-bag"></i> Gerenciar Pedidos</h1>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Buscar por cliente ou ID..." id="searchOrders">
                </div>
                <select class="status-filter">
                    <option value="">Todos os Status</option>
                    <option value="pendente">Pendente</option>
                    <option value="processando">Processando</option>
                    <option value="enviado">Enviado</option>
                    <option value="entregue">Entregue</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
        </div>

        <div class="orders-stats">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="ph ph-clock"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['pendente'] ?></span>
                    <span class="stat-label">Pendentes</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon processing">
                    <i class="ph ph-gear"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['processando'] ?></span>
                    <span class="stat-label">Processando</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon shipped">
                    <i class="ph ph-truck"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['enviado'] ?></span>
                    <span class="stat-label">Enviados</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon delivered">
                    <i class="ph ph-check-circle"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $stats['entregue'] ?></span>
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