<?php

$mysqli = new mysqli("localhost","u792848188_kevin", "ajce3rgx.", "u792848188_photogram");

if($mysqli->connect_errno) {
	echo "Falló la conexion a la base de datos";
}

return $mysqli;

?>
