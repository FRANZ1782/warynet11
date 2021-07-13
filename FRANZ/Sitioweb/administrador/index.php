
<?php

session_start();
if($_POST){
    if(($_POST['usuario'] =="franz")&&($_POST['contrasenia']=='potito') ){

        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="franz";

        header('Location:inicio.php');

    }
    else{
        $mensaje="Error: El usuario o contraseña son incorrectos";
    }

}

/*
if ($_POST) {
    header('Location:inicio.php');
}*/
?>
<!doctype html>
<html lang="en">
  <head>
    <title>administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background-color:rgb(22,62,98);">
      


  <?php  $url ="http://".$_SERVER ['HTTP_HOST']."/franz/Sitioweb" ?>


  <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
          
                <a class="nav-item nav-link" href="<?php echo $url; ?> /index.php ">INICIO</a>


     
               

            </div>
        </nav>












   <div class="container">
       <div class="row">

 <div class="col-md-4">
     
 </div>



           <div class="col-md-4">

           <br><br><br><br>
               
                <div class="card">

                    <div class="card-header">
                        LOGIN
                    </div>
                    <div class="card-body">

                        <?php if(isset($mensaje)){?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje;?>  
                        </div>

                        <?php }?>


                    
                        <form method="POST" >
                            <div class = "form-group">
                            <label for="exampleInputEmail1">USUARIO</label>
                            <input type="text" class="form-control"   name="usuario"   placeholder="escribe tu Usuario">
              
                            </div>

                            <div class="form-group">
                            <label for="exampleInputPassword1">Contrtaseña</label>
                            <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu Contraseña">
                            </div>

                            
                        <button type="submit" class="btn btn-primary">ENTRAR AL ADMINISTRADOR</button>
                        </form>
                    
                    


                    </div>
    
                </div>

           </div>
           
       </div>
   </div>



  </body>
</html>

