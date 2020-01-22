<?php
include '../../func/conexion.php';

$consultar ="SELECT em.em_id, iden.iden_id, (iden.iden_nombre)documento, em.em_dni, em.em_primernombre, em.em_segundonombre,em.em_primerapellido,em.em_segundoapellido, CONCAT(em.em_primernombre,' ',em.em_segundonombre)nombre, CONCAT(em.em_primerapellido,' ',em.em_segundoapellido)apellido, em.em_fechanaci, em.em_genero, em.em_estadocivil, em.em_foto, ca.car_id, (ca.car_nombre)cargo, em.em_direccion, em.em_tlfcasa, em.em_tlfmovil, em.em_correo, IF( em.em_estado = '1','Habilitado','Deshabilitado' )estado FROM empleado em INNER JOIN identificacion iden on em.iden_id = iden.iden_id INNER JOIN cargo ca on ca.car_id = em.car_id";
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
