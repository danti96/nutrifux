	<?php 
	///////////////////////////////////////////////////
	function isNull($cargo,$detalle){	
		if(strlen(trim($cargo)) < 1 || strlen(trim($detalle)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function valcargo($cargo){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT car_nombre FROM cargo WHERE car_nombre = ? LIMIT 1");
		$stmt->bind_param("s", $cargo);
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
	function valcargot($cargo,$id){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT car_nombre, car_id FROM cargo WHERE car_nombre = ?  LIMIT 1");
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
	function rgst_cargo($cargo,$detalle){
		global $mysqli;

 		$stmt = $mysqli->prepare("INSERT INTO cargo (car_nombre, car_detalle) VALUES(?,?)");
		$stmt->bind_param('ss',$cargo,$detalle);
		if ($stmt->execute()){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar ($cargo,$detalle,$id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE cargo SET car_nombre = '$cargo', car_detalle = '$detalle' WHERE car_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM cargo WHERE car_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE cargo SET car_estado = CASE WHEN car_estado = 0 then 1 WHEN car_estado = 1 then 0 END WHERE car_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	} 
//////////////////////////////////////////////////////////////////
 ?>