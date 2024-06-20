<?php
 include 'header.php'
?>

<div class="row">
    <div class="col">
        <form action="salvar.php">
       
       
        <div class="form-check">
        <label class="form-label" for="nome">nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
        </div>

        <div class="form-check">
        <label class="form-label" for="nome">descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descricao">
         </div>

        <div class="form-check">
        <label class="form-label" for="nome">categoria</label>
        <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoria">
        </div>

        <div class="form-check">
        <label class="form-label" for="nome">peso</label>
        <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso">
        </div>

        <div class="form-check">
        <label class="form-label" for="nome">valor</label>
        <input type="text" class="form-control" name="valor" id="valor" placeholder="$valor">
        </div>

        <input type="submit" value="enviar" class="btn btn-primary float-end">

        </form>
    </div>
</div>


<?php
include 'footer.php'
?>
