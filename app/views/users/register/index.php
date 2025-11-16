<link rel="stylesheet" href="/app/views/users/register/styles.css">

<body>
    <main class="register-main">
        <div class="carrosel">
            <img class="modelo1" src="/public/images/modelo1.jpg" alt="Modelo 1">
            <img class="modelo2" src="/public/images/modelo2.jpg" alt="Modelo 2">
        </div>

        <div class="register-container">
            <div class="register-form">
                <div class="logo-container">
                    <img class="logo-register" src="/public/images/logo.png" alt="TatiFit Wear">
                </div>
                
                <form id="registerForm">
                    <div id="step1" class="form-step active">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Nome completo" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="telefone" name="telefone" placeholder="Telefone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar senha" required>
                        </div>
                        <button type="button" id="nextStep" class="btn-register">Continuar</button>
                    </div>
                    
                    <div id="step2" class="form-step">
                        <div class="form-group">
                            <input type="text" id="cep" name="cep" placeholder="CEP" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="endereco" name="endereco" placeholder="Endereço" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="numero" name="numero" placeholder="Número" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                        </div>
                        <div class="form-group">
                            <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="estado" name="estado" placeholder="Estado" required>
                        </div>
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="terms" name="terms" required>
                                <span class="checkmark"></span>
                                Aceito os <a href="/termos" target="_blank">termos de serviço</a> e <a href="/privacidade" target="_blank">política de privacidade</a>
                            </label>
                        </div>
                        <div class="form-actions">
                            <button type="button" id="prevStep" class="btn-back"><i class="ph ph-arrow-left"></i></button>
                            <button type="submit" class="btn-register">Criar conta</button>
                        </div>
                    </div>
                </form>
                
                <p class="login-link">Já possui uma conta? <a href="/auth/login">Fazer login</a></p>
            </div>
        </div>
    </main>
<script src="/public/js/register.js"></script>
</body>

