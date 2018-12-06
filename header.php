<div class="h-header">

	<?php 
		require "conexion.php";
		$consultaA = $mysqli->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
		$rowA=$consultaA->fetch_array();

	 ?>

	<div class="h-logo"><a href="home.php"><img src="images/logo.png" width="130"></a></div>
	
	<div class="h-account">
		<a href="perfil.php?username=<?php echo $rowA['username'] ?>"><img src="images/icons/perfil.png" class="i-icon"></a>
		<a href="logout.php"><img src="images/icons/close.png" class="i-icon" width="24px"></a>
	</div>
</div>