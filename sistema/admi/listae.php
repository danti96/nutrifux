<?php
include '../../func/conexion.php';

$consultar ="SELECT je.jorem_id, 
					CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, 
					je.jorem_horaentrada, je.jorem_minentrada, 
					CONCAT(je.jorem_horaentrada,' : ',je.jorem_minentrada)hora_inicio, 
					je.jorem_horaalmuerzo, je.jorem_minalmuerzo, 
					CONCAT(je.jorem_horaalmuerzo,' : ',je.jorem_minalmuerzo)hora_almuerzo, 
					je.jorem_horaretorno, je.jorem_minretorno, 
					CONCAT(je.jorem_horaretorno,' : ',je.jorem_minretorno)hora_retorno, 
					je.jorem_horasalida, je.jorem_minsalida, 
					CONCAT(je.jorem_horasalida,' : ',je.jorem_minsalida)hora_salida, 
					je.jorem_dia 
			FROM jornada_empleado je 
			INNER JOIN empleado em ON je.em_id = em.em_id";
$resultado = mysqli_query($mysqli, $consultar);
$num=$resultado->num_rows;
if (!$resultado) {
	 die("Error");
}else{
	if ($num>0) {
		while ($data = mysqli_fetch_assoc($resultado)) {
			$arreglo["data"][] = array_map("utf8_encode", $data);
		}
	}else{

		$arreglo[] = "";
	}
	echo json_encode($arreglo);
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>
