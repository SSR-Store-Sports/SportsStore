<?php 

// limpar cache no navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// session_start(); // - usando para habilitar as vÃ¡riaveis globais na hospedagem

// versão automática baseada no timestamp do deploy
$version = time();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="TatiFit Sports - Loja online de roupas esportivas femininas" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />

  <title>TatiFit Wear</title>
  <link rel="icon" href="/public/images/favicon.png?v=<?php echo $version; ?>" />

  <!-- importação do css global -->
  <link rel="stylesheet" href="/globals.css?v=<?php echo $version; ?>" />

  <!-- importação da fonte (inter) -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />

  <!-- biblioteca de ícones -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />

  <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@latest/bundled/lenis.min.js"></script>

</head>

<body>

  <?php
    require_once 'routes/web.php';
  ?>

  <!-- VLibras -->
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

  <!-- WhatsApp apenas para usuários -->
  <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user"): ?>
    <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5511000000000">
      <div class="rwb-tooltip">Clique aqui e fale conosco no WhatsApp.</div>
      <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
    </a>
  <?php endif; ?>

  <script src="./public/js/scroll.js?v=<?php echo $version; ?>"></script>

  <!-- ReCaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>
