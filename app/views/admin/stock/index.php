<?php
require 'config/database.php';

if ($_SESSION['role'] === "user") {
    echo "<script>window.location.href = '/';</script>";
    exit();
}

?>

<link rel="stylesheet" href="/app/views/admin/stock/styles.css">

<body>
</body>
