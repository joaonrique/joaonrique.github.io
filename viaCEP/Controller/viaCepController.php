<?php
/**
 * @author João Vitor
 */


include_once '../connection.php';

$pdo = conectar(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cep         = $_POST['cep'];
    $logradouro  = $_POST['logradouro'];
    $complemento = $_POST['complemento'];
    $bairro      = $_POST['bairro'];
    $localidade  = $_POST['localidade'];
    $uf          = $_POST['uf'];
    $ibge        = $_POST['ibge'];
    $ddd         = $_POST['ddd'];

    $sql = "INSERT INTO cep (cep, logradouro, complemento, bairro, localidade, uf, ibge, ddd)
            VALUES (:cep, :logradouro, :complemento, :bairro, :localidade, :uf, :ibge, :ddd)";
    
    if ($pdo) { 
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':localidade', $localidade);
        $stmt->bindParam(':uf', $uf);
        $stmt->bindParam(':ibge', $ibge);
        $stmt->bindParam(':ddd', $ddd);

        try {
            $stmt->execute();
            echo "Dados inseridos com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao inserir os dados: " . $e->getMessage();
        }
    } else {
        echo "Erro na conexão com o banco de dados.";
    }
}
?>
