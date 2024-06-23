<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM Z11010 WHERE Z11COD = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $processo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$processo) {
        die('Processo não encontrado.');
    }
} else {
    die('ID do processo não fornecido.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num_processo'], $_POST['nome_interessado'], $_POST['nome_advogado'], $_POST['nome_tribunal'], $_POST['descricao_processo'])) {
    $num_processo = $_POST['num_processo'];
    $nome_interessado = $_POST['nome_interessado'];
    $nome_advogado = $_POST['nome_advogado'];
    $nome_tribunal = $_POST['nome_tribunal'];
    $descricao_processo = $_POST['descricao_processo'];

    $sql = "UPDATE Z11010 SET Z11NUMPROC = :num_processo, Z11NOMEINT = :nome_interessado, Z11NOMEADV = :nome_advogado, Z11NOMETRI = :nome_tribunal, Z11DESC = :descricao_processo WHERE Z11COD = :id";
    $stmt = $pdo->prepare($sql);
    $params = [
        ':num_processo' => $num_processo,
        ':nome_interessado' => $nome_interessado,
        ':nome_advogado' => $nome_advogado,
        ':nome_tribunal' => $nome_tribunal,
        ':descricao_processo' => $descricao_processo,
        ':id' => $id
    ];

    if ($stmt->execute($params)) {
        echo "Processo atualizado com sucesso!";
        header('Location: ../View/consultProcess.php');
        exit(); 
    } else {
        echo "Erro ao atualizar o processo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <title>Editar Processo Judicial</title>
</head>
<body>
    <div class="form-container">
        <h1>Editar Processo Judicial</h1>
        <form method="post">
            <label for="num_processo">Número do Processo:</label>
            <input type="text" id="num_processo" name="num_processo" value="<?php echo htmlspecialchars($processo['Z11NUMPROC']); ?>" required><br><br>
            
            <label for="nome_interessado">Nome do Interessado:</label>
            <input type="text" id="nome_interessado" name="nome_interessado" value="<?php echo htmlspecialchars($processo['Z11NOMEINT']); ?>" required><br><br>
            
            <label for="nome_advogado">Nome do Advogado:</label>
            <input type="text" id="nome_advogado" name="nome_advogado" value="<?php echo htmlspecialchars($processo['Z11NOMEADV']); ?>" required><br><br>
            
            <label for="nome_tribunal">Nome do Tribunal:</label>
            <input type="text" id="nome_tribunal" name="nome_tribunal" value="<?php echo htmlspecialchars($processo['Z11NOMETRI']); ?>" required><br><br>
            
            <label for="descricao_processo">Descrição do Processo:</label>
            <textarea id="descricao_processo" name="descricao_processo" required><?php echo htmlspecialchars($processo['Z11DESC']); ?></textarea><br><br>
            
            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>
</html>
