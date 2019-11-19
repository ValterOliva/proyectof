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
	<title>Photogram</title>
	<meta charset="UTF-8">
	<meta name="title" content="Photogram">
	<meta name="description" content="Photogram">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/instagram.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<?php

  		require "conexion.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
  		$rowA = $sqlA->fetch_array();

  	?>

	<?php include "header.php"; ?>
	<div class="container">
		<div class="row" style="background-color: red;">
			<div class="col-12 editar" style="display: flex; flex-direction: row; justify-content: center;">
				<nav class="navbar navbar-light bg-light">
					<div class="navbar-nav" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
						<a class="nav-item nav-link active" style="margin: 0px 20px;" href="editar_perfil.php">Editar Perfil</a>
						<a class="nav-item nav-link" style="margin: 0px 20px;" href="editar_pass.php">Cambiar Contraseña</a>
						<a class="nav-item nav-link" style="margin: 0px 20px;" href="editar_privacidad.php">Privacidad</a>
					</div>
				</nav>
			</div>
		</div>
		<div class="row" style="background-color: orange;">
			<div class="col-12 perfil"
				style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
				<div class="imagen"><img src="images/<?php echo $rowA['avatar']; ?>" width="80px"></div>
				<div class="usuario" style="font-size: 40px;"><?php echo $rowA['username']; ?></div>
			</div>
		</div>
		<form action="" method="post" style="margin: 10px 0px">

			<?php
				if(isset($_POST['editar'])) {
					require "conexion.php";
	
					$nombre = $mysqli->real_escape_string($_POST['nombre']);
					$username = $mysqli->real_escape_string($_POST['username']);
					$bio = $mysqli->real_escape_string($_POST['bio']);
					$email = $mysqli->real_escape_string($_POST['email']);
	
					$sqlB = $mysqli->query("SELECT * FROM users WHERE username = '$username' AND id != '".$_SESSION['id']."'");
					$totalusuarios = $sqlB->num_rows;
	
					$sqlC = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND id != '".$_SESSION['id']."'");
					$totalemail = $sqlC->num_rows;
	
					if($totalusuarios > 0) {$existe = "Ya hay un usuario con este nombre";} 
	
					elseif ($totalemail > 0) {$existe2 = "Ya hay un email registrado";} else  {
	
					$sqlE = $mysqli->query("UPDATE users SET name = '$nombre', username = '$username', bio = '$bio', email = '$email' WHERE id = '".$_SESSION['id']."'");
	
					if($sqlE) {header('Location: editar_perfil.php');}
	
				}
				}
				?>

			<div class="form-group row"
				style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
				<div class="col-2" style="text-align: right; font-size: 20px; padding: 0px; background-color: yellow;">
					<label for="form_nombre">
						<h5>Nombre de Usuario:</h5>
					</label>
				</div>
				<div class="col-4" style="margin: 0px 10px;">
					<input type="text" name="nombre" value="<?php echo $rowA['name']; ?>" autocomplete="off"
						class="form-control" id="form_nombre" placeholder="col-form-label">
				</div>
			</div>
			<div class="form-group row"
				style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
				<div class="col-2" style="text-align: right; font-size: 20px; padding: 0px; background-color: yellow;">
					<label for="form_bio">
						<h5>Biografia:</h5>
					</label>
				</div>
				<div class="col-4" style="margin: 0px 10px;">
					<input type="text" name="bio" value="<?php echo $rowA['bio']; ?>" autocomplete="off"
						class="form-control" id="form_bio" placeholder="col-form-label">
				</div>
			</div>
			<div class="form-group row"
				style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
				<div class="col-2" style="text-align: right; font-size: 20px; padding: 0px; background-color: yellow;">
					<label for="form_bio">
						<h5>Correo:</h5>
					</label>
				</div>
				<div class="col-4" style="margin: 0px 10px;">
					<input type="text" name="email" value="<?php echo $rowA['email']; ?>" autocomplete="off"
						class="form-control" id="form_correo" placeholder="col-form-label-lg">
				</div>
			</div>

		</form>
	</div>
	<div class="h-content">

		<div class="e-mid">

			<div class="e-left">

			</div>

			<form action="" method="post">

				<div class="e-right">
					<div class="e-contenido">
					</div>
					<div class="e-contenido">
						<div class="e-title">Nombre de usuario</div>
						<div class="e-input"><input type="text" name="username" value="<?php echo $rowA['username']; ?>"
								autocomplete="off">
							<br>
							<div style="color:red; font-size: 12px;"><?php if(isset($existe)) {echo $existe;} ?></div>
						</div>
					</div>
					<div class="e-contenido">
						<div class="e-title">Biografía</div>
						<div class="e-input"><input type="text" name="bio" value="<?php echo $rowA['bio']; ?>"
								autocomplete="off"></div>
					</div>
					<div class="e-contenido">
						<div class="e-title">Correo electrónico</div>
						<div class="e-input"><input type="text" name="email" value="<?php echo $rowA['email']; ?>"
								autocomplete="off">
							<br>
							<div style="color:red; font-size: 12px;"><?php if(isset($existe2)) {echo $existe2;} ?></div>
						</div>
					</div>
					<div class="e-contenido">
						<div class="e-title">Sexo</div>
						<div class="e-input">
							<select disabled="">
								<option value="">Sin especificar</option>
								<option value="0">Hombre</option>
								<option value="1">Mujer</option>
							</select>
						</div>
					</div>
					<div class="e-contenido">
						<div class="e-title"></div>
						<div class="e-but">
							<input type="submit" value="Editar" name="editar" class="button_blue"
								style="margin-left: 110px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
						</div>
					</div>

			</form>



		</div>

	</div>

	</div>

</body>

</html>