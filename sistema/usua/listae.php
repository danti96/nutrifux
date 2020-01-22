<?php
include '../../func/conexion.php';

$consultar ="SELECT (t1.us_id)idus, (t1.us_usuario)usuario, IF(t1.us_estado = '1','Habilitado','Deshabilitado' )estado, (t2.tp_nombre)nombre FROM usuario t1 INNER JOIN tipo_usuario t2 on t1.tp_id = t2.tp_id";
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
