<?php 
include '../../../func/conexion.php';
$temp="";
$sql=("SELECT esp_id, esp_nombre FROM especialidad");
if (isset($_POST["busqueda"])) {
	$sql="SELECT esp_id, esp_nombre FROM especialidad WHERE esp_nombre LIKE '%".$_POST["busqueda"]."%'";
	$results_busc = $mysqli->query($sql);
	if ($results_busc->num_rows > 0) {

		$temp="<select class='form-control' name='especialidad' id='especialidad' style='font-weight :bold' required>";
			while ($res_bus = $results_busc->fetch_array()) {
				$temp.="<option value='".$res_bus['esp_id']."'>".$res_bus['esp_nombre']."</option>";
				}
		$temp.="</select>";

	} else {
		$temp.= "No se encontraron coincidencias con sus criterios de b&uacute;squeda";
	}
}
else{
	
	$results_busc = $mysqli->query($sql);
	if ($results_busc->num_rows > 0) {

		$temp="<select class='form-control'  name='especialidad' id='especialidad' style='font-weight :bold' required>";
				$temp.="<option></option>";
			while ($res_bus = $results_busc->fetch_array()) {
				$temp.="<option value='".$res_bus['esp_id']."'>".$res_bus['esp_nombre']."</option>";
				}
		$temp.=" </select>";

	} else {
		$temp.= "No se encontraron coincidencias con sus criterios de b&uacute;squeda";
	}
}

echo $temp;
 ?>