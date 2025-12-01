<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

// Estatísticas gerais
$stats = $db->query("
    SELECT 
        COUNT(DISTINCT u.id) as total_users,
        COUNT(DISTINCT o.id) as total_orders,
        SUM(o.total_price) as total_revenue,
        COUNT(DISTINCT p.id) as total_products
    FROM tatifit_users u
    LEFT JOIN tatifit_orders o ON u.id = o.user_id
    LEFT JOIN tatifit_products p ON 1=1
")->fetch();

// Usuários por mês
$usersByMonth = $db->query("
    SELECT 
        DATE_FORMAT(date_creation, '%Y-%m') as month,
        COUNT(*) as count
    FROM tatifit_orders 
    WHERE date_creation >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
    GROUP BY month
    ORDER BY month
")->fetchAll();
?>

<link rel="stylesheet" href="/app/views/admin/products/styles.css">

<body>
  <main class="product-page">
    <div class="product-card">
      <nav class="breadcrumb">
        <a href="/admin">Admin</a> > <span>Relatórios</span>
      </nav>
      <a href="/admin" class="product-back-page"><i class="ph ph-arrow-left"></i>Voltar</a>
      <h1>Relatórios do Sistema</h1>
      <p>Estatísticas e métricas importantes do negócio.</p>

      <div class="stats-grid">
        <div class="stat-card">
          <h3>Total de Usuários</h3>
          <p class="stat-number"><?= $stats['total_users'] ?></p>
        </div>
        
        <div class="stat-card">
          <h3>Total de Pedidos</h3>
          <p class="stat-number"><?= $stats['total_orders'] ?></p>
        </div>
        
        <div class="stat-card">
          <h3>Receita Total</h3>
          <p class="stat-number">R$ <?= number_format($stats['total_revenue'] ?? 0, 2, ',', '.') ?></p>
        </div>
        
        <div class="stat-card">
          <h3>Total de Produtos</h3>
          <p class="stat-number"><?= $stats['total_products'] ?></p>
        </div>
      </div>

      <div class="chart-section">
        <h3>Pedidos por Mês</h3>
        <div class="chart-container">
          <?php foreach ($usersByMonth as $data): ?>
            <div class="chart-bar">
              <div class="bar" style="height: <?= $data['count'] * 10 ?>px;"></div>
              <span><?= date('m/Y', strtotime($data['month'] . '-01')) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </main>

  <style>
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin: 2rem 0;
    }
    
    .stat-card {
      background: #f8f9fa;
      padding: 1.5rem;
      border-radius: 8px;
      text-align: center;
    }
    
    .stat-card h3 {
      margin: 0 0 0.5rem 0;
      font-size: 0.9rem;
      color: #666;
    }
    
    .stat-number {
      font-size: 2rem;
      font-weight: bold;
      color: var(--text-color-pink);
      margin: 0;
    }
    
    .chart-section {
      margin-top: 3rem;
    }
    
    .chart-container {
      display: flex;
      align-items: end;
      gap: 1rem;
      height: 200px;
      padding: 1rem;
      background: #f8f9fa;
      border-radius: 8px;
    }
    
    .chart-bar {
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
    }
    
    .bar {
      background: var(--text-color-pink);
      width: 30px;
      min-height: 10px;
      border-radius: 4px 4px 0 0;
    }
    
    .chart-bar span {
      margin-top: 0.5rem;
      font-size: 0.8rem;
      color: #666;
    }
  </style>
</body>