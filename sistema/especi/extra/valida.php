<?php 
include '../../../func/conexion.php';
$temp="";
$sql="SELECT em.em_id, em.em_dni, ca.car_nombre, CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado FROM empleado em INNER JOIN cargo ca on em.car_id=ca.car_id ORDER BY em_id DESC";

if (isset($_POST["busqueda"])) {
	$sql="SELECT em.em_id, em.em_dni, ca.car_nombre, CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado FROM empleado em INNER JOIN cargo ca on em.car_id=ca.car_id WHERE em.em_dni LIKE '%".$_POST["busqueda"]."%' OR em.em_primerapellido LIKE '%".$_POST["busqueda"]."%' OR em.em_segundoapellido LIKE '%".$_POST["busqueda"]."%'";
	$results_busc = $mysqli->query($sql);
	if ($results_busc->num_rows > 0) {

		$temp="<select class='form-control' name='employee' id='employee' style='font-weight :bold' >";
			while ($res_bus = $results_busc->fetch_array()) {
				$temp.="<option value='".$res_bus['em_id']."'>".$res_bus['empleado']." - ".$res_bus['car_nombre']."</option>";
				}
		$temp.="</select>";

	} else {
		$temp.= "No se encontraron coincidencias con sus criterios de b&uacute;squeda";
	}
}
else{
	$results_busc = $mysqli->query($sql);
	if ($results_busc->num_rows > 0) {

		$temp="<select class='form-control'  name='employee' id='employee' style='font-weight :bold' >";
				$temp.="<option></option>";
			while ($res_bus = $results_busc->fetch_array()) {
				$temp.="<option value='".$res_bus['em_id']."'>".$res_bus['empleado']." - ".$res_bus['car_nombre']."</option>";
				}
		$temp.=" </select>";
		

	} else {
		$temp.= "No se encontraron coincidencias con sus criterios de b&uacute;squeda";
	}
}

echo $temp;
 ?>