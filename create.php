<?php
session_start();
include 'crud.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); 
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    criarNota($titulo, $conteudo, $id_usuario);
    echo "<p>Nota criada com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Nota</title>
</head>
<body>
    <h1>Criar Nota</h1>
    <form method="POST" action="">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
        <button type="submit">Criar Nota</button>
    </form>

    <h2>Notas</h2>
    <?php
    $notas = lerNotasPorUsuario($id_usuario);
    foreach ($notas as $nota) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($nota['titulo']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($nota['conteudo'])) . "</p>";
        echo "<a href='editar.php?id=" . $nota['id'] . "'>Editar</a>";
        echo "<a href='deletar.php?id=" . $nota['id'] . "'>Deletar</a>";
        echo "</div>";
    }
    ?>
</body>
</html>