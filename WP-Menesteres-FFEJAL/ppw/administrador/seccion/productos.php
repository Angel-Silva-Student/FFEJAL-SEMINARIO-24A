<?php include("../template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
#$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellidoPaterno=(isset($_POST['txtApellidoPaterno']))?$_POST['txtApellidoPaterno']:"";
$txtApellidoMaterno=(isset($_POST['txtApellidoMaterno']))?$_POST['txtApellidoMaterno']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$txtPeso=(isset($_POST['txtPeso']))?$_POST['txtPeso']:"";
$txtGimnasio=(isset($_POST['txtGimnasio']))?$_POST['txtGimnasio']:"";
#$txtdescripcionPlatillo=(isset($_POST['txtdescripcionPlatillo']))?$_POST['txtdescripcionPlatillo']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




include("../config/db.php");
include("../config/database.php");



switch($accion){
    
    case "Agregar":

        //INSERT INTO `platillos` (`id`, `nombre`, `imagen`, `descripcionPlatillo`) VALUES (NULL, 'galletas de hojaldre en forma de corazon', 'aggg.jpg', 'Docena de mini galletas de hojaldre en forma de corazón');
        //$sentenciaSQL = $conexion->prepare("INSERT INTO comidas (nombre, imagen) VALUES (:nombre,:imagen);");
        //$sentenciaSQL -> bindParam(':nombre',$txtNombre);
        $sentenciaSQL = $conexion->prepare("INSERT INTO competidores (nombres,apellidoPaterno,apellidoMaterno,categoria,peso,gimnasio,imagen) VALUES (:nombres,:apellidoPaterno,:apellidoMaterno,:categoria,:peso,:gimnasio,:imagen);");
        $sentenciaSQL->bindParam(':nombres',$txtNombre);

        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }

        //$sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        //$sentenciaSQL->bindParam(':precio',$txtPrecio);
        //$sentenciaSQL->bindParam(':descripcionPlatillo',$txtdescripcionPlatillo);
        //$sentenciaSQL->execute();

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':apellidoPaterno',$txtApellidoPaterno);
        $sentenciaSQL->bindParam(':apellidoMaterno',$txtApellidoMaterno);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':peso',$txtPeso);
        $sentenciaSQL->bindParam(':gimnasio',$txtGimnasio);
        $sentenciaSQL->execute();
            
        header("Location:productos.php");

        break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE competidores SET nombres=:nombres, apellidoPaterno=:apellidoPaterno, apellidoMaterno=:apellidoMaterno, categoria=:categoria, peso=:peso, gimnasio=:gimnasio where id=:id ");
        //$sentenciaSQL->bindParam(':nombre',$txtNombre);
        //$sentenciaSQL->bindParam(':precio',$txtPrecio);
        //$sentenciaSQL->bindParam(':descripcionPlatillo',$txtdescripcionPlatillo);
        //$sentenciaSQL->bindParam(':id',$txtID);
        //$sentenciaSQL->execute();

        $sentenciaSQL->bindParam(':nombres',$txtNombre);
        $sentenciaSQL->bindParam(':apellidoPaterno',$txtApellidoPaterno);
        $sentenciaSQL->bindParam(':apellidoMaterno',$txtApellidoMaterno);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':peso',$txtPeso);
        $sentenciaSQL->bindParam(':gimnasio',$txtGimnasio);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM competidores where id=:id ");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $competidor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if(isset($competidor["imagen"]) && ($competidor["imagen"]!="imagen.jpg") ){
    
                if(file_exists("../../img/".$competidor["imagen"])){
    
                    unlink("../../img/".$competidor["imagen"]);
    
                }
    
            }

            $sentenciaSQL=$conexion->prepare("UPDATE competidores SET imagen=:imagen where id=:id ");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }
        
        header("Location:productos.php");

        break;


    case "Cancelar":
            header("Location:productos.php");
        break;


    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM competidores where id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $competidor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $competidor['nombres'];
        $txtApellidoPaterno = $competidor['apellidoPaterno'];
        $txtApellidoMaterno = $competidor['apellidoMaterno'];
        $txtCategoria = $competidor['categoria'];
        $txtPeso = $competidor['peso'];
        $txtGimnasio = $competidor['gimnasio'];
        $txtImagen = $competidor['imagen'];

        

        break;


    case "Borrar":

        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM competidores where id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $competidor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($competidor["imagen"]) && ($competidor["imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$competidor["imagen"])){

                unlink("../../img/".$competidor["imagen"]);

            }

        }

        
        $sentenciaSQL=$conexion->prepare("DELETE FROM competidores WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        header("Location:productos.php");


        break;


}



