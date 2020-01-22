<?php
include '../../func/conexion.php';

$consultar ="SELECT CONCAT(empes.emp_esp_id)idempes, CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)nombre, CONCAT(esp.esp_nombre)especinom FROM emp_esp empes INNER JOIN especialidad esp on empes.esp_id=esp.esp_id INNER JOIN empleado em on em.em_id=empes.em_id  ORDER BY empes.esp_id ASC";
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
