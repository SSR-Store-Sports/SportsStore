<?php
require 'config/database.php';

function checkFields($email, $password)
{
    if (empty($email) || empty($password)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
        echo "<script>window.location.href = '/auth/login';</script>";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $error = "";

    checkFields($email, $password);

    try {
        $stmt = $db->prepare("SELECT id, name, password FROM tatifit_users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $doesPasswordMatches = password_verify($password, $user['password']);
            
            if ($doesPasswordMatches) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                echo "<script>window.location.href = '/';</script>";
                exit();
            } else {
                $error = 'Credênciais inválidas!';
            }

        } else {
            $error = 'Credênciais inválidas!';
        }
    } catch (PDOException $e) {
        // Tratamento de erro robusto
        error_log("Erro de Autenticação no BD: " . $e->getMessage());
        $error = "Ocorreu um erro no servidor. Tente novamente mais tarde.";
    }
}

?>

<link rel="stylesheet" href="/app/views/users/login/styles.css">

<body>
    <main class="login-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="login-container">
            <div class="login-form">
                <div class="logo-container">
                    <img class="logo-login" src="/public/images/logo.png" alt="TatiFit Wear">
                </div>

                <form method="POST" action="">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Senha">
                        <a href="#" class="forgot-password">Esqueci a senha</a>
                    </div>
                    <?php
                    if (isset($error) && !empty($error)) {
                        echo "<p>Erro: $error</p>";
                    }
                    ?>
                    <button type="submit" class="btn-login">Entrar</button>
                </form>

                <p class="register-link">Não tem conta? <a href="/auth/registro">Criar conta</a></p>
            </div>
        </div>
    </main>
</body>