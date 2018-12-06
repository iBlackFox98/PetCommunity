<?php
					//Servidor			Usuario	contraseña	Basededatos
$mysqli = new mysqli("127.0.0.1:33065", "root", "", "petcommunity");

if($mysqli->connect_errno) {
	echo "Falló la conexion a la base de datos";
}

return $mysqli;

?>
