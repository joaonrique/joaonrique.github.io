<?php
include_once 'C:/xampp/htdocs/CRUD/bdConnection.php';

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM SB1010 WHERE SB1COD = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        die('Produto não encontrado.');
    }
} else {
    die('Parâmetro não passado');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['descricao'], $_POST['categoria'], $_POST['peso'], $_POST['valor'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $peso = $_POST['peso'];
    $valor = $_POST['valor'];

    $sql = "UPDATE SB1010 SET SB1NOME = :nome, SB1DESC = :descricao, SB1CATE = :categoria, SB1PESO = :peso, SB1VALOR = :valor WHERE SB1COD = :id";
    $stmt = $pdo->prepare($sql);
    $params = [
        ':nome'      => $nome,
        ':descricao' => $descricao,
        ':categoria' => $categoria,
        ':peso'      => $peso,
        ':valor'     => $valor,
        ':id'        => $id
    ];

    if ($stmt->execute($params)) {
        echo "Produto atualizado com sucesso!";
        header('Location: ../View/consultProduct.php');
        exit(); 
    } else {
        echo "Erro ao atualizar o produto.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <title>Editar Produto</title>
</head>
<body>
    <div class="form-container">
        <h1>Editar Produto</h1>
        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['SB1NOME']); ?>" required><br><br>
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($produto['SB1DESC']); ?></textarea><br><br>
            
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($produto['SB1CATE']); ?>" required><br><br>
            
            <label for="peso">Peso:</label>
            <input type="number" step="0.01" id="peso" name="peso" value="<?php echo htmlspecialchars($produto['SB1PESO']); ?>" required><br><br>
            
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" value="<?php echo htmlspecialchars($produto['SB1VALOR']); ?>" required><br><br>
            
            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>
</html>

