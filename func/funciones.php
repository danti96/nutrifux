<?php 

function isNullLogin($nom_user, $password){
	if(strlen(trim($nom_user)) < 1 || strlen(trim($password)) < 1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
 }

	function login($usuario, $password)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT us_id, tp_id, us_password FROM usuario WHERE us_usuario = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['us_id'] = $id;
					$_SESSION['tp_id'] = $id_tipo;
					
					header("location: sistema/index.php");
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no existe';
			}
			} else {
			$errors = "El nombre de usuario es incorrecto.";
		}
		return $errors;
	}
function resultBlock($errors){
	if(count($errors) > 0)
	{
		echo "<div id='error'style='color:red;padding:5px;' role='alert'>
		<ul style='list-style-type: none;padding:0;'>";
		foreach($errors as $error)
		{
			echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}
function resultado( $resultado ){
	if ($resultado == "VACIO" ){
		echo "<div class='col-sm' style='color:red;padding:5px;'> Debe completar todos los campos. </div>";
	}
	if ($resultado == "USUARIOIN" ){
		echo "<div class='col-sm' style='color:red;padding:5px;'> El nombre de usuario es incorrecto. </div>";
	}
	if ($resultado == "USUARIONO" ){
		echo "<div class='col-sm' style='color:red;padding:5px;'> El usuario no existe. </div>";
	}
	if ($resultado == "PASSWORDIN" ){
		echo "<div class='col-sm' style='color:red;padding:5px;'> La contrase&ntilde;a es incorrecta. </div>";
	}
 }
function isActivo($nom_user){
	global $mysqli;
	
	$stmt = $mysqli->prepare("SELECT us_estado FROM usuario WHERE us_usuario  = ? LIMIT 1");
	$stmt->bind_param('s', $nom_user);
	$stmt->execute();
	$stmt->bind_result($activacion);
	$stmt->fetch();
	
	if ($activacion == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}
}
function lastSession($id)
{
	global $mysqli;
	
	$stmt = $mysqli->prepare("UPDATE usuario SET us_last_session=NOW() WHERE us_id = ?");
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();
}
 ?>