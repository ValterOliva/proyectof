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
	<title>InstaMayan</title>
	<meta charset="UTF-8">
	<meta name="title" content="Photogram">
	<meta name="description" content="Photogram">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/instagram.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<?php

  	if(isset($_GET['username'])) {

  		require "conexion.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
  		$rowA = $sqlA->fetch_array();

  		$sqlB = $mysqli->query("SELECT * FROM publicaciones WHERE user = '".$rowA['id']."' ORDER BY id DESC");
  		$totalp = $sqlB->num_rows;

  		$sqlC = $mysqli->query("SELECT * FROM seguidores WHERE seguido = '".$rowA['id']."' AND aprobada = 1");
  		$totalS = $sqlC->num_rows;

  		$sqlD = $mysqli->query("SELECT * FROM seguidores WHERE seguidor = '".$rowA['id']."' AND aprobada = 1");
  		$totalSe = $sqlD->num_rows;

  		$yaExiste = $mysqli->query("SELECT * FROM seguidores WHERE seguidor = '".$_SESSION['id']."'");
  		$yaEnviaste = $yaExiste->num_rows;

  		$yaAprobo = $mysqli->query("SELECT * FROM seguidores WHERE seguidor = '".$_SESSION['id']."' AND aprobada = 1");
  		$tAprobo = $yaAprobo->num_rows;

  	?>

	<?php 
  		if(isset($_GET['seguir'])) {
  			require "conexion.php";

  			if($yaEnviaste > 0) {echo "Ya enviaste una solicitud a este usuario";} else {

	  			if($rowA['private_profile'] == 1) {$aprobado = 0;} else {$aprobado = 1;}

	  			$sqlG = $mysqli->query("INSERT INTO seguidores (seguidor,seguido,aprobada,fecha) VALUES ('".$_SESSION['id']."','".$rowA['id']."','$aprobado',now())");

	  			if($sqlG) {header("Location: perfil.php?username=".$_GET['username']."");}
	  		}
  		}
  	?>

	<?php include "header.php"; ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-sm-3" style=" display:flex; justify-content: center; align-items: center;">
				<img src="images/<?php echo $rowA['avatar'];?>" width="180" height="180">
			</div>
			<div class="col-lg-10 col-sm-9"
				style="display:flex; flex-direction: column; justify-content: center; padding-top: 20px;">
				<div class="perfil">
					<div class="p-user"><?php echo $rowA['username'];?></div>
					<?php if($rowA['verified'] == 1) { ?>
					<div class="p-user"><img src="images/verificado.png"></div>
					<?php } ?>
					<?php if($rowA['id'] == $_SESSION['id']) { ?>
					<div class="p-editar"><a href="editar_perfil.php"><button class="button_white">Editar
								perfil</button></a></div>
					<?php } else { ?>

					<?php if($tAprobo == 0) { ?>

					<?php if($yaEnviaste > 0) { ?>
					<div class="p-editar"><button class="button_blue">Solicitud enviada</button></div>
					<?php } else { ?>
					<a href="?seguir=seguir&username=<?php echo $_GET['username']; ?>">
						<div class="p-editar"><button class="button_blue">Seguir</button></div>
					</a>
					<?php } ?>

					<?php } ?>

					<?php } ?>
				</div>
				<div class="data" style="display:flex; flex-direction: column; justify-content: center; margin: 0px;">
					<div class="p-infor"><b><?php echo $totalp; ?></b> publicaciones</div>
					<div class="p-infor"><b><?php echo $totalS; ?></b> seguidores</div>
					<div class="p-infor"><b><?php echo $totalSe; ?></b> seguidos</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col" style="margin: 0px 0px 0px 30px;">
				<div class="p-nombre"><?php echo $rowA['name'];?></div>
				<div class="p-location">Guatemala,Guatemala</div>
				<div class="p-description"><?php echo $rowA['bio'];?></div>
			</div>
		</div>
		<div class="row">
				<?php 
				if($rowA['private_profile'] == 1 AND $rowA['id'] != $_SESSION['id'] AND $tAprobo == 0)
				{echo "Si deseas ver sus fotos o videos sigue a este usuario";}
				else {
				?>

				<?php
				while($rowC = $sqlB->fetch_array()) {
				$sqlD = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowC['id']."'");
				$rowD = $sqlD->fetch_array();
				?>
				<div class="col-4" style="margin:10px 0px;">
					<img class="img-thumbnail" src="archivos/<?php echo $rowD['ruta']; ?>" width="100%" class="<?php echo $rowC['filtro']; ?>"
						alt="Notebook">
				</div>
				<?php } ?> <?php } ?>
				<?php } ?>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>