	<?php 
	///////////////////////////////////////////////////
	function isNull($user,$pass,$tp_user){	
		if(strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($tp_user)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function valuser($user){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT us_usuario FROM usuario WHERE us_usuario = ? LIMIT 1");
		$stmt->bind_param("s", $user);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
 		
		if ($num > 0){
			return true;
		}else{
			return false;
		}
	}
	function valusert($user,$id ){	
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT us_usuario, us_id FROM usuario WHERE us_usuario = ? LIMIT 1");
		$stmt->bind_param("s", $user);
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
	function hashPassword($pass1) {
		$hash = password_hash($pass1, PASSWORD_DEFAULT);
		return $hash;
	}
	function rgst_user($user,$pass_hash,$tp_user){
		global $mysqli;

 		$stmt = $mysqli->prepare("INSERT INTO usuario (us_usuario, us_password, tp_id) VALUES(?,?,?)");
		$stmt->bind_param('sss',$user,$pass_hash,$tp_user);
		if ($stmt->execute()){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar($id,$nombre,$pass_hash,$tpnombre){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE usuario SET us_usuario = '$nombre', us_password = '$pass_hash', tp_id = '$tpnombre' WHERE us_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM usuario WHERE us_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE usuario SET us_estado = CASE WHEN us_estado = 0 then 1 WHEN us_estado = 1 then 0 END WHERE us_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	} 
//////////////////////////////////////////////////////////////////
 ?>