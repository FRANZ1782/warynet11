







<?php include("template/cabecera.php");

?>




<?php 
include("administrador/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM venta");
$sentenciaSQL->execute();
$listaViajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<?php foreach($listaViajes as $viaje){ ?>


    <div class="col-md-4">
        <div class="tabla-precio">
            <img class="card-img-top" src="./img/<?php echo $viaje['imagen'];  ?>" alt="">
            <div class="card-body">
                <h4 class="card-title">    <?php echo $viaje['nombre'];  ?></h4>
                <p class="card-text"></p>

             <!--  <a name="" id="" class="btn btn-primary" href="#" role="button"> DISPONIBLE </a>-->

            </div>
        </div>

    </div> 

<?php }?>





            <?php include("template/pie.php");

?>