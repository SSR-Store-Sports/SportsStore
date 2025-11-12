<link rel="stylesheet" href="/app/views/users/register/styles.css">

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:/Users/User/OneDrive/Documentos/tatifit/SportsStore/config/database.php';

if (isset($_POST['registrar_usuario'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    // lógica para registrar o usuário no banco de dados
    $sql = "INSERT INTO tatifit_users (name, email, password, cpf, telefone) VALUES ('$name', '$email', '$password', '$cpf', '$telefone')";

    mysqli_query($db, $sql);
}

?>

<body>
    
    <main class="register-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="register-container">
           <form action="" method="POST">


                <div class="register-form">
                    <div>
                        <img src="/public/images/logo.png" alt="TatiFit Wear">
                    </div>
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Nome completo">
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
                    </div>
                    <div class="form-group">
                        <input type="text" id="cpf" name="cpf" placeholder="CPF">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Senha">
                    </div>
                    <button type="submit" name="registrar_usuario" class="btn-register">Criar conta</button>
                    <p>Já possui uma conta? <a href="/auth/login">Fazer login</a></p>
                </div>

            </form>
        </div>
    </main>
</body>

