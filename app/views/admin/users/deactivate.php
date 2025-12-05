<?php
require 'config/database.php';

header('Content-Type: application/json');

// verifica se permissão do usuário é diferente de admin
if ($_SESSION['role'] !== "admin") {
  echo "<script>window.location.href = '/';</script>";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $userId = $input['userId'] ?? null;
    
    if (!$userId) {
        echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido']);
        exit();
    }
    
    try {
        // Verificar se o usuário existe
        $checkStmt = $db->prepare("SELECT id FROM tatifit_users WHERE id = :id");
        $checkStmt->bindParam(':id', $userId);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() === 0) {
            echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
            exit();
        }
        
        // Desativar usuário (você pode adicionar uma coluna 'active' na tabela)
        // Por enquanto, vamos apenas deletar o usuário
        $stmt = $db->prepare("DELETE FROM tatifit_users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Usuário desativado com sucesso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao desativar usuário']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>