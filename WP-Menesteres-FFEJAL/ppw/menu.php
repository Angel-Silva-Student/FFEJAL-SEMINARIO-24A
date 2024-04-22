<?php include("template/cabecera.php");?> 


<?php

include("administrador/config/db.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM competidores");
$sentenciaSQL->execute();
$listaComida=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<style>

h3{
    padding-top: 50px;
    padding-bottom: 50px;
}

body {
background-color: #292c37;
color: white;
}

div.card-body{
    color:black;
}

</style>

<br><br>

<h3> Participantes FFEJAL  </h3>

<br><br><br>

<?php foreach($listaComida as $comida) { ?>

<div class="col-md-3">

    <div class="card">

    <img class="card-img-top" src="./img/<?php echo $comida['imagen']; ?> " alt="">

        <div class="card-body">

            <h4 class="card-title"> <?php echo $comida['nombres']; ?> </h4>
            <h4 class="card-title"> <?php echo $comida['apellidoPaterno']; ?> </h4>
            <h4 class="card-title"> <?php echo $comida['apellidoMaterno']; ?> </h4>
            <h4 class="card-title"> <?php echo $comida['categoria']; ?> </h4>
            <h4 class="card-title"> <?php echo $comida['peso']; ?> </h4>
            <h4 class="card-title"> <?php echo $comida['gimnasio']; ?> </h4>
            <a name="" id="" class="btn btn-primary" href="" role="button">Ver más</a>
            <button class="btn btn-primary" name="btnAccion"  value="Agregar"  type="submit">Agregar al Carrito</button>

        </div>

    </div>
    <br><br>
</div>

<?php } ?>


<?php include("template/piepagina.php");?>