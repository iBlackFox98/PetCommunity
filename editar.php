<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

?>

<?php include "header.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>PetCommunity - Editar Perfil</title>
	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  	<link rel="stylesheet" href="css/style.css" type="text/css">
	<meta name="description" content="PetCommunity">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>   
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

  	    <script type="text/javascript">
    $(window).load(function(){
     $(function() {
      $('#file-input').change(function(e) {
          addImage(e); 
         });

         function addImage(e){
          var file = e.target.files[0],
          imageType = /image.*/;
        
          if (!file.type.match(imageType))
           return;
      
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
         }
      
         function fileOnload(e) {
          var result=e.target.result;
          $('#imgSalida').attr("src",result);
         }
        });
      });
    </script>

    <script>
      function capturar()
      {
            var resultado="";
     
            var porNombre=document.getElementsByName("filter");
            for(var i=0;i<porNombre.length;i++)
            {
                if(porNombre[i].checked)
                    resultado=porNombre[i].value;
            }

        var elemento = document.getElementById("resultado");
        if (elemento.className == "") {
          elemento.className = resultado;
          elemento.width = "600";
        }else {
          elemento.className = resultado;
          elemento.width = "600";
        }
    }
    </script>
</head>
<body>



	<div class="container-principal">		
<div class="main-content">
		<h2>Modifique sus datos aqui</h2><br>
		<label style="text-align: center;margin-left:1%; ">Sube una foto para tu perfil</label>
	<form action="" method="post" enctype="multipart/form-data">  

		<div class="hl-icon" style="margin-left: 35%;">
    		<div class="image-upload">
       			<label for="file-input">
        	  		<img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" >
      	  		</label>
        		<input id="file-input" type="file" name="file-input" hidden="" />
    		</div>
  		</div>
      
		<div style="float: left; clear: both; width: 600px; margin-left: 10%;">
  			<div id="resultado" class=""><img id="imgSalida" width="30%" /></div>
		</div>

      <div class="l-part">
        <input type="email" placeholder="Correo electrónico" class="input" name="mail" required />
        <div class="overlap-text">
          <input type="text" placeholder="Nombre completo" class="input" name="nombre" required />
        </div>
        <div class="overlap-text">
          <input type="text" placeholder="Usuario" class="input" name="usuario" required />
        </div>
        <div class="overlap-text">
          <input type="password" placeholder="Contraseña" class="input" name="password" required />
        </div>

        <div class="overlap-text">
          <input type="text" name="location" placeholder="Ingresa tu Ciudad y Pais" class="input" required>
        </div>

        <div class="overlap-text">
          <input type="text" name="phone" placeholder="Ingresa tu Telefono" class="input">
        </div>

        <div class="overlap-text">
          <select name="sex" required>
            <option value="null" disabled selected>Seleccione Su genero</option>
            <option value="male">Hombre</option>
            <option value="female">Mujer</option>
            <option value="other">Otro</option>
          </select>
        </div>

        <div class="overlap-text">
          <label>Ingrese su Mes y dia de Nacimiento</label>
          <input type="date" name="birthday" required>
        </div>

        <input type="submit" value="Registrarte" class="btn" name="submit" />

<?php  
if (isset($_POST['submit'])) {  

  require "conexion.php";

  $imagen = $_FILES['file-input']['tmp_name'];   
  $imagen_tipo = exif_imagetype($_FILES['file-input']['tmp_name']);

  if ($imagen_tipo == IMAGETYPE_PNG OR $imagen_tipo == IMAGETYPE_JPEG OR $imagen_tipo == IMAGETYPE_BMP OR IMAGETYPE_GIF) {    		$email = $mysqli->real_escape_string($_POST['mail']);
		    $nombre = $mysqli->real_escape_string($_POST['nombre']);
		    $usuario = $mysqli->real_escape_string($_POST['usuario']);
		    $password = md5($_POST['password']);
		    $sex=$mysqli->real_escape_string($_POST['sex']);
		    $location=$mysqli->real_escape_string($_POST['location']);
		    $birthday=$mysqli->real_escape_string($_POST['birthday']);
		    $phone=$mysqli->real_escape_string($_POST['phone']);
		    $id=$mysqli->real_escape_string($_SESSION['id']);


		    if(is_uploaded_file($_FILES['file-input']['tmp_name'])) { 

		        $result = $mysqli->query("SHOW TABLE STATUS WHERE `Name` = 'archivos'");
		        $data = $result->fetch_assoc();
		        $next_id = $data['Auto_increment'];

		        $ext = ".jpg"; 
		        $namefinal = trim ($_FILES['file-input']['name']);
		        $namefinal = str_replace (" ", "", $namefinal);
		        $aleatorio = substr(strtoupper(md5(microtime(true))), 0,6);
		        $namefinal = 'ID-'.$next_id.'-NAME-'.$aleatorio; 

		        if ($imagen_tipo == IMAGETYPE_PNG) {
		          $image = imagecreatefrompng($imagen);
		          imagejpeg($image, 'perfil/'.$namefinal.$ext, 100);           

		          $nuevaimagen = 'perfil/'.$namefinal.$ext;
		        }

		        else {
		          $nuevaimagen = $imagen;
		        }

		        $original = imagecreatefromjpeg($nuevaimagen);
		        $max_ancho = 1080; $max_alto = 1080;
		        list($ancho,$alto)=getimagesize($nuevaimagen);

		        $x_ratio = $max_ancho / $ancho;
		        $y_ratio = $max_alto / $alto;

		        if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		            $ancho_final = $ancho;
		            $alto_final = $alto;
		        }
		        else if(($x_ratio * $alto) < $max_alto){
		            $alto_final = ceil($x_ratio * $alto);
		            $ancho_final = $max_ancho;
		        }
		        else {
		            $ancho_final = ceil($y_ratio * $ancho);
		            $alto_final = $max_alto;
		        }

		        $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

		        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
		         
		        imagedestroy($original);

		        imagejpeg($lienzo,"perfil/".$namefinal.$ext);

		      }


		        if($_FILES['file-input']['tmp_name']) {
		        	$query="UPDATE users SET email ='".$email."', name='".$nombre."', username = '".$usuario."', password ='".$password."', sex = '".$sex."', location ='".$location."',birthday='".$birthday."', phone ='".$phone."',avatar='".$namefinal.$ext."' WHERE id=".$id."";
              $mysqli->query($query);

		      
		        }  
		    }  


		     else {echo "<script type='text/javascript'>alert('Solo puedes subir imágenes');</script>";}
		      echo '<h3 style="background-color: green; color: white; text-align:center">Felicidades '.$usuario.' se ha modificado toda su informacion correctamente, vuelva a su perfil y compruebelo usted mismo</h3>
         ';

     } 
		?> 

      </div>
    </form>
		</div>

	</div>


</body>
</html>