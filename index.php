<?php
session_start();
include 'crud.php';

// Se o usuário já estiver logado, redirecione para a página de criação de notas
if (isset($_SESSION['usuario_id'])) {
    header('Location: create.php'); // Redireciona para a página de criar notas
    exit();
}

// Processa o registro de um novo usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    criarUsuario($nome, $email, $senha);
    echo "<p>Usuário registrado com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
</head>
<body>
    <h1>Bloco de Notas</h1>

    <h2>Registrar Usuário</h2>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="hidden" name="registro" value="1">
        <button type="submit">Registrar</button>
    </form>

    <h2>Login</h2>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>