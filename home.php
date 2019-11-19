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
  <title>InstanMayan</title>
  <meta charset="UTF-8">
  <meta name="title" content="InstaMayan">
  <meta name="description" content="InstaMayan">
  <link href="css/style(original).css" rel="stylesheet" type="text/css" />
  <link href="css/instagram.css" rel="stylesheet" type="text/css" />
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="js/likes.js"></script>
  <script src="js/favoritos.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.elevatezoom.min.js"></script>
</head>

<body>

  <?php
require("conexion.php");

$consultaA = "SELECT confirmed FROM users WHERE username = '".$_SESSION['username']."'";
$resultadoA = $mysqli->query($consultaA);
$row = $resultadoA->fetch_array();

if($row['confirmed'] == 0) {
	echo "<div class='topbarc'><a href='codigo.php'>Confirma tu email aquí </a></div>";
}

$mysqli->close();
?>

  <?php include "header.php"; ?>
  <div class="container">
    <div class="row">

      <?php
		require "conexion.php";

		$sqlA = $mysqli->query("SELECT * FROM  publicaciones  ORDER BY id DESC");
		while($rowA = $sqlA->fetch_array()) {
			$sqlB = $mysqli->query("SELECT * FROM users WHERE id = '".$rowA['user']."'");
				$rowB = $sqlB->fetch_array();
			$sqlC = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowA['id']."'");
				$rowC = $sqlC->fetch_array();
				

			$countLikes = $mysqli->query("SELECT * FROM likes WHERE usuario = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes = $countLikes->num_rows;

			$countLikes2 = $mysqli->query("SELECT * FROM favoritos WHERE usuario = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes2 = $countLikes2->num_rows;
		?>

      <div class="border rounded col-12 " style="margin: 50px 0px 10px;">
        
        <div class="" style="padding: 10px 0px 0px;">
          <div class="" style="display:flex;";>
            <a href="perfil.php?username=<?php echo $rowB['username'];?>"><img
                  src="images/<?php echo $rowB['avatar']; ?>" width="50px" height="50px"></a>
            <h1 href="perfil.php?username=<?php echo $rowB['username'];?>"><?php echo $rowB['username'];?></h1>
          </div>
        </div>
        
        <div class="containerr">
          <div class="imagen">
            <img src="archivos/<?php echo $rowC['ruta']; ?>" width="100%" class="<?php echo $rowC['filtro']; ?>"
              alt="Notebook" style="width:100%;">

          </div>
        </div>

        <div class="likes" style="align-items:center; margin: 10px 0px; display: flex; flex-direction: row;">

          <?php if($cLikes == 0) { ?>
            <div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer; margin: 0px 10px 0px 0px;"><img
              src="images/icons/cora.png" width="25px">
            </div>
              
          <?php } else { ?>
            <div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer; margin: 0px 10px 0px 0px;"><img
              src="images/icons/cora2.png" width="25px">
            </div>
              
          <?php } ?>
        <div class="comentario">
            <strong style="color: #262626;"><?php echo $rowB['username']; ?></strong> <?php echo $rowA['descripcion']; ?>
            </div>
        </div>
      </div>

      <?php } ?>

    </div>



  </div>
    <?php include "footer.php"; ?>
  <script type="text/javascript" src="js/main.js"></script>
    
</body>



</html>