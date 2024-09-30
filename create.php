<?php
include 'crud.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $id_usuario = $_POST['id_usuario']; 

    if (empty($id_usuario)) {
        die("ID do usuário não pode ser vazio.");
    }

    var_dump($titulo, $conteudo, $id_usuario);
    criarNota($titulo, $conteudo, $id_usuario);
    echo "Nota criada com sucesso!";
}
?>