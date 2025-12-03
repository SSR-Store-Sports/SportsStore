<?php
require 'config/database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userRegistered = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => trim($_POST['password'] ?? ''),
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
        $sqlOnlyUser = 'INSERT INTO tatifit_users (name, email, password, phone, cpf, role) VALUES (:name, :email, :password, :phone, :cpf, :role)';
        $stmtUser = $db->prepare($sqlOnlyUser);
        $stmtUser->execute([
            ':name' => $userRegistered['name'],
            ':email' => $userRegistered['email'],
            ':password' => password_hash($userRegistered['password'], PASSWORD_DEFAULT),
            ':phone' => $userRegistered['phone'],
            ':cpf' => $userRegistered['cpf'],
            ':role' => 'user',
        ]);

        $lastUserId = $db->lastInsertId();
        $sqlOnlyAddress = 'INSERT INTO tatifit_users_address (cep, street, number, type, recipient_name, contact_phone, neighborhood, city, state, user_id) VALUES (:cep, :street, :number, :type, :recipient_name, :contact_phone, :neighborhood, :city, :state, :user_id)';
        $stmtAddress = $db->prepare($sqlOnlyAddress);
        $stmtAddress->execute([
            ':cep' => $userRegistered['cep'],
            ':street' => $userRegistered['street'],
            ':number' => $userRegistered['number'] ?: null,
            ':type' => $userRegistered['type'] ?: 'Casa',
            ':recipient_name' => $userRegistered['name'],
            ':contact_phone' => $userRegistered['phone'],
            ':neighborhood' => $userRegistered['neighborhood'],
            ':city' => $userRegistered['city'],
            ':state' => $userRegistered['state'],
            ':user_id' => $lastUserId,
        ]);

        $db->commit();
        echo "<script>window.location.href = '/check';</script>";
        exit();
    } catch (PDOException $e) {
        $db->rollback();
        error_log("Erro de Registro no BD: " . $e->getMessage());
        $error = "Ocorreu um erro no cadastro de usuário. Tente novamente mais tarde.";
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
                        <div class="form-inputs-inline">
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" placeholder="Telefone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                            </div>
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
                            <input type="text" id="cep" name="cep" placeholder=" CEP" required>
                            <!-- <label for="">Não sei meu CEP</label> -->
                        </div>

                        <div class="form-group">
                            <select id="type" name="type" required>
                                <option value="">Tipo de Endereço</option>
                                <option value="Casa">Casa</option>
                                <option value="Trabalho">Trabalho</option>
                                <option value="Outro">Outro</option>
                            </select>
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
                                <input type="checkbox" id="terms" name="terms">
                                <span class="checkmark"></span>
                                Aceito os <a href="/termos" target="_blank">termos de serviço</a> e <a
                                    href="/privacidade" target="_blank">política de privacidade</a>
                            </label>
                            <!-- NOVO ELEMENTO DE ERRO CUSTOMIZADO -->
                            <div id="terms-error-message" style="display: none; color: red; margin-top: 5px;">
                                Você deve aceitar os termos de serviço para continuar.
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" id="prevStep" class="btn-back"><i
                                    class="ph ph-arrow-left"></i></button>
                            <button type="submit" class="btn-register">Criar conta</button>
                        </div>
                    </div>
                </form>

                <?php if (isset($error) && !empty($error)): ?>
                    <div class="error-container">
                        <p class="error">Erro: <?= $error ?></p>
                    </div>
                <?php endif; ?>

                <p class="login-link">Já possui uma conta? <a href="/auth/login">Fazer login</a></p>
            </div>
        </div>
    </main>
    <script src="/public/js/register.js"></script>
</body>
