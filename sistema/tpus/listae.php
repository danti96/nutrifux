<?php
include '../../func/conexion.php';

$consultar ="SELECT tp_id, tp_nombre, tp_detalle, IF(`tp_estado` = '1','Habilitado','Deshabilitado' )estado  FROM tipo_usuario";
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