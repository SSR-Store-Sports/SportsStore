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
</head>

<body>
  <?php
    // importação das routes da aplicação
    session_start();
    require_once 'routes/web.php';
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
</body>

</html>