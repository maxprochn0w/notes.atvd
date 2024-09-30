<?php
include 'crud.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deletarNota($id);
    echo "Nota deletada com sucesso!";
}
?>