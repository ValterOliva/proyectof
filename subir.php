<?php
ob_start();
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}
error_reporting(0);
include "functions.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>InstaMayan</title>
	<meta charset="UTF-8">
	<meta name="title" content="InstaMayan">
	<meta name="description" content="InstaMayan">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/instagram.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(window).load(function () {
			$(function () {
				$('#file-input').change(function (e) {
					addImage(e);
				});

				function addImage(e) {
					var file = e.target.files[0],
						imageType = /image.*/;

					if (!file.type.match(imageType))
						return;

					var reader = new FileReader();
					reader.onload = fileOnload;
					reader.readAsDataURL(file);
				}

				function fileOnload(e) {
					var result = e.target.result;
					$('#imgSalida').attr("src", result);
				}
			});
		});
	</script>

	<script>
		function capturar() {
			var resultado = "";

			var porNombre = document.getElementsByName("filter");
			for (var i = 0; i < porNombre.length; i++) {
				if (porNombre[i].checked)
					resultado = porNombre[i].value;
			}

			var elemento = document.getElementById("resultado");
			if (elemento.className == "") {
				elemento.className = resultado;
				elemento.width = "600";
			} else {
				elemento.className = resultado;
				elemento.width = "600";
			}
		}
	</script>
</head>

<?php include "header.php"; ?>

<body>


	<div class="container-fluid" onload="capturar()">
		<form action="" method="post" enctype="multipart/form-data">
			<div class=" row filtros">
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="" onclick="capturar()">
						<img src="images/filtros.jpg" class="" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="reyes" onclick="capturar()">
						<img src="images/filtros.jpg" class="reyes" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="sierra" onclick="capturar()">
						<img src="images/filtros.jpg" class="sierra" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="gingham" onclick="capturar()">
						<img src="images/filtros.jpg" class="gingham" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="stinson" onclick="capturar()">
						<img src="images/filtros.jpg" class="stinson" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="maven" onclick="capturar()">
						<img src="images/filtros.jpg" class="maven" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="kelvin" onclick="capturar()">
						<img src="images/filtros.jpg" class="kelvin" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="Lo-Fi" onclick="capturar()">
						<img src="images/filtros.jpg" class="Lo-Fi" width="200">
					</label>
				</div>
				<div class="col-lg-2 col-sm-4 imgcheck">
					<label>
						<input type="radio" name="filter" value="moon" onclick="capturar()">
						<img src="images/filtros.jpg" class="moon" width="200">
					</label>
				</div>
			</div>

			<div class="row">
				<div class="col-12 upload" style="display: flex; justify-content: center; margin-top: 20px;">
					<div class="image-upload">
						<label for="file-input">
							<img src="images/icons/UPLOAD.png" width="100px" title="Subir Foto"> <center><p style="font-size: 25px;">SUBIR</p></center>
						</label>
						<input id="file-input" type="file" name="file-input" hidden="" />
					</div>
				</div>
			</div>


			<div class="row">
				<div id="resultado" class="col-12" style="display: flex; justify-content: center; margin: 10px;">
					<img id="imgSalida" width="500px" />
				</div>
			</div>

			<div class="row">
				<div class="col-12" style="display: flex; flex-direction: column; justify-content: center; margin-top: 5px;">
					<textarea rows="6" cols="100%" name="descripcion"
						placeholder="Descripción de tu publicación"></textarea>
				</div>
				<div class="col-12" style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 10px;">
				<button name="submit" type="submit" class="myButton btn btn-primary btn-lg active" style="max-width: 150px;">COMPARTIR</button>
				</div>
			</div>
		</form>
	</div>



	<?php  
if (isset($_POST['submit'])) {  

  require "conexion.php";

  $imagen = $_FILES['file-input']['tmp_name'];   
  $imagen_tipo = exif_imagetype($_FILES['file-input']['tmp_name']);

  if ($imagen_tipo == IMAGETYPE_PNG OR $imagen_tipo == IMAGETYPE_JPEG OR $imagen_tipo == IMAGETYPE_BMP) {

  $filtro = $mysqli->real_escape_string($_POST['filter']);
  $descripcion = $mysqli->real_escape_string($_POST['descripcion']);

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
          imagejpeg($image, 'archivos/'.$namefinal.$ext, 100);           

          $nuevaimagen = 'archivos/'.$namefinal.$ext;
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

        imagejpeg($lienzo,"archivos/".$namefinal.$ext);

      }


        if($_FILES['file-input']['tmp_name']) {

          $queryp = $mysqli->query("INSERT INTO publicaciones (user,descripcion,fecha) VALUES ('".$_SESSION['id']."','".$descripcion."',now())");

          $ultpub = $mysqli->query("SELECT id FROM publicaciones WHERE user = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
          $ultp = $ultpub->fetch_array();

          $query = "INSERT INTO archivos (user,ruta,tipo,size,publicacion,filtro,fecha) VALUES ('".$_SESSION['id']."','".$namefinal.$ext."','".$_FILES['file-input']['type']."','".$_FILES['file-input']['size']."','".$ultp['id']."','".$filtro."',now())";

       $mysqli->query($query); 

       if($query) {header("refresh: 0; url = home.php");}
        }  
    }  

     else {echo "<script type='text/javascript'>alert('Solo puedes subir imágenes');</script>";}
 } 
?>
</body>

</html>