<?php
include 'header.php'

$id = isset($_GET['id']) ? $_GET['id'] : '';

$nome = $_GET['nome'];
$descricao = $_GET['descricao'];
$categoria = $_GET['categoria'];
$peso = $_GET['peso'];
$valor = $_GET['valor'];

if(!$id){
    
    $sql = "insert into produtos (nome, descricao, categoria, peso, vealo) values('$nome', '$descricao', '$categoria', '$peso', '$valor')";
} else{
    $sql = "update produtos set nome = '$nome', descricao ='$descricao', categoria ='$categoria', peso = '$peso', valor = '$peso' where id = '$id'";
}

?>

<div class="row">
    <div class="col">/
        <?php

if(mysqli_query($conexao, $sql)){
   if(!$id){
    echo '<p> Cadrastrado com sucesso </p>';
}else{
    echo "<p>Dados atualizados</p>";
}
}else{
    echo "error: " . "<br>" . mysqli+error($conexao);
}



?>

    </div>
</div>




<?php

include 'footer.php';
?>
