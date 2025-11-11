<?php

print_r($_REQUEST);
if (!empty($_POST['name']) && 
!empty($_POST['email']) && 
!empty($_POST['password']) && 
!empty($_POST['cpf']) && 
!empty($_POST['telefone'])) 

{

    include '../config/database.php';
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    print_r($email);
    print_r($name);
    print_r($password);
    print_r($cpf);
    print_r($telefone);
}
else 
{
    header('Location: /register ');
    exit();
}


?>