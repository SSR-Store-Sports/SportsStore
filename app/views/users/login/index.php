<link rel="stylesheet" href="/app/views/users/login/styles.css">
<?php

session_start();
require 'C:/Users/User/OneDrive/Documentos/tatifit/SportsStore/config/database.php';

if (isset($_POST['entrar_usuario'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // lógica para autenticar o usuário
    $sql = "SELECT * FROM tatifit_users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $sql);

}                                             

?>

<body>
    <main class="login-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="login-container">
            <form action="" method="POST">
                <div class="login-form">
                    <div>
                        <img class="logo-login" src="/public/images/logo.png" alt="TatiFit Wear">
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Senha">
                        <a href="#">Esqueci a senha</a>
                    </div>
                    <button type="submit" name="entrar_usuario" class="btn-login">Entrar</button>
                    <p>Não tem conta? <a href="/auth/register">Criar conta</a></p>
                </div>
            </form>

            <!-- <div class="social-login">
                <button class="google-login">
                    <img src="/public/images/google-icon1.png" alt="Google" />
                    Entrar com Google
                </button>
                <button class="facebook-login">
                    <img src="/public/images/facebook-icon1.png" alt="Facebook">
                    Entrar com Facebook
                </button>
            </div> -->
        </div>
    </main>
</body>