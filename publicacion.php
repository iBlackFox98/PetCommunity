<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>PetCommunity</title>    
    <meta charset="UTF-8">
    <meta name="title" content="PetCommunity">
    <meta name="description" content="PetCommunity">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  

  <body>  
    <?php include "header.php"; ?>

    <?php 
      include 'conexion.php';

      //PUBLICACION
      $sqlA=$mysqli->query("SELECT * FROM publicaciones WHERE id=".$_GET['id']."");
      $rowA=$sqlA->fetch_array();
      
      //Para datos de Archivos
      $sqlB=$mysqli->query("SELECT * FROM archivos WHERE id=".$_GET['idP']."");
      $rowB=$sqlB->fetch_array();
      
      //Para datos de Usuario
      $sqlC=$mysqli->query("SELECT * FROM users WHERE id=".$_GET['user']);
      $rowC=$sqlC->fetch_array();
       ?>


     <div class="container-pub">

        <a href="perfil.php?username=<?php echo $rowC['username'] ?>" style="text-decoration: none">
             <div class="datos-user-pub">
              
            <img src="perfil/<?php echo $rowC['avatar']; $var ?>" width="10%">
            <h2 class="Nombre-user-pub">
              <?php echo $rowC['username'] ?>
            </h2>


        </div>
        </a>

        <img src="archivos/<?php echo $rowB['ruta']; ?>" width="100%" class="<?php echo $rowB['filtro']?>">
        <p class="descripcion"><?php echo $rowA['descripcion']; ?></p>

        <?php 
            if ($rowA['adopcion']==='si') {
              echo '<img src="images/adoptame.png" style="width:20%;">';
            }
            else{
              echo '<img src="images/mascota.png" style="width:20%;">';
            }

         ?>

         <?php 
          require 'conexion.php';
          $sqlD=$mysqli->query("SELECT * FROM comentarios WHERE idPublicacion=".$_GET['id']);
         
          while ($rowD=$sqlD->fetch_array()) {
            
            $sqlComentarista=$mysqli->query("SELECT * FROM users WHERE id=".$rowD['idComentarista']);
            $DatosComentarista=$sqlComentarista->fetch_array();
            
          ?>
            <div class="comentario">
              <img src="perfil/<?php echo $DatosComentarista['avatar'] ?>" width="30%">
              <h5><?php echo $rowD['Comentario'] ?></h5>
            </div>


          <?php } ?>


          <div class="input-coment">
        
        <?php 
         
          require("conexion.php");
          if(isset($_POST['submit'])) {
            echo "entre";
          }

         ?>

            <input type="text" name="comentario">
            <input type="submit" value="Comentar" class="btn-coment" name="submit" />
          </div>





       
     </div>




  </body>
</html>