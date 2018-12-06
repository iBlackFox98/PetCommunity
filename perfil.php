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
    <title>Perfil</title>    
    <meta charset="UTF-8">
    <meta name="title" content="PetCommunity">
    <meta name="description" content="PetCommunity">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  
  <body>   

  	<?php

  	if(isset($_GET['username'])) {

  		require "conexion.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
  		$rowA = $sqlA->fetch_array();

  		

  		$sqlB = $mysqli->query("SELECT * FROM publicaciones WHERE user = '".$rowA['id']."' ORDER BY id DESC");
  		$sqlFollowed = $mysqli->query("SELECT * FROM seguidores WHERE idFollower ='".$rowA['id']."'");
  		$sqlFollowers= $mysqli->query("SELECT * FROM seguidores WHERE idFollowed ='".$rowA['id']."'" );

  		$totalp = $sqlB->num_rows;
  		$totalSeguidores=$sqlFollowers->num_rows;
  		$totalSeguidos=$sqlFollowed->num_rows;
  		$sqlC=$mysqli->query("SELECT * FROM seguidores WHERE idFollowed =".$rowA['id']." AND idFollower = ".$_SESSION['id']."");
  		$siguen=$sqlC->num_rows;

  		$sqlPerfil=$mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
  		$rowPerfil=$sqlPerfil->fetch_array();



  	?>

<?php include "header.php"; ?>

<div class="h-content">
	
	<div class="p-top">
		<div class="p-foto"><img src="perfil/<?php echo $rowPerfil['avatar'];?>" width="180" height="180"></div>
		<div class="p-name">
			<div class="p-user">
			<label><?php echo $rowPerfil['name']; ?></label>
			<?php if($rowPerfil['id'] === $_SESSION['id']) { ?>
			<a href="editar.php"><div class="p-editar"><button class="button_white">Editar perfil</button></div></a>	
			<div class="hl-icon"><a href="subir.php"><img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" ></a></div>
			<a href="subir.php" style="text-decoration: none;color: #000000"><label style="font-size: 15px; margin-left: 1%">Nueva Publicación</label></a>
			<?php 
			} else {


			if($siguen===0) {?>

			<form action="seguir.php?username=<?php echo $rowPerfil['username'];?>&seguir=1" method="post"><div class="p-editar"><button class="button_blue">Seguir</button></div></form>
			<?php } else {?>
			<form action="seguir.php?username=<?php echo $rowPerfil['username'];?>&seguir=2" method="post"><div class="p-editar"><button class="button_gray">Siguiendo</button></div></form>

			<?php }} ?>

		</div>
		<div class="p-info">
			<div class="p-infor"><b><?php echo $totalp; ?> </b> publicaciones</div>
			<div class="p-infor"><b><?php echo $totalSeguidores; ?></b> seguidores</div>
			<div class="p-infor"><b><?php echo $totalSeguidos; ?></b> Siguiendo</div>
		</div>
		<div class="p-nombre"><?php echo $rowPerfil['name'];?></div>
		<div class="p-nombre"><?php echo $rowPerfil['phone'];?></div>
		<div class="p-location"><?php echo $rowPerfil['location']; ?></div>
		<div class="p-description"><?php echo $rowPerfil['bio'];?></div>
	</div>

	<div class="p-mid">

		<?php 
			if($rowPerfil['private_profile'] == 1 AND $rowPerfil['id'] != $_SESSION['id'])
				{echo "Si deseas ver sus fotos o videos sigue a este usuario";}

			else {
		?>

		<?php
		while($rowC = $sqlB->fetch_array()) {
			$sqlD = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowC['id']."'");
			$rowD = $sqlD->fetch_array();
		?>
			<a href="publicacion.php?id=<?php echo $rowC['id'] ?>&&idP=<?php echo $rowD['id'] ?>&user=<?php echo $rowPerfil['id'] ?>">
				<div class="p-pub <?php echo $rowD['filtro']; ?>" style="background-image: url('archivos/<?php echo $rowD['ruta']; ?>');"></div>
			</a>
		<?php } ?>

		<?php } ?>


	</div>

</div>

<?php } ?>

  </body>  
</html>