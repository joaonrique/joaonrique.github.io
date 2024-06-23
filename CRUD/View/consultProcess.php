<?php include_once 'C:/xampp/htdocs/CRUD/bdConnection.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Processos Judiciais</title>
    <link rel="stylesheet" href="../templates/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>Número do Processo</th>
                    <th>Nome do Interessado</th>
                    <th>Nome do Advogado</th>
                    <th>Nome do Tribunal</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = conectar();
                $sql = "SELECT Z11COD, Z11NUMPROC, Z11NOMEINT, Z11NOMEADV, Z11NOMETRI, Z11DESC FROM Z11010";
                $stmt = $pdo->query($sql);
                $processos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($processos) {
                    foreach ($processos as $processo) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($processo['Z11NUMPROC']) . '</td>';
                        echo '<td>' . htmlspecialchars($processo['Z11NOMEINT']) . '</td>';
                        echo '<td>' . htmlspecialchars($processo['Z11NOMEADV']) . '</td>';
                        echo '<td>' . htmlspecialchars($processo['Z11NOMETRI']) . '</td>';
                        echo '<td>' . htmlspecialchars($processo['Z11DESC']) . '</td>';
                        echo '<td class="actions">';
                        echo '<a href="editProcess.php?id=' . $processo['Z11COD'] . '" title="Editar"><i class="fas fa-edit"></i></a>';
                        echo '<a href="deleteProcess.php?id=' . $processo['Z11COD'] . '" title="Deletar" onclick="return confirm(\'Tem certeza que deseja deletar este processo?\');"><i class="fas fa-trash-alt delete-link"></i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhum processo cadastrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
</body>
</html>
