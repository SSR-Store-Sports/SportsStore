<?php
require 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = (string) trim($_POST['email'] ?? '');
    $error = "";
    $success = "";

    if (empty($email)) {
        $error = 'Preencha o e-mail, por favor.';
    } else {
        try {
            $stmt = $db->prepare("SELECT id, email FROM tatifit_users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
            } else {
            }

        } catch (PDOException $e) {
            error_log("Erro ao processar recuperação de senha: " . $e->getMessage());
            $error = "Ocorreu um erro no servidor. Tente novamente mais tarde.";
            echo $error;
        }
    }
}

?>

<link rel="stylesheet" href="/app/views/users/forgot-password/styles.css">

<body>
    <main class="login-main">
        <div class="login-container">
            <div class="login-form">
                <div class="login-informations">
                    <h3>Vamos trocar a sua senha!</h3>
                    <p>Por favor, insira o email abaixo: </p>
                </div>

                <form method="POST" action="">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>

                    <?php if (isset($error) && !empty($error)): ?>
                        <div class="error-container">
                            <p class="error"><?= $error ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($success) && !empty($success)): ?>
                        <div class="success-container">
                            <p class="success"><?= $success ?></p>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn-login">Enviar Link</button>
                </form>

                <p class="register-link">Lembrou da senha? <a href="/auth/login">Clique aqui para ir ao login</a></p>
            </div>
        </div>
    </main>
</body>