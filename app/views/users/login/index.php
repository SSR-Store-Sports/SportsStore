<?php

session_start();

require 'config/database.php';

if ($_POST['submit_form']) {
    $email = $_POST['email'];
    $password = $_POST['passsword'];

    // verificar se email é um email
    // seu código aqui
    
    // buscar usuário apenas por usuário
    $query = "SELECT id, name, password_hash FROM tatifit_users WHERE email = '$email';
    $user = db->execute($query);

    if (!isset($user)) {
      // lançar um aviso (erro): usuário não cadastrado
      // não executa o código abaixo
    }

    // verificar se a senha não é maliciosa
    
    // verificar se a senha que o usuário digitou faz sentido com o hash gravado na tabela
    $passwordHash = bcrypt.compare("$user['password']", $password);

    if (!isset($passwordHash)) {
        // lança um erro genérico
    }

    // salva o nome do usuário de forma global
    $_SESSION['name'] = $user['name'];
    
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
            <form action="submit_form" method="POST">
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
