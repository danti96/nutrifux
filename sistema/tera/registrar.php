<?php
    require '../../func/conexion.php';
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    
    if(!isset($_SESSION["us_id"])){ //En caso de no existir la sesión redireccionamos
        header("Location: ../index.php");
    }
    $id = $_SESSION['us_id'];
    $sql = "SELECT us_id, us_usuario FROM usuario WHERE us_id = '$id'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $resul_ide = $mysqli->query("SELECT iden_id, iden_nombre FROM identificacion");
    $resul_car = $mysqli->query("SELECT car_id, car_nombre FROM cargo");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/icon.png" />
	<title>FisiosaludXP</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container-fluid  contenido">
	<div class="content">
		<?php require '../menu.php'; ?>
	</div>
    <!--===========================================-->
	<div class="container-fluid" style="overflow: auto;" id="container_cont">
		<div class="container" >
			<div style="padding: 50px 0;">
				<center><h3>Registro Terapista</h3></center>
 				<div id="resultados"></div>

				<form  id="formulario" enctype="multipart/form-data" method="POST" autocomplete="off">
					<input type="hidden" id="opcion" name="opcion" value="save">
					<input type="hidden" id="idus" name="idus" value="<?php echo "".utf8_decode($row['us_id']);?>">

					<div class="form-group">
						<div class="row">
							<label class="col-sm-2">Tipo de documentacion <strong>*</strong></label>
						<div class="col-sm-2 ">
							<select class="form-control" name="identification" onChange="mostrar(this.value);">
									<option value="Nah"></option>
								<?php while ($row_ide = $resul_ide->fetch_assoc()) { ?>
									<option value="<?php echo $row_ide['iden_id'];?>"><?php echo $row_ide['iden_nombre']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-8" id="txt_dni" style="display: none">
							<input type="text" class=" form-control" placeholder="Identificacion" id="dni" name="dni"  onkeypress="return SoloNumeros(event)" required>
						</div>
						</div>
					</div>		
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Apellido Paterno <strong>*</strong></label>
					 		<div class="col-sm-10">
								<input type="text" name="apellidopa" id="apellidopa" class="form-control" placeholder="Apellido Paterno" onkeypress="return soloLetras(event)" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Apellido Materno <strong>*</strong></label>
								<div class="col-sm-10">
								<input type="text" name="apellidoma" id="apellidoma" class="form-control" placeholder="Apellido Materno" onkeypress="return soloLetras(event)" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Primer Nombre <strong>*</strong></label>
					 		<div class="col-sm-10">
								<input type="text" name="nombre_one" id="nombre_one" class="form-control" placeholder="Primer Nombre" onkeypress="return soloLetras(event)" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Segundo Nombre <strong>*</strong></label>
					 		<div class="col-sm-10">
								<input type="text" name="nombre_two" id="nombre_two" class="form-control" placeholder="Segundo Nombre" onkeypress="return soloLetras(event)" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Fecha Nacimiento <strong>*</strong></label>
								<div class="col-sm-10">
								<input type="date" name="fechana" id="fechana" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Genero <strong>*</strong></label>
					 		<div class="col-sm-10">
								<select class="form-control" id="genero" name="genero" required>
									<option></option>
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-2">Estado Civil <strong>*</strong></label>
							<div class="col-sm-10">
								<select  class="form-control" name="estadocivil" id="estadocivil" required>
									<option value=""></option>
									<option value="Soltero/a">Soltero/a</option>
									<option value="Casado/a">Casado/a</option>
									<option value="Union Libre o Union de Hecho">Union Libre o Union de Hecho</option>
									<option value="Divorsiado/a">Divorsiado/a</option>
									<option value="Viudo/a">Viudo/a</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-2">Cargo <strong>*</strong></label>
							<div class="col-sm-10">
								<select class="form-control" name="cargo" id="cargo" required>
									<option></option>
								<?php while ($row1 = $resul_car->fetch_assoc()) {?>
									<option value="<?php echo $row1['car_id'];?>"><?php echo $row1['car_nombre']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Direccion </label>
								<div class="col-sm-10">
								<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Telefono Convencional </label>
					 		<div class="col-sm-10">
								<input type="tel" name="tlfijo" id="tlfijo" class="form-control" placeholder="(04) 999 - 9999" onkeypress="return SoloNumeros(event)" maxlength="10">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Telefono Movil </label>
					 		<div class="col-sm-10">
								<input type="tel" name="tlfmovil" id="tlfmovil" class="form-control" placeholder="099 999 9999" onkeypress="return SoloNumeros(event)" maxlength="10">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">E-Mail <strong>*</strong></label>
								<div class="col-sm-10">
								<input type="email" name="email" id="email" class="form-control" placeholder="example@example.com" required>
							</div>
						</div>
					</div>		
					<div class="form-group">
						<div class="row">
								<label class="col-sm-2">Foto <br> <strong style="color: red">Max 5Mb</strong></label>
					 		<div class="col-sm-10">
							<input type="file" name="file" id="file"  accept="image/jpg"/>

							</div>
							<div class="col-sm" style="display: block;">
								<div id="image_preview"><img id="previewing" src="" /></div>
								<div id="message"></div>
							</div>
						</div>
					</div>
					<div class="form-group"><center>
						<input type="submit" id="enviar" name="enviar" value="Registrar Terapista" class="btn btn-info">
							<a href="terapista.php" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fas fa-angle-double-left"></i></span> Volver</a>
					</center></div>	
				</form>
 		
	 	 	</div>
		</div> 	
 	</div>
    <!--===========================================-->
</div>
<!--===========================================-->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/all.js"></script>
<script src="../js/cmpt.js"></script>
<script src="extra/script.js"></script>
</body>
</html>