<?php
include '../../Conex/conexion.php';
 
$opcion = $mysqli->real_escape_string($_POST['listam']);

switch ($opcion) {
	case 'Matutino':
$consultar ="SELECT CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, jorem.jorem_horaentrada, jorem.jorem_horaalmuerzo FROM jornada_empleado jorem INNER JOIN empleado em ON em.em_id=jorem.jorem_id WHERE jorem.jorem_horaentrada BETWEEN 08 and 12 ";
 		break;
	
	case 'Vespertino':
$consultar ="SELECT CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, jorem.jorem_horaentrada, jorem.jorem_horaalmuerzo FROM jornada_empleado jorem INNER JOIN empleado em ON em.em_id=jorem.jorem_id WHERE jorem.jorem_horaentrada BETWEEN 12 and 18 ";
 		break;
}


$resultado = mysqli_query($mysqli, $consultar);


if (!$resultado) {
	 die("Error");
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
		$arreglo["data"][] = array_map("utf8_encode", $data);
	}
	echo json_encode($arreglo);
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>
