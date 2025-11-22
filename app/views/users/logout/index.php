<?php
session_destroy();
?>

<link rel="stylesheet" href="/app/views/users/logout/styles.css">

<div class="logout-container">
    <div class="logout-content">
        <div class="loading-spinner"></div>
        <h2>Saindo da conta...</h2>
        <p>Você será redirecionado para a página de login em instantes.</p>
    </div>
</div>

<script>
    setTimeout(() => {
        window.location.href = '/auth/login';
    }, 4000);
</script>