<link rel="stylesheet" href="/app/views/users/register/styles.css">

<body>
    <main class="login-main">
    <div class="carrosel">
        <img class="modelo1" src="/public\images/modelo1.jpg" alt="Modelo 1">
        <img class="modelo2" src="/public\images/modelo2.jpg" alt="Modelo 2">
    </div>

    <div class="login-container">
        <form>
            <div class="login-form">
                <div class="logo">
                    <img src="/public/images/logo.png" alt="TatiFit Wear">
                </div>
                <div class="form-group">
                    <input type="name" id="name" name="name" placeholder="Nome">
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="telefone" id="telefone" name="telefone" placeholder="Telefone">
                </div>
                <div class="form-group">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Senha">
                </div>
                <button type="submit" class="btn-login">Continuar</button>
                <p>já possui uma conta? <a href="#">Fazer login</a></p>
            </div>
        </form>

        <div class="social-login">
            <button class="google-login">
                <img src="/public/images/google-icon1.png" alt="Google" />
                Entrar com Google
            </button>
            <button class="facebook-login">
                <img src="/public/images/facebook-icon1.png" alt="Facebook">
                Entrar com Facebook
            </button>
        </div>
    </div>
</main>
</body>

