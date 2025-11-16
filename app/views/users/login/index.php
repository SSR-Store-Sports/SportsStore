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
                
                <form>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Senha">
                        <a href="#" class="forgot-password">Esqueci a senha</a>
                    </div>
                    <button type="submit" class="btn-login">Entrar</button>
                </form>
                
                <p class="register-link">Não tem conta? <a href="/auth/registro">Criar conta</a></p>
            </div>
        </div>
    </main>
</body>