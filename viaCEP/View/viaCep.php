<?php 
include_once '../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via CEP</title>
    <link href="bootstrap.css" rel="stylesheet">
    <script src="../JS/main.js"></script>
</head>
<body>
    <div class="container">
        <div class="col">
            <h1>Cadastro CEP</h1>
            <hr>
            <form action="../Controller/viaCepController.php" method="POST">
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" onblur="salvarCEP()">
                </div>
                <div class="mb-3">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro">
                </div>
                <div class="mb-3">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                </div>
                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                </div>
                <div class="mb-3">
                    <label for="localidade" class="form-label">Localidade</label>
                    <input type="text" class="form-control" id="localidade" name="localidade" placeholder="Localidade">
                </div>
                <div class="mb-3">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control" id="uf" name="uf" placeholder="UF">
                </div>
                <div class="mb-3">
                    <label for="ibge" class="form-label">IBGE</label>
                    <input type="text" class="form-control" id="ibge" name="ibge" placeholder="IBGE">
                </div>
                <div class="mb-3">
                    <label for="ddd" class="form-label">DDD</label>
                    <input type="text" class="form-control" id="ddd" name="ddd" placeholder="DDD">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>