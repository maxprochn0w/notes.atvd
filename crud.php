<?php
include 'db.php';

function criarUsuario($nome, $email, $senha) {
    global $pdo;
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash]);
}

function criarNota($titulo, $conteudo, $id_usuario) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO notas (titulo, conteudo, id_usuario) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $conteudo, $id_usuario]);
}

function lerNotasPorUsuario($id_usuario) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM notas WHERE id_usuario = ? ORDER BY data_criacao DESC");
    $stmt->execute([$id_usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function atualizarNota($id, $titulo, $conteudo) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE notas SET titulo = ?, conteudo = ? WHERE id = ?");
    $stmt->execute([$titulo, $conteudo, $id]);
}

function deletarNota($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM notas WHERE id = ?");
    $stmt->execute([$id]);
}
?>