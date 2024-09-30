<?php
session_start();

include 'db.php';

function criarNota($titulo, $conteudo, $id_usuario) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO notas (titulo, conteudo, id_usuario) VALUES (?, ?, ?)");
    if (!$stmt->execute([$titulo, $conteudo, $id_usuario])) {
        die("Erro ao criar nota: " . implode(", ", $stmt->errorInfo()));
    }
}

function lerNotasPorUsuario($id_usuario) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM notas WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?php if (!empty($notas)): ?>
        <?php foreach ($notas as $nota): ?>
            <div>
                <h3><?php echo htmlspecialchars($nota['titulo']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($nota['conteudo'])); ?></p>
                <a href="update.php?id=<?php echo $nota['id']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $nota['id']; ?>">Deletar</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma nota encontrada.</p>
    <?php endif; ?>
</body>
</html>