<?php
session_start();
include 'crud.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    criarUsuario($nome, $email, $senha);
    echo "<p>Usuário registrado com sucesso!</p>";
}
?>