<?php include("../template/cabecera.php"); ?>
<?php 
//print_r($_POST);  

//print_r($_FILES);   
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen'] ['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("../../administrador/config/bd.php");


switch($accion){
    case "Agregar":
        //INSERT INTO `TViajes` (`Id`, `Nombre`, `imagen`) VALUES (NULL, 'Coiroico', 'imagen.jpg');
        $sentenciaSQL=$conexion->prepare("INSERT INTO venta (Nombre,imagen) VALUES (:nombre,:imagen );");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        
        $fecha=new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:ventas.php");
       
       break; 
    case "Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE venta SET nombre=:nombre WHERE id=:id ");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha=new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM venta WHERE id=:id ");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $viaje3=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($viaje3["imagen"])&&($viaje3["imagen"]!="imagen.jpg")){

            if(file_exists("../../img/" . $viaje3["imagen"])){

                unlink("../../img/" . $viaje3["imagen"]);
            }

        }




            $sentenciaSQL=$conexion->prepare("UPDATE venta SET imagen=:imagen WHERE id=:id ");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
         }
         header("Location:ventas.php");
        break; 
    case "Cancelar":
       header("Location:ventas.php");
        break; 

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM venta WHERE id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $viaje3=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre=$viaje3['nombre'];
        $txtImagen=$viaje3['imagen'];

        //echo "Presionado boton Seleccionar";
        break; 
    case "Borrar":
        //echo "Presionado boton Borrar";

        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM venta WHERE id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $viaje3=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($viaje3["imagen"])&&($viaje3["imagen"]!="imagen.jpg")){

            if(file_exists("../../img/" . $viaje3["imagen"])){

                unlink("../../img/" . $viaje3["imagen"]);
            }

        }


        $sentenciaSQL=$conexion->prepare("DELETE FROM venta WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        header("Location:ventas.php");
        break; 
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM venta");
$sentenciaSQL->execute();
$listaViajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

//LA VARIABLE $listaViajes es la que tiene todos los registros

 
?>


<div class="col-md-5">


    <div class="card">

        <div class="card-header">
            Datos de la venta
        </div>


        <div class="card-body">
            
            <form method="POST" enctype="multipart/form-data" >

                <div class = "form-group">
                <label for="txtID">ID:</label>
                <input type="text" required readonly class="form-control"  value="<?php echo $txtID;?>"  name="txtID" id="txtID"  placeholder="ID">
                </div>

                <div class = "form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre de la venta">
                </div>


                <div class = "form-group">
                <label for="txtImagen">Imagen:</label>

                
                <br>

                <?php   if($txtImagen!=""){ ?>       


                    <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen?>" width="100px"  alt="">


                  <?php      }    ?>   

                <input type="file"  class="form-control" name="txtImagen" id="txtImagen"  placeholder="Nombre de la venta">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?>  value="Modificar" class="btn btn-warning">Modificar </button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?>  value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>



            </form>


        </div>


    </div>
    
</div>


    <div class="col-md-7">
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($listaViajes as $viaje) { ?>
                <tr>
                    <td> <?php echo $viaje['id'] ?>  </td>
                    <td> <?php echo $viaje['nombre'] ?></td>
                    <td>

                    <img class="img-thumbnail rounded" src="../../img/<?php echo $viaje['imagen'] ?>" width="100px"  alt="">
                    

                     </td>
                    <td>
                  

                        <form method="post">
                        
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $viaje['id']; ?>">
                            <input type="submit" name="accion"  value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion"  value="Borrar" class="btn btn-danger">

                        
                        
                        </form>
                    </td>

                </tr>  

                <?php } ?>              
               
            </tbody>
        </table>

    </div>

<?php include("../template/pie.php") ?>