$sentenciaSQL=$conexion->prepare("SELECT * FROM competidores");
$sentenciaSQL->execute();
$listaCompetidores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);





?>


    <div class="col-md-4">


        <div class="card">

            <div class="card-header" >
                Datos del Participante
            </div>

                <div class="card-body">

            <form method="POST" enctype="multipart/form-data" >
                
                <div class = "form-group">
                    <label for="txtID">ID del participante: </label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name = "txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group">
                    <label for="txtID">Nombres del Participante: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name = "txtNombre" id="txtNombre" placeholder="Nombres">
                </div>

                <div class = "form-group">
                    <label for="txtID">Apellido Paterno del Participante: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtApellidoPaterno; ?>" name = "txtApellidoPaterno" id="txtApellidoPaterno" placeholder="Apellido Paterno">
                </div>

                <div class = "form-group">
                    <label for="txtID">Apellido Materno del Participante: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtApellidoMaterno; ?>" name = "txtApellidoMaterno" id="txtApellidoMaterno" placeholder="Apellido Materno">
                </div>

                <div class = "form-group">
                    <label for="txtID">Caategor&iacute;a del Participante: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtCategoria; ?>" name = "txtCategoria" id="txtCategoria" placeholder="Categor&iacute;a">
                </div>

                <div class = "form-group">
                    <label for="txtID">Peso del participante: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtPeso; ?>" name = "txtPeso" id="txtPeso" placeholder="Peso">
                </div>

                <div class = "form-group">
                    <label for="txtID">Gimnasio del Participante: </label>
                    <input type="text" class="form-control" value="<?php echo $txtGimnasio; ?>" name = "txtGimnasio" id="txtGimnasio" placeholder="Gimnasio">
                </div>

                <div class = "form-group">
                    <label for="txtID">Imagen: </label>

                    <?php  echo $txtImagen;  ?>
                    <br/>

                    <?php 

                        if($txtImagen!= ""){ ?>

                            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?> " width="100"  alt=""> 

                        <?php 
                            }
                        ?>

                    <input type="file"  class="form-control" name = "txtImagen" id="txtImagen" placeholder="Foto del Participante">
                </div>


                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>




            </div>

        </div>        
        

    </div>


    <div class="col-md-8">


        <table class="table table-bordered "  >
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Categoria</th>
                    <th>Peso</th>
                    <th>Gimnasio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($listaCompetidores as $competidor) { ?>
                <tr>
                    <td> <?php echo $competidor['id']; ?> </td>
                    <td> <?php echo $competidor['nombres']; ?> </td>
                    <td> <?php echo $competidor['apellidoPaterno']; ?> </td>
                    <td> <?php echo $competidor['apellidoMaterno']; ?> </td>
                    <td> 
                        
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $competidor['imagen']; ?> " width="200"  alt=""> 
                
                    </td>



                    <td> <?php echo $competidor['categoria']; ?> </td>

                    <td> <?php echo $competidor['peso']; ?> </td>

                    <td> <?php echo $competidor['gimnasio']; ?> </td>
                    
                    
                    <td>

                    <form method="post">

                        <input type="hidden" name="txtID" id="textID" value="<?php echo $competidor['id']; ?>" />

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />

                    </form>

                    </td>

                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>

<?php include("../template/piepagina.php");?>