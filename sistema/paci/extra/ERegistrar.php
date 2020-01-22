<?php 
require "../../../func/conexion.php";
include 'func.php';

session_start(); //Iniciar una nueva sesión o reanudar la existente
$succecful = array();
$errors = array();

//////////////////////////////////////////////////////////////////
$opcion = $mysqli->real_escape_string($_POST['opcion']);

switch ($opcion) {
	case 'save':
		if(!empty($_POST))
		{
		$us_id	 	= $mysqli->real_escape_string($_POST['idus']);
		$iden_id  = $mysqli->real_escape_string($_POST['identification']);
		$pa_dni 	= $mysqli->real_escape_string($_POST['dni']);

		$pa_primernombre = $mysqli->real_escape_string($_POST['nombre_one']);
		$pa_segundonombre = $mysqli->real_escape_string($_POST['nombre_two']);

		$pa_primerapellido = $mysqli->real_escape_string($_POST['apellidopa']);
		$pa_segundoapellido = $mysqli->real_escape_string($_POST['apellidoma']);

		$gen_id 	= $mysqli->real_escape_string($_POST['genero']);
		$pa_fechanaci 	= $mysqli->real_escape_string($_POST['fechana']);

		$pa_direccion  = $mysqli->real_escape_string($_POST['direccion']);
		$pa_tlfcasa 	= $mysqli->real_escape_string($_POST['tlfijo']);

		$pa_tlfmovil	= $mysqli->real_escape_string($_POST['tlfmovil']);
		$pa_correo 		= $mysqli->real_escape_string($_POST['email']);
		$observacion 		= $mysqli->real_escape_string($_POST['observacion']);

			if(isNull($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $pa_fechanaci, $pa_correo, $observacion))
			{
				$errors[] = "Debe llenar todos los campos";
			}
			if (cedulaexistente($pa_dni)) {
		        $errors[] = "El paciente con la cedula ".$pa_dni." ya existe.";
		    }
			if(count($errors) == 0)
			{	
				$targetPath=$_FILES['file']['tmp_name'];
				if (empty($targetPath)) {
					$imagencontent = base64_encode(file_get_contents("../../images/perfil.png"));
					$registro = rgst_paci($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $imagencontent, $pa_fechanaci, $pa_direccion, $pa_tlfcasa, $pa_tlfmovil, $pa_correo, $observacion);
					if ($registro) {
						$succecful[] = "Registro Exitoso";
			 		}else{
						$errors[] = "Error al Registrarse";
			 		}	
				}else{
					$targetPath = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
			 		$registro = rgst_paci($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $targetPath, $pa_fechanaci, $pa_direccion, $pa_tlfcasa, $pa_tlfmovil, $pa_correo, $observacion);
					if ($registro) {
					$succecful[] = "Registro Exitoso";
					}else{
					$errors[] = "Error al Registrarse";
					}
			 	}
			} 
		}
		break;
	case 'editar':
		$id 	  	= $mysqli->real_escape_string($_POST['id']);
		$idus	 	= $mysqli->real_escape_string($_POST['idus']);
		$identification  = $mysqli->real_escape_string($_POST['identification']);
		$dni 	= $mysqli->real_escape_string($_POST['dni']);

		$nombre_one = $mysqli->real_escape_string($_POST['nombre_one']);
		$nombre_two = $mysqli->real_escape_string($_POST['nombre_two']);

		$apellidopa = $mysqli->real_escape_string($_POST['apellidopa']);
		$apellidoma = $mysqli->real_escape_string($_POST['apellidoma']);

		$genero 	= $mysqli->real_escape_string($_POST['genero']);
		$fechana 	= $mysqli->real_escape_string($_POST['fechana']);

		$direccion  = $mysqli->real_escape_string($_POST['direccion']);
		$tlfijo 	= $mysqli->real_escape_string($_POST['tlfijo']);

		$tlfmovil	= $mysqli->real_escape_string($_POST['tlfmovil']);
		$email 		= $mysqli->real_escape_string($_POST['email']);
			
			if(isNull($idus, $identification, $dni, $nombre_one, $nombre_two, $apellidopa, $apellidoma, $genero, $fechana, $direccion, $tlfijo, $tlfmovil, $email, $observacion)){
		        $informacion["respuesta"] = "VACIO";
				echo json_encode($informacion);
			}
			else{
				
				if ($_FILES['file']['tmp_name']) {
					$targetPath = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
					$registro = $mysqli->query("UPDATE paciente SET us_id='$idus', iden_id='$identification', pa_dni='$dni', pa_primernombre='$nombre_one', pa_segundonombre='$nombre_two', pa_primerapellido='$apellidopa', pa_segundoapellido='$apellidoma', pa_fechanaci='$fechana', pa_genero='$genero', pa_direccion='$direccion', pa_tlfcasa='$tlfijo', pa_tlfmovil='$tlfmovil', pa_correo='$email', pa_foto='$targetPath', pa_observacion='$observacion' WHERE pa_id = '$id'");
					verificar_resultado( $registro );
					cerrar( $mysqli );
				}else{
					$registro = $mysqli->query("UPDATE paciente SET us_id='$idus', iden_id='$identification', pa_dni='$dni', pa_primernombre='$nombre_one', pa_segundonombre='$nombre_two', pa_primerapellido='$apellidopa', pa_segundoapellido='$apellidoma', pa_fechanaci='$fechana', pa_genero='$genero', pa_direccion='$direccion', pa_tlfcasa='$tlfijo', pa_tlfmovil='$tlfmovil', pa_correo='$email',pa_observacion='$observacion WHERE pa_id = '$id'");
					verificar_resultado( $registro );
					cerrar( $mysqli );
				}
			}
		break;
	case 'eliminar':
			$id  = $mysqli->real_escape_string($_POST['id']);
			$resultado = eliminar($id);
			verificar_resultado( $resultado );
			cerrar( $mysqli );
		break;
	case 'cambiar':
			$id  = $mysqli->real_escape_string($_POST['id']);
			$resultado = cambiar($id);
			verificar_resultado( $resultado );
			cerrar( $mysqli );
		break;
}
 
function verificar_resultado( $resultado ){
	if ( !$resultado ) $informacion["respuesta"] = "ERROR";
	else $informacion["respuesta"] = "BIEN";
	echo json_encode( $informacion );
}
function cerrar( $conex ){
	mysqli_close( $conex );
}

///////////////////////////////////////////////////////////////////
if(count($errors) > 0)
	{
		echo "<div id='error' class='alert alert-danger' role='alert'>
		<ul>";
		foreach($errors as $error)
		{
			echo "<li style='background:#f8d7da'><strong>* ".$error."</strong></li>";
		}
		echo "</ul>";
		echo "</div>";
	}
if(count($succecful) > 0)
	{
		echo "<div id='exitoso' style='background-color:#49BF; padding:10px; border-radius:5px; text-align:center' role=''>
		<ul  style='background-color:#49BF;'>";
		foreach($succecful as $succecful)
		{
			echo "<li style=' color:#fff;font-size:15px;'><strong>".$succecful."</strong></li>";
		}
		echo "</ul>";
		echo "</div>";
	}
?>