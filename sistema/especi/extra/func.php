	<?php 
	///////////////////////////////////////////////////
	function isNull($especialidad,$detalle){	
		if(strlen(trim($especialidad)) < 1 || strlen(trim($detalle)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function valespeci($especialidad){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT esp_nombre FROM especialidad WHERE esp_nombre = ? LIMIT 1");
		$stmt->bind_param("s", $especialidad);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}
	function valtpusert($especialidad,$id){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT esp_nombre, esp_id FROM especialidad WHERE esp_nombre = ? LIMIT 1");
		$stmt->bind_param("s", $nombre);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
 		
		if ($num > 0){
				$stmt->bind_result($r_n,$r_i);
				$stmt->fetch();
				if ( $id == $r_i ) {
					return false;
				}else{
					return true;
				}
 			} else {
			return false;
		}
	}
	function rgst_especi($especialidad,$detalle){
		global $mysqli;

 		$stmt = $mysqli->prepare("INSERT INTO especialidad (esp_nombre, esp_detalle) VALUES(?,?)");
		$stmt->bind_param('ss',$especialidad,$detalle);
		if ($stmt->execute()){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar ($especialidad,$detalle,$id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE especialidad SET esp_nombre = '$especialidad', esp_detalle = '$detalle' WHERE esp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM especialidad WHERE esp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminardos ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM emp_esp WHERE emp_esp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE especialidad SET esp_estado = CASE WHEN esp_estado = 0 then 1 WHEN esp_estado = 1 then 0 END WHERE esp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	} 
//////////////////////////////////////////////////////////////////
 ?>