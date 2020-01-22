<?php 
	function isNull($us_id, $iden_id, $pa_dni, $nombre_one, $nombre_two, $apellido_one, $apellido_two, $fechanaci, $gen_id, $estadocivil, $cargo, $correo){

		if (strlen(trim($us_id)) < 1 || strlen(trim($iden_id)) < 1  || strlen(trim($pa_dni)) < 1|| 
			strlen(trim($nombre_one)) < 1 || strlen(trim($nombre_two)) < 1 || strlen(trim($apellido_one)) < 1 ||
			strlen(trim($apellido_two)) < 1 || strlen(trim($fechanaci)) < 1 || strlen(trim($gen_id)) < 1 || 
			strlen(trim($estadocivil)) < 1 || strlen(trim($cargo)) < 1 || strlen(trim($correo)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	function cedulaexistente($pa_dni){
		global $mysqli;
		$query=$mysqli->query("SELECT em_dni FROM empleado WHERE em_dni='$pa_dni'");
		$result=$query->num_rows;
		if ($result>0) {
			return 1;
		}else{
			return 0;
		}
	}

	function rgst_emple($us_id, $iden_id, $pa_dni, $nombre_one, $nombre_two, $apellido_one, $apellido_two, $fechanaci, $gen_id, $estadocivil, $cargo, $direccion, $tlfcasa, $tlfmovil, $correo, $targetPath){
		global $mysqli;

 		$sql=("INSERT INTO  empleado ( us_id, iden_id, em_dni, em_primernombre, em_segundonombre, em_primerapellido, em_segundoapellido, em_fechanaci, em_genero, em_estadocivil, em_foto, car_id, em_direccion, em_tlfcasa, em_tlfmovil, em_correo) VALUES ('$us_id', '$iden_id', '$pa_dni', '$nombre_one', '$nombre_two', '$apellido_one', '$apellido_two', '$fechanaci', '$gen_id', '$estadocivil', '$targetPath', '$cargo', '$direccion', '$tlfcasa', '$tlfmovil', '$correo')");
 		$stmt = $mysqli->query($sql);

		if ($stmt){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar($idus, $identification, $id, $dni, $cargo, $tlfijo, $tlfmovil, $email, $fechana, $genero, $apellidopa, $apellidoma, $nombre_one, $nombre_two, $direccion, $estadocivil, $targetPath){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE empleado SET us_id='$idus',iden_id='$identification',em_dni='$dni',em_primernombre='$nombre_one',em_segundonombre='$nombre_two',em_primerapellido='$apellidopa',em_segundoapellido='$apellidoma',em_fechanaci='$fechana',em_genero='$genero',em_estadocivil='$estadocivil',em_foto='$targetPath',car_id='$cargo',em_direccion='$direccion',em_tlfcasa='$tlfijo',em_tlfmovil='$tlfmovil',em_correo='$email' WHERE em_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM empleado WHERE em_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE empleado SET em_estado = CASE WHEN em_estado = 0 then 1 WHEN em_estado = 1 then 0 END WHERE em_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	} 
//////////////////////////////////////////////////////////////////
function cedulacorrecta($cedula){
	//aqui explico la logica de la validacion de una cedula de ecuador
	//El decimo Digito es un resultante de un calculo
	//Se trabaja con los 9 digitos de la cedula
	//Cada digito de posicion impar se lo duplica, si este es mayor que 9 se resta 9 
	//Se suman todos los resultados de posicion impar
	//Ahora se suman todos los digitos de posicion par
	//se suman los dos resultados
	//se resta de la decena inmediata superior
	//este es el decimo digito
	//si la suma nos resulta 10, el decimo digito es cero   

	if(is_null($cedula) || empty($cedula)){//compruebo si que el numero enviado es vacio o null
	}else{//caso contrario sigo el proceso
	if(is_numeric($cedula)){ 
	$total_caracteres=strlen($cedula);// se suma el total de caracteres
	if($total_caracteres==10){//compruebo que tenga 10 digitos la cedula
	$nro_region=substr($cedula, 0,2);//extraigo los dos primeros caracteres de izq a der
	if($nro_region>=1 && $nro_region<=24){// compruebo a que region pertenece esta cedula//
	$ult_digito=substr($cedula, -1,1);//extraigo el ultimo digito de la cedula
	//extraigo los valores pares//
	$valor2=substr($cedula, 1, 1);
	$valor4=substr($cedula, 3, 1);
	$valor6=substr($cedula, 5, 1);
	$valor8=substr($cedula, 7, 1);
	$suma_pares=($valor2 + $valor4 + $valor6 + $valor8);
	//extraigo los valores impares//
	$valor1=substr($cedula, 0, 1);
	$valor1=($valor1 * 2);
	if($valor1>9){ $valor1=($valor1 - 9); }else{ }
	$valor3=substr($cedula, 2, 1);
	$valor3=($valor3 * 2);
	if($valor3>9){ $valor3=($valor3 - 9); }else{ }
	$valor5=substr($cedula, 4, 1);
	$valor5=($valor5 * 2);
	if($valor5>9){ $valor5=($valor5 - 9); }else{ }
	$valor7=substr($cedula, 6, 1);
	$valor7=($valor7 * 2);
	if($valor7>9){ $valor7=($valor7 - 9); }else{ }
	$valor9=substr($cedula, 8, 1);
	$valor9=($valor9 * 2);
	if($valor9>9){ $valor9=($valor9 - 9); }else{ }

	$suma_impares=($valor1 + $valor3 + $valor5 + $valor7 + $valor9);
	$suma=($suma_pares + $suma_impares);
	$dis=substr($suma, 0,1);//extraigo el primer numero de la suma
	$dis=(($dis + 1)* 10);//luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
	$digito=($dis - $suma);
	if($digito==10){ $digito='0'; }else{ }//si la suma nos resulta 10, el decimo digito es cero
	if ($digito==$ult_digito){//comparo los digitos final y ultimo
	return true;
	}else{
	return false;
	}
	}else{
	return false;
	}   
	}else{
	return false;
	}
	}else{
	return false;
	}
	}
}
?>
