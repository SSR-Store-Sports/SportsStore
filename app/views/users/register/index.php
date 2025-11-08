<link rel="stylesheet" href="/app/views/users/register/styles.css">

<body>
    <main class="register-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="register-container">
            <form>
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
                    <div class="form-group">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar senha">
                    </div>
                    <button type="submit" class="btn-register">Criar conta</button>
                    <p>Já possui uma conta? <a href="/auth/login">Fazer login</a></p>
                </div>
            </form>
        </div>
    </main>
</body>

