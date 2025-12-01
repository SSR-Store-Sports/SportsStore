<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $supplierData = [
    'name' => trim($_POST['name'] ?? ''),
    'telephone' => trim($_POST['telephone'] ?? ''),
    'type' => trim($_POST['type'] ?? ''),
  ];

  try {
    $stmt = $db->prepare("INSERT INTO tatifit_suppliers (name, telephone, type) VALUES (:name, :telephone, :type)");
    $stmt->execute($supplierData);
    $message = "✅ Fornecedor cadastrado com sucesso!";
  } catch (Exception $e) {
    $message = "❌ Erro: " . $e->getMessage();
  }
}

// Buscar fornecedores
$suppliers = $db->query("SELECT s.*, COUNT(p.id) as products_count FROM tatifit_suppliers s LEFT JOIN tatifit_stocks st ON s.id = st.suppliers_id LEFT JOIN tatifit_products p ON st.products_id = p.id GROUP BY s.id ORDER BY s.name")->fetchAll();
$totalSuppliers = count($suppliers);
$activeSuppliers = $totalSuppliers; // Assumindo todos ativos por enquanto

?>

<link rel="stylesheet" href="/app/views/admin/supplier/styles.css">
<script src="/public/js/supplier.js" defer></script>

<body>
    <main class="supplier-main">
        <div class="supplier-header">
            <h1><i class="ph ph-truck"></i> Gerenciar Fornecedores</h1>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Buscar fornecedor..." id="searchSuppliers">
                </div>
                <button class="btn-add-supplier">
                    <i class="ph ph-plus"></i>
                    Novo Fornecedor
                </button>
            </div>
        </div>

        <div class="supplier-stats">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="ph ph-buildings"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalSuppliers ?></span>
                    <span class="stat-label">Total</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon active">
                    <i class="ph ph-check-circle"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $activeSuppliers ?></span>
                    <span class="stat-label">Ativos</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon inactive">
                    <i class="ph ph-x-circle"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number"><?= $totalSuppliers - $activeSuppliers ?></span>
                    <span class="stat-label">Inativos</span>
                </div>
            </div>
        </div>

        <div class="suppliers-grid">
            <?php foreach ($suppliers as $supplier): ?>
            <div class="supplier-card">
                <div class="card-header">
                    <div class="supplier-avatar">
                        <i class="ph ph-factory"></i>
                    </div>
                    <div class="supplier-info">
                        <h3><?= htmlspecialchars($supplier['name']) ?></h3>
                        <span class="supplier-type"><?= htmlspecialchars($supplier['type']) ?></span>
                    </div>
                    <div class="card-menu">
                        <button class="menu-btn">
                            <i class="ph ph-dots-three-vertical"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-content">
                    <div class="contact-info">
                        <div class="info-item">
                            <i class="ph ph-phone"></i>
                            <span><?= htmlspecialchars($supplier['telephone']) ?></span>
                        </div>
                        <div class="info-item">
                            <i class="ph ph-package"></i>
                            <span><?= $supplier['products_count'] ?> produtos</span>
                        </div>
                    </div>
                    
                    <div class="card-actions">
                        <button class="btn-action secondary btn-edit">
                            <i class="ph ph-pencil"></i>
                            Editar
                        </button>
                        <button class="btn-action primary btn-products">
                            <i class="ph ph-package"></i>
                            Produtos
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal Novo Fornecedor -->
    <div id="supplierModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Novo Fornecedor</h2>
                <button class="close-modal">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <form class="supplier-form" method="POST">
                <div class="form-group">
                    <label>Nome do Fornecedor</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="telephone" required>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <input type="text" name="type" placeholder="Ex: Roupas Esportivas" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancelar</button>
                    <button type="submit" class="btn-save">Salvar</button>
                </div>
                <?php if ($message): ?>
                    <div class="alert <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>"><?= $message ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>