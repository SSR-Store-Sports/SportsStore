<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // echo "<pre>POST recebido: ";
    // var_dump($_POST);
    // echo "</pre>";
    
    $userRegistered = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
        'phone' => trim($_POST['phone'] ?? ''),
        'cpf' => trim($_POST['cpf'] ?? ''),
        'type' => trim($_POST['type'] ?? ''),
        'cep' => trim($_POST['cep'] ?? ''),
        'street' => trim($_POST['street'] ?? ''),
        'neighborhood' => trim($_POST['neighborhood'] ?? ''),
        'number' => trim($_POST['number'] ?? ''),
        'city' => trim($_POST['city'] ?? ''),
        'state' => trim($_POST['state'] ?? ''),
    ];

    try {
        $db->beginTransaction();
        
        // Inserir usuário
        $sqlOnlyUser = 'INSERT INTO tatifit_users (name, email, password, telefone, cpf, role) VALUES (:name, :email, :password, :telefone, :cpf, :role)';
        $stmtUser = $db->prepare($sqlOnlyUser);
        $stmtUser->execute([
            ':name' => $userRegistered['name'],
            ':email' => $userRegistered['email'],
            ':password' => substr($userRegistered['password'], 0, 20),
            ':telefone' => $userRegistered['phone'],
            ':cpf' => $userRegistered['cpf'],
            ':role' => 'user',
        ]);
        
        $lastUserId = $db->lastInsertId();  
        $sqlOnlyAddress = 'INSERT INTO tatifit_users_address (type, cep, street, neighborhood, number, city, state, user_id) VALUES (:type, :cep, :street, :neighborhood, :number, :city, :state, :user_id)';
        $stmtAddress = $db->prepare($sqlOnlyAddress);
        $stmtAddress->execute([
            ':type' => 'Residencial',
            ':cep' => $userRegistered['cep'],
            ':street' => $userRegistered['street'],
            ':neighborhood' => $userRegistered['neighborhood'],
            ':number' => $userRegistered['number'],
            ':city' => $userRegistered['city'],
            ':state' => $userRegistered['state'],
            ':user_id' => $lastUserId,
        ]);
        
        $db->commit();
        header('Location: /check');
        exit();
    } catch (PDOException $e) {
        $db->rollback();
        echo "Erro: " . $e->getMessage();
    }
}

?>

<link rel="stylesheet" href="/app/views/users/register/styles.css">

<body>
    <main class="register-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="register-container">
            <div class="register-form">
                <div class="logo-container">
                    <img class="logo-register" src="/public/images/logo.png" alt="TatiFit Wear">
                </div>

                <form action="" method="POST" id="registerForm">
                    <div id="step1" class="form-step active">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Nome completo" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder="Telefone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="confirm-password" name="confirm-password"
                                placeholder="Confirmar senha" required>
                        </div>
                        <button type="button" id="nextStep" class="btn-register">Continuar</button>
                    </div>

                    <div id="step2" class="form-step">
                        <div class="form-group">
                            <input type="text" id="type" name="type" placeholder="Tipo" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="cep" name="cep" placeholder="CEP" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="street" name="street" placeholder="Rua" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="neighborhood" name="neighborhood" placeholder="Bairro" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="number" name="number" placeholder="Número">
                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" placeholder="Cidade" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="state" name="state" placeholder="Estado" required>
                        </div>
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="terms" name="terms" required>
                                <span class="checkmark"></span>
                                Aceito os <a href="/termos" target="_blank">termos de serviço</a> e <a
                                    href="/privacidade" target="_blank">política de privacidade</a>
                            </label>
                        </div>
                        <div class="form-actions">
                            <button type="button" id="prevStep" class="btn-back"><i
                                    class="ph ph-arrow-left"></i></button>
                            <button type="submit" class="btn-register">Criar conta</button>
                        </div>
                    </div>
                </form>

                <p class="login-link">Já possui uma conta? <a href="/auth/login">Fazer login</a></p>
            </div>
        </div>
    </main>
    <script src="/public/js/register.js"></script>
</body>