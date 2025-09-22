<?php

include './template/header.html';

?>

<div class="container">
    <h1>Cadastro de Fotos de Animais</h1>
    <form action="aux_upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="cadastro" value="1">
        <div class="form-group">
            <label for="nome_animal">Nome do Animal:</label>
            <input type="text" id="nome_animal" name="nome_animal" required>
        </div>
        <div class="form-group">
            <label for="foto_animal">Selecione uma foto:</label>
            <input type="file" id="foto_animal" name="foto_animal" required>
        </div>
        <button class="btn btn-success" type="submit">Cadastrar Foto</button>
    </form>

    <?php 
        include './class/Animais.php';
        $animais = new Animais();

        $todosAnimais = $animais->consultarAnimais();
    ?>
    <div class="row mt-5">
        <?php foreach($todosAnimais as $animal){ ?>
        <div class="card" style="width: 16rem;">
            <img src="./img/<?= $animal['caminho_arquivo']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $animal['nome_animal']?></h5>
            </div>
        </div>
        <?php } ?>
    </div>
</div>