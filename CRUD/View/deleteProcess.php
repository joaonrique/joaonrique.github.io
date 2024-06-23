<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Z11010 WHERE Z11COD = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':id' => $id])) {
        echo "Processo judicial deletado com sucesso!";
        header('Location: ../View/consultProcess.php');
        exit(); 
    } else {
        echo "Erro ao deletar o processo judicial.";
    }
} else {
    die('ID do processo não fornecido.');
}
?>
