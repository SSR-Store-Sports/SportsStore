<link rel="stylesheet" href="/app/views/styles.css">

<main class="login-main">
    <section class="login-container">
        <div class="login-form">
            <h1>Entrar</h1>
            <p>Acesse sua conta TatiFit</p>
            
            <form class="form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-btn">Entrar</button>
                
                <div class="form-links">
                    <a href="#">Esqueceu sua senha?</a>
                    <a href="/register">Não tem conta? Cadastre-se</a>
                </div>
            </form>
        </div>
    </section>
</main>