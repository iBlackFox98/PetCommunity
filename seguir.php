<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>
<?php 
	
	require "conexion.php";
	$sqlA=$mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
	$rowA = $sqlA->fetch_array();
	
	if($_GET['seguir']==='1')
	{

		$querySeguir ="INSERT INTO seguidores (idFollowed,idFollower) VALUES(".$rowA['id'].",".$_SESSION['id'].")";
	}
	else
	{
		$querySeguir ="DELETE FROM seguidores WHERE idFollowed =".$rowA['id']." AND idFollower =".$_SESSION['id']."";
	}

	
	$mysqli->query($querySeguir);
	Header("Refresh:0; URL=perfil.php?username=".$_GET['username']."");

	


 ?>