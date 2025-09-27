<link rel="stylesheet" href="/app/views/users/login/styles.css">
<main class="login-main">
    <!-- Imagens das modelos -->
    <div class="carrosel">
        <img class="modelo1" src="/public\images/modelo1.png" alt="Modelo 1">
        <img class="modelo2" src="/public\images/modelo2.png" alt="Modelo 2">
    </div>

    <!-- Formulário de login -->
    <section class="login-container">
        <form>
            <div class="login-form">
                <div class="logo">
                    <img src="/public/images/logo.png" alt="TatiFit Wear">
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Senha">
                    <a href="#">Esqueci a senha</a>
                </div>
                <button type="submit" class="btn-login">Entrar</button>
                <p>Não tem conta? <a href="#">Criar conta</a></p>
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
    </section>
</main>