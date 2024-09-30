<?php
session_start();
include 'crud.php';

// Aqui você deve definir o ID do usuário logado
$id_usuario = $_SESSION['usuario_id']; // Supondo que você tenha uma sessão do usuário

$notas = lerNotasPorUsuario($id_usuario);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
</head>
<body>
    <h1>Bloco de Notas</h1>

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
</body>
</html>