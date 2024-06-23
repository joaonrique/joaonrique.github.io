<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num_processo'], $_POST['nome_interessado'], $_POST['nome_advogado'], $_POST['nome_tribunal'], $_POST['descricao_processo'])) {
    $num_processo = $_POST['num_processo'];
    $nome_interessado = $_POST['nome_interessado'];
    $nome_advogado = $_POST['nome_advogado'];
    $nome_tribunal = $_POST['nome_tribunal'];
    $descricao_processo = $_POST['descricao_processo'];

    $sql = "INSERT INTO Z11010 (Z11NUMPROC, Z11NOMEINT, Z11NOMEADV, Z11NOMETRI, Z11DESC) VALUES (:num_processo, :nome_interessado, :nome_advogado, :nome_tribunal, :descricao_processo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':num_processo' => $num_processo,
        ':nome_interessado' => $nome_interessado,
        ':nome_advogado' => $nome_advogado,
        ':nome_tribunal' => $nome_tribunal,
        ':descricao_processo' => $descricao_processo
    ]) ? print("Processo cadastrado com sucesso!") : print("Erro ao cadastrar o processo.");
} else {
    echo "Por favor, preencha todos os campos.";
}
?>
