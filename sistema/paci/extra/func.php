<?php 
	function isNull($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $pa_fechanaci, $pa_correo){

		if(strlen(trim($us_id)) < 1 || strlen(trim($iden_id)) < 1  || strlen(trim($pa_dni)) < 1|| strlen(trim($pa_primernombre)) < 1 || strlen(trim($pa_segundonombre)) < 1 || strlen(trim($pa_primerapellido)) < 1 || strlen(trim($pa_segundoapellido)) < 1 || strlen(trim($gen_id)) < 1 || strlen(trim($pa_fechanaci)) < 1 || strlen(trim($pa_correo)) < 1 )
		{
			return true;
			} else {
			return false;
		}		
	}
	function cedulaexistente($pa_dni){
		global $mysqli;
		$query=$mysqli->query("SELECT pa_dni FROM paciente WHERE pa_dni='$pa_dni'");
		$result=$query->num_rows;
		if ($result>0) {
			return 1;
		}else{
			return 0;
		}
	}
	function rgst_paci($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $targetPath, $pa_fechanaci, $pa_direccion, $pa_tlfcasa, $pa_tlfmovil, $pa_correo){
		global $mysqli;

 		$sql=("INSERT INTO  paciente ( us_id,  iden_id,  pa_dni,  pa_primernombre,  pa_segundonombre,  pa_primerapellido,  pa_segundoapellido,  pa_genero,  pa_foto,  pa_fechanaci,  pa_direccion,  pa_tlfcasa,  pa_tlfmovil,  pa_correo ) VALUES ('$us_id', '$iden_id', '$pa_dni', '$pa_primernombre', '$pa_segundonombre', '$pa_primerapellido', '$pa_segundoapellido', '$gen_id', '$targetPath', '$pa_fechanaci', '$pa_direccion', '$pa_tlfcasa', '$pa_tlfmovil', '$pa_correo')");
 		$stmt = $mysqli->query($sql);

		if ($stmt){
			return 1;
			} else {
			return 0;	
		}		
	}

	function modificar($us_id, $iden_id, $pa_dni, $pa_primernombre, $pa_segundonombre, $pa_primerapellido, $pa_segundoapellido, $gen_id, $targetPath, $pa_fechanaci, $pa_direccion, $pa_tlfcasa, $pa_tlfmovil, $pa_correo){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE paciente SET us_id='$us_id',iden_id=[value-3],pa_dni=[value-4],pa_primernombre=[value-5],pa_segundonombre=[value-6],pa_primerapellido=[value-7],pa_segundoapellido=[value-8],pa_foto=[value-9],pa_fechanaci=[value-10],pa_genero=[value-11],pa_direccion=[value-12],pa_tlfcasa=[value-13],pa_tlfmovil=[value-14],pa_correo=[value-15] WHERE em_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	
	function eliminar ($id){
		global $mysqli;
		$resultado = $mysqli->query("DELETE FROM paciente WHERE pa_id = '$id'");
		if ($resultado){
			return 1;
			} else {
			return 0;	
		}
	}
	
	function cambiar ($id){
		global $mysqli;
		$resultado = $mysqli->query("UPDATE paciente SET pa_estado = CASE WHEN pa_estado = 0 then 1 WHEN pa_estado = 1 then 0 END WHERE pa_id = '$id'");
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
