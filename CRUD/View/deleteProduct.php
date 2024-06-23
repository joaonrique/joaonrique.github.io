<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM SB1010 WHERE SB1COD = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':id' => $id])) {
        echo "Produto deletado com sucesso!";
        header('Location: ../View/consultProduct.php');
        exit();
    } else {
        echo "Erro ao deletar o produto.";
    }
} else {
    die('ID do produto não fornecido.');
}
?>