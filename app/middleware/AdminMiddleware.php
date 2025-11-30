<?php

function checkAdminRole() {
    session_start();
    
    if (empty($_SESSION['email'])) {
        echo "<script>alert('Acesso negado. Faça login primeiro.'); window.location.href = '/auth/login';</script>";
        exit();
    }
    
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        echo "<script>alert('Acesso negado. Apenas administradores podem acessar esta área.'); window.location.href = '/';</script>";
        exit();
    }
}