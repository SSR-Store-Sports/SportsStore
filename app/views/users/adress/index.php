<main class="register-main">
    <link rel="stylesheet" href="/app/views/users/adress/styles.css">
        <!-- Imagens das modelos -->
        <div class="carrosel">
        <img class="modelo1" src="/public\images/modelo1.jpg" alt="Modelo 1">
        <img class="modelo2" src="/public\images/modelo2.jpg" alt="Modelo 2">
        </div>

        <!-- Formulário de registro -->
        <div class="login-container">
            <div class="brand-logo">
                <img src="/public/images/logo.png" alt="Tatifit Wear Logo">
            </div>
            <div class="register-header">
                <h1>Cadastro</h1>
                <p>Por favor, preencha os campos abaixo para criar sua conta na loja</p>
            </div>
            <form>
                <div class="form-group">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF">
                </div>
                <div class="form-group">
                    <input type="text" id="cep" name="cep" placeholder="CEP">
                </div>
                <div class="form-group">
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                </div>
                <div class="form-group">
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
                    <span class="eye-icon"></span>
                </div>
                <div class="form-group">
                    <input type="date" id="data_nasc" name="data_nasc" placeholder="Data de Nasc.">
                </div>
                <button type="submit" class="btn-register">Registrar</button>
            </form>
        </div>
    </main>
