<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="TatiFit Sports - Loja online de roupas esportivas femininas" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />

  <title>TatiFit Wear</title>
  <link rel="icon" href="/public/images/favicon.png" />

  <!-- importação do css global -->
  <link rel="stylesheet" href="/globals.css" />

  <!-- importação da fonte (inter) -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />


  <!-- importação da biblioteca de ícones (phosphor icons) -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />

  <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@latest/bundled/lenis.min.js"></script>
</head>

<body>
  <?php
  // session_start(); - usando para habilitar as váriaveis globais na hospedagem
  require_once 'routes/web.php'; // importação das routes da aplicação
  
  ?>

  <!-- script para habilitar o VLibras na aplicação -->
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

  <!-- script para habilitar o WhatsApp apenas para usuários -->
  <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user"): ?>
    <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5511000000000">
      <div class="rwb-tooltip">Clique aqui e fale conosco no WhatsApp.</div>
      <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
    </a>
  <?php endif; ?>
  
  <!-- script para habilitar a rolagem suave -->
  <script src="./public/js/scroll.js"></script>

  <!-- script para habilitar a ReCaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>