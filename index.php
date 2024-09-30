<?php
session_start();
include 'crud.php';

if (isset($_SESSION['usuario_id'])) {
    $id_usuario = $_SESSION['usuario_id'];
    $notas = lerNotasPorUsuario($id_usuario);
} else {
    $notas = [];
}

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

    <?php if (isset($id_usuario)): ?>
        <h2>Criar Nota</h2>
        <form method="POST" action="criar.php">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <button type="submit">Criar Nota</button>
        </form>

        <h2>Notas</h2>
        <?php foreach ($notas as $nota): ?>
            <div>
                <h3><?php echo htmlspecialchars($nota['titulo']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($nota['conteudo'])); ?></p>
                <a href="editar.php?id=<?php echo $nota['id']; ?>">Editar</a>
                <a href="deletar.php?id=<?php echo $nota['id']; ?>">Deletar</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Por favor, registre-se ou faça login para criar notas.</p>
    <?php endif; ?>
</body>
</html>