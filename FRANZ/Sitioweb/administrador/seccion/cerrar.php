<?php   include('template/cabecera.php') ?>



<?php
session_start();
session_destroy();
header('Location:../index.php');

?>


