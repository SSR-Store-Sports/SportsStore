<?php
$showForm2 = false;

// Verifica se o primeiro formulário foi submetido
if (isset($_POST["submit_parte1"])) {
    // Aqui você pode adicionar validação para os campos da Parte 1
    // Por exemplo, verificar se os campos obrigatórios foram preenchidos
    $nome = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone_parte1 = $_POST["telefone_parte1"] ?? "";
    $cpf_parte1 = $_POST["cpf_parte1"] ?? "";
    $password = $_POST["password"] ?? "";

    // Exemplo de validação simples: verifica se o nome e email não estão vazios
    if (!empty($nome) && !empty($email)) {
        $showForm2 = true;
        // Você pode armazenar os dados da Parte 1 em variáveis de sessão aqui
        // session_start();
        // $_SESSION["nome"] = $nome;
        // ...
    } else {
        // Mensagem de erro se a validação falhar
        echo "<p style='color: red;'>Por favor, preencha todos os campos obrigatórios da Parte 1.</p>";
    }
}

// Se o segundo formulário for submetido (após o primeiro ter sido validado)
if (isset($_POST["submit_parte2"])) {
    // Aqui você pode adicionar validação para os campos da Parte 2
    // E então processar o registro completo
    $cpf_parte2 = $_POST["cpf_parte2"] ?? "";
    $cep_parte2 = $_POST["cep_parte2"] ?? "";
    $complemento_parte2 = $_POST["complemento_parte2"] ?? "";
    $telefone_parte2 = $_POST["telefone_parte2"] ?? "";
    $data_nasc_parte2 = $_POST["data_nasc_parte2"] ?? "";

    if (!empty($cpf_parte2) && !empty($cep_parte2)) {
        // Processar os dados completos do registro
        echo "<p style='color: green;'>Cadastro concluído com sucesso!</p>";
        // Redirecionar ou mostrar mensagem de sucesso
    } else {
        echo "<p style='color: red;'>Por favor, preencha todos os campos obrigatórios da Parte 2.</p>";
        $showForm2 = true; // Mantém o formulário 2 visível se houver erro de validação
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/app/views/users/address_registration/styles.css">
</head>
<body class="bg-black text-white">

<main class="register-main">
    <!-- Imagens das modelos -->
    <div class="carrosel">
        <img class="modelo1" src="/public/images/modelo01.webp" alt="Modelo 1">
        <img class="modelo2" src="/public/images/modelo02.webp" alt="Modelo 2">
    </div>

    <div class="login-container">
        <div class="brand-logo">
            <img src="/public/images/logo.png" alt="Tatifit Wear Logo">
        </div>

        <?php if (!$showForm2): // Exibe a Parte 1 se $showForm2 for false ?>
            <div class="register-header">
                <h1>Cadastro - Parte 1</h1>
                <p>Por favor, preencha os campos abaixo para criar sua conta na loja</p>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Nome" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" id="telefone_parte1" name="telefone_parte1" placeholder="Telefone">
                </div>
                <div class="form-group">
                    <input type="text" id="cpf_parte1" name="cpf_parte1" placeholder="CPF">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                <button type="submit" name="submit_parte1" class="btn-register">Continuar</button>
            </form>
        <?php else: // Exibe a Parte 2 se $showForm2 for true ?>
            <div class="register-header">
                <h1>Cadastro - Parte 2</h1>
                <p>Informações de Endereço e Complementares</p>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" id="cpf_parte2" name="cpf_parte2" placeholder="CPF" required>
                </div>
                <div class="form-group">
                    <input type="text" id="cep_parte2" name="cep_parte2" placeholder="CEP" required>
                </div>
                <div class="form-group">
                    <input type="text" id="complemento_parte2" name="complemento_parte2" placeholder="Complemento">
                </div>
                <div class="form-group">
                    <input type="tel" id="telefone_parte2" name="telefone_parte2" placeholder="Telefone">
                    <span class="eye-icon"></span>
                </div>
                <div class="form-group">
                    <input type="date" id="data_nasc_parte2" name="data_nasc_parte2" placeholder="Data de Nasc.">
                </div>
                <button type="submit" name="submit_parte2" class="btn-register">Registrar</button>
            </form>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
