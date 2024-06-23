<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <script src="../templates/JS/main.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Produto</h1>
        <form id="productForm" method="get" action="../Controller/insertProductController.php" onsubmit="return validateForm('productForm')">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            <div class="error">Este campo é obrigatório.</div>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="peso">Peso:</label>
            <input type="number" step="0.01" id="peso" name="peso" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
            <div class="error">Este campo é obrigatório.</div>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
