<link rel="stylesheet" href="/app/views/users/loading/styles.css">

<div class="logout-container">
    <div class="logout-content">
        <div class="loading-spinner"></div>
        <h2>Fazendo login...</h2>
        <p>Você será redirecionado para a home em instantes.</p>
    </div>
</div>

<script>
    setTimeout(() => {
        window.location.href = '/';
    }, 4000);
</script>