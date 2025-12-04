<?php
require 'config/database.php';

header('Content-Type: application/json');

if ($_SESSION['role'] !== "admin") {
    echo json_encode(['success' => false, 'message' => 'Acesso negado']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $userId = $input['userId'] ?? null;
    $newRole = $input['newRole'] ?? null;
    
    if (!$userId || !$newRole) {
        echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
        exit();
    }
    
    if (!in_array($newRole, ['user', 'admin'])) {
        echo json_encode(['success' => false, 'message' => 'Perfil inválido']);
        exit();
    }
    
    try {
        $stmt = $db->prepare("UPDATE tatifit_users SET role = :role WHERE id = :id");
        $stmt->bindParam(':role', $newRole);
        $stmt->bindParam(':id', $userId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Perfil alterado com sucesso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao alterar perfil']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>