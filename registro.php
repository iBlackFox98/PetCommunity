<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>PetCommunity</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
 
<body>

<div id="wrapper">

  <?php
  if(isset($_POST['registro'])) {

    require("conexion.php");

    $email = $mysqli->real_escape_string($_POST['mail']);
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $password = md5($_POST['password']);
    $sex=$mysqli->real_escape_string($_POST['sex']);
    $location=$mysqli->real_escape_string($_POST['location']);
    $birthday=$mysqli->real_escape_string($_POST['birthday']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $phone=$mysqli->real_escape_string($_POST['phone']);



    $consultausuario = "SELECT username FROM users WHERE username = '$usuario'";
    $consultaemail = "SELECT email FROM users WHERE email = '$email'";

    if($resultadousuario = $mysqli->query($consultausuario));
    $numerousuario = $resultadousuario->num_rows;

    if($resultadoemail = $mysqli->query($consultaemail));
    $numeroemail = $resultadoemail->num_rows;

    if($numeroemail>0) {
      echo "Este correo ya esta registrado, intenta con otro";
    }

    elseif($numerousuario>0) {
      echo "Este usuario ya existe";
    }

    else {


      $aleatorio = uniqid();

         
          $query = "INSERT INTO users (email,name,username,password,signup_date,last_ip,code,sex,location,birthday,phone) VALUES ('$email','$nombre','$usuario','$password',now(),'$ip','$aleatorio','$sex','$location','$birthday','$phone')";


      if($registro = $mysqli->query($query)) {
         Header("Refresh: 2; URL=index.php");

        echo '<h3 style="background-color: green; color: white; text-align:center">Felicidades '.$usuario.' se ha registrado correctamente.</h3>';


      }

      else {

        echo '<h3 style="background-color: red; color: white;">Ha ocurrido un error en el registro, intentelo de nuevo</h3>';
        header("Refresh: 2; URL=registro.php");

      }


    }

    $mysqli->close();

  }
  ?>


  
  <div class="main-content">
    <div class="header">
      <img src="images/logo.png"/>
    </div>
    <form action="" method="post">
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

        <input type="submit" value="Registrarte" class="btn" name="registro" />
      </div>
    </form>
  </div>
  <div class="sub-content">
    <div class="s-part">
      ¿Tienes una cuenta? <a href="index.php">Entrar</a>
    </div>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>