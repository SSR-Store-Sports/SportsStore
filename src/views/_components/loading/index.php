<link rel="stylesheet" href="/app/views/_components/loading/styles.css">

<body>
  <div>
    <h1>Loading</h1>
    <p>Sua página está em carregamento...</p>
    <div class="loader"><i class="ph ph-circle-notch"></i>

    </div>
    <script>
      setTimeout(function () {
        window.location.href = '/app';
      }, 3000);
    </script>
  </div>
</body>