<?php
include '../../func/conexion.php';

$consultar ="SELECT pa.pa_id, iden.iden_id,(iden.iden_nombre)documento, pa.pa_dni, pa.pa_primernombre, pa.pa_segundonombre, CONCAT(pa.pa_primernombre,' ',pa.pa_segundonombre)nombre, pa.pa_primerapellido, pa.pa_segundoapellido, CONCAT(pa.pa_primerapellido,' ', pa.pa_segundoapellido)apellido, pa.pa_genero, pa.pa_foto, pa.pa_fechanaci, pa.pa_direccion, pa.pa_tlfcasa, pa.pa_tlfmovil, pa.pa_correo, IF(pa.pa_estado = '1','Habilitado','Deshabilitado' )estado FROM paciente pa INNER JOIN identificacion iden on pa.iden_id = iden.iden_id";
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
