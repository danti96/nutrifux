<?php 
	function modificar($id,$hora_e,$min_en,$hora_a,$min_al,$hora_r,$min_re,$hora_s,$min_sa,$arraydia){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE jornada_empleado SET jorem_horaentrada = '$hora_e', 
																 jorem_minentrada  = '$min_en', 
																 jorem_horaalmuerzo= '$hora_a', 
																 jorem_minalmuerzo = '$min_al',
																 jorem_horaretorno = '$hora_r', 
																 jorem_minretorno  = '$min_re', 
																 jorem_horasalida  = '$hora_s',
																 jorem_minsalida   = '$min_sa', 
																		 jorem_dia = '$arraydia'
															WHERE jorem_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM jornada_empleado WHERE jorem_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE jornada_empleado SET car_estado = CASE WHEN car_estado = 0 then 1 WHEN car_estado = 1 then 0 END WHERE jorem_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
 ?>