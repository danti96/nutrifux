	<?php 
	///////////////////////////////////////////////////
	function isNull($nombre,$detalle){	
		if(strlen(trim($nombre)) < 1 || strlen(trim($detalle)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function valtpuser($nombre){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT tp_nombre FROM tipo_usuario WHERE tp_nombre = ? LIMIT 1");
		$stmt->bind_param("s", $nombre);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
 		
		if ($num > 0){
			return true;
		}else{
			return false;
		}
	}
	function valtpusert($nombre,$id){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT tp_nombre, tp_id FROM tipo_usuario WHERE tp_nombre = ? LIMIT 1");
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
	function rgst_tpuser($nombre,$detalle){
		global $mysqli;

 		$stmt = $mysqli->prepare("INSERT INTO tipo_usuario (tp_nombre, tp_detalle) VALUES(?,?)");
		$stmt->bind_param('ss',$nombre,$detalle);
		if ($stmt->execute()){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar ($nombre,$detalle,$id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE tipo_usuario SET tp_nombre = '$nombre', tp_detalle = '$detalle' WHERE tp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM tipo_usuario WHERE tp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE tipo_usuario SET tp_estado = CASE WHEN tp_estado = 0 then 1 WHEN tp_estado = 1 then 0 END WHERE tp_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	} 
 ?>