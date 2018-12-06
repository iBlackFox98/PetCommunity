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

<?php
require("conexion.php");

$consultaA = "SELECT confirmed FROM users WHERE username = '".$_SESSION['username']."'";
$resultadoA = $mysqli->query($consultaA);
$row = $resultadoA->fetch_array();

$mysqli->close();
?> 

<?php include "header.php"; ?>

<div class="h-content">
	<div class="h-left">

		<?php
		require "conexion.php";

		$sqlA = $mysqli->query("SELECT * FROM publicaciones ORDER BY fecha DESC");
		while($rowA = $sqlA->fetch_array()) {
			$sqlB = $mysqli->query("SELECT * FROM users WHERE id = '".$rowA['user']."'");
				$rowB = $sqlB->fetch_array();
			$sqlC = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowA['id']."'");
				$rowC = $sqlC->fetch_array();

		?>

			<div class="hl-cont">

				<div class="hl-top">
					<a href="perfil.php?username=<?php echo $rowB['username'];?>">
						<div class="hl-profile">
							<div class="hl-pic"><img src="perfil/<?php echo $rowB['avatar']; ?>" width="50" height="50"></div>
						</div>
						
							<div class="hl-username">
								<div class="hl-name"><?php echo $rowB['username']; ?></div>
								<div class="hl-location"><?php $rowB['location'];?></div>
							</div>
					</a>
				</div>	
				<div class="hl-middle">
					<a href="publicacion.php?id=<?php echo $rowA['id']?>&idP=<?php echo $rowC['id']?>&user=<?php echo $rowB['id'] ?>"><img src="archivos/<?php echo $rowC['ruta']; ?>" width="100%" class="<?php echo $rowC['filtro']; ?>"></a>
				</div>	
				<div class="hl-bottom">
					<?php echo $rowA['descripcion']; ?>
				</div>			
			</div>
			

		<?php } ?>

	</div>

	<div class="h-right">		

		<div class="hl-menu">
			<div class="hl-icon home-icon"><a href="subir.php"><img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" ></a></div>
			<label class="hl-icon" style="color: #0A2709">Nueva Publicación</label>
		</div>
		
		<div class="hr-top">
			<?php 
				$SesionActual=$mysqli->query("SELECT * FROM users WHERE id ='".$_SESSION['id']."'");
				$rowUser=$SesionActual->fetch_array();

			 ?>
			<div class="hr-profile">
				<div class="hr-pic"><a href="perfil.php?username=<?php echo $rowUser['username'];?>"><img src="perfil/<?php datos_usuario($_SESSION['id'],'avatar'); ?>" width="60" height="60"></a></div>
			</div>
				<div class="hr-username">
					<div class="hr-name"><a href="perfil.php?username=<?php echo $rowUser['username'];?>"><?php echo $rowUser['username'];?></a></div>
				<div class="hr-nombre"><?php datos_usuario($_SESSION['id'],'name'); ?></div>
			</div>	
		</div>	
	</div>
</div>



  </body>  
</html>