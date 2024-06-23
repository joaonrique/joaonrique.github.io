<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nome'], $_GET['descricao'], $_GET['categoria'], $_GET['peso'], $_GET['valor'])) {
    $nome = $_GET['nome'];
    $descricao = $_GET['descricao'];
    $categoria = $_GET['categoria'];
    $peso = $_GET['peso'];
    $valor = $_GET['valor'];

    $sql = "INSERT INTO SB1010 (SB1NOME, SB1DESC, SB1CATE, SB1PESO, SB1VALOR) VALUES (:nome, :descricao, :categoria, :peso, :valor)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':categoria' => $categoria,
        ':peso' => $peso,
        ':valor' => $valor
    ]) ? print("Produto cadastrado com sucesso!") : print("Erro ao cadastrar o produto.");
} else {
    echo "Por favor, preencha todos os campos.";
}
?>
