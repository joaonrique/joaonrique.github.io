<?php include_once 'C:/xampp/htdocs/CRUD/bdConnection.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Produtos</title>
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Peso</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = conectar();
                $sql = "SELECT SB1COD, SB1NOME, SB1DESC, SB1CATE, SB1PESO, SB1VALOR FROM SB1010";
                $stmt = $pdo->query($sql);
                $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($produtos) {
                    foreach ($produtos as $produto) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($produto['SB1NOME']) . '</td>';
                        echo '<td>' . htmlspecialchars($produto['SB1DESC']) . '</td>';
                        echo '<td>' . htmlspecialchars($produto['SB1CATE']) . '</td>';
                        echo '<td>' . htmlspecialchars($produto['SB1PESO']) . '</td>';
                        echo '<td>' . htmlspecialchars($produto['SB1VALOR']) . '</td>';
                        echo '<td class="actions">';
                        echo '<a href="../View/editProduct.php?id=' . $produto['SB1COD'] . '" title="Editar"><i class="fas fa-edit"></i></a>';
                        echo '<a href="../View/deleteProduct.php?id=' . $produto['SB1COD'] . '" title="Deletar" onclick="return confirm(\'Tem certeza que deseja deletar este produto?\');"><i class="fas fa-trash-alt delete-link"></i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhum produto cadastrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
</body>
</html>
