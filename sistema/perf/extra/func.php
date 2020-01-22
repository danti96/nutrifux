<?php 
///////////////////////////////////////////////////
function isNull($user, $pass, $pass1, $pass2){
	if(strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass1)) < 1 || strlen(trim($pass2)) < 1 )
	{
		return true;
		} else {
		return false;
	}
}
function usuarioExiste($usuario,$id){
	global $mysqli;
	
	$stmt = $mysqli->prepare("SELECT us_id FROM usuario WHERE us_usuario = ? LIMIT 1");

	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;
	if($rows > 0) {
		$stmt->bind_result($us_id);
		$stmt->fetch();
		if (strcmp($id, $us_id) === 0){
			return false;
		} else {
			return true;
		} 
	}

}
function contra($id,$pass){
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT us_password FROM usuario WHERE us_id = ?  LIMIT 1");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;
	if($rows > 0) {
		$stmt->bind_result($passwd);
		$stmt->fetch();
		if(password_verify($pass, $passwd)){
			return false;
		} else {
			return true;
		}
	}
}
function contrasena($pass1,$pass2){
	if (strcmp($pass1, $pass2) === 0){
		return false;
	} else {
		return true;
	}
}
function hashPassword($pass1) 
{
	$hash = password_hash($pass1, PASSWORD_DEFAULT);
	return $hash;
}
 
?>