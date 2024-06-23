<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Processo Judicial</title>
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <script src="../templates/JS/main.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Processo Judicial</h1>
        <form id="processForm" method="post" action="../Controller/insertProcessController.php" onsubmit="return validateForm('processForm')">
            <label for="num_processo">Número do Processo:</label>
            <input type="text" id="num_processo" name="num_processo" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="nome_interessado">Nome do Interessado:</label>
            <input type="text" id="nome_interessado" name="nome_interessado" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="nome_advogado">Nome do Advogado:</label>
            <input type="text" id="nome_advogado" name="nome_advogado" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="nome_tribunal">Nome do Tribunal:</label>
            <input type="text" id="nome_tribunal" name="nome_tribunal" required>
            <div class="error">Este campo é obrigatório.</div>

            <label for="descricao_processo">Descrição do Processo:</label>
            <textarea id="descricao_processo" name="descricao_processo" required></textarea>
            <div class="error">Este campo é obrigatório.</div>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
