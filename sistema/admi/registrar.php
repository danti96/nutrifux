<?php
    require '../../func/conexion.php';
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    
    if(!isset($_SESSION["us_id"])){ //En caso de no existir la sesión redireccionos
        header("Location: ../index.php");
    }
    $id = $_SESSION['us_id'];
    $sql = "SELECT us_id, us_usuario FROM usuario WHERE us_id = '$id'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/icon.png" />
	<title>Nutrifux</title>
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
	<div class="container-fluid" id="container_cont" style="overflow: auto;"> 
		<div class="container">
			<div style="padding: 50px 0;">
				<center><h3>Registro jornada del empleado</h3></center>
				<br>
				 <div class="col-sm-12 row">
					  <div class="col-sm">	
						<form  id="formulario" enctype="multipart/form-data" method="POST" autocomplete="off">
							<input type="hidden" id="opcion" name="opcion" value="save">

							<input type="hidden" id="idus" name="idus" value="<?php echo "".utf8_decode($row['us_id']);?>">

							<div class="form-group">
								<div class="row">
									<label class="col-sm-2">Buscar Empleado</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" placeholder="DNI, Primer Apellido, Segundo Apellido" id="textdni" name="textdni">
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="row">
									<label class="col-sm-2">Nombre del Empleado  </label>
									<div class="col-sm-10"  id="result_search">
									
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								<label class="col-sm-2">Hora de Inicio</label>
									<div class="col-sm-10">
										<div class="col-sm-9  row">
											<select class="form-control col-sm-4" name="hora_inicio" id="hora_inicio">
												<option value=""></option>
												<option value="08">08 </option>
												<option value="09">09 </option>
												<option value="10">10 </option>
												<option value="11">11 </option>
												<option value="12">12 </option>
												<option value="13">13 </option>
												<option value="14">14 </option>
												<option value="15">15 </option>
												<option value="16">16 </option>
												<option value="17">17 </option>
												<option value="18">18 </option>
												<option value="19">19 </option>
												<option value="20">20 </option>
											</select>
											<label for="" style="padding: 5px"><strong>Hrs</strong></label>
											<select class="form-control col-sm-4" name="min_inicio" id="min_inicio">
												<option value=""></option>
												<option value="00">00 </option>
												<option value="30">30 </option>
											</select>
											<label for="" style="padding: 5px"><strong>Mns</strong></label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-sm-2">Hora de Almuerzo</label>
									<div class="col-sm-10">
										<div class="col-sm-9  row">
											<select class="form-control col-sm-4" name="hora_almuerzo" id="hora_almuerzo">
												<option value=""></option>
												<option value="08">08 </option>
												<option value="09">09 </option>
												<option value="10">10 </option>
												<option value="11">11 </option>
												<option value="12">12 </option>
												<option value="13">13 </option>
												<option value="14">14 </option>
												<option value="15">15 </option>
												<option value="16">16 </option>
												<option value="17">17 </option>
												<option value="18">18 </option>
												<option value="19">19 </option>
												<option value="20">20 </option>
											</select>
											<label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
										<select class="form-control col-sm-4" name="min_almuerzo" id="min_almuerzo">
											<option value=""></option>
											<option value="00">00 </option>
											<option value="30">30 </option>
										</select>
											<label for="s" style="padding: 5px"><strong>Mns</strong></label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-sm-2">Hora de Retorno</label>
									<div class="col-sm-10">
										<div class="col-sm-9  row">
											<select class="form-control col-sm-4" name="hora_retorno" id="hora_retorno">
												<option value=""></option>
												<option value="08">08 </option>
												<option value="09">09 </option>
												<option value="10">10 </option>
												<option value="11">11 </option>
												<option value="12">12 </option>
												<option value="13">13 </option>
												<option value="14">14 </option>
												<option value="15">15 </option>
												<option value="16">16 </option>
												<option value="17">17 </option>
												<option value="18">18 </option>
												<option value="19">19 </option>
												<option value="20">20 </option>
											</select>
											<label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
										<select class="form-control col-sm-4" name="min_retorno" id="min_retorno">
											<option value=""></option>
											<option value="00">00 </option>
											<option value="30">30 </option>
										</select>
											<label for="s" style="padding: 5px"><strong>Mns</strong></label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-sm-2">Hora de Salida</label>
									<div class="col-sm-10">
										<div class="col-sm-9  row">
											<select class="form-control col-sm-4" name="hora_salida" id="hora_salida">
												<option value=""></option>
												<option value="08">08 </option>
												<option value="09">09 </option>
												<option value="10">10 </option>
												<option value="11">11 </option>
												<option value="12">12 </option>
												<option value="13">13 </option>
												<option value="14">14 </option>
												<option value="15">15 </option>
												<option value="16">16 </option>
												<option value="17">17 </option>
												<option value="18">18 </option>
												<option value="19">19 </option>
												<option value="20">20 </option>
											</select>
											<label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
										<select class="form-control col-sm-4" name="min_salida" id="min_salida">
											<option value=""></option>
											<option value="00">00 </option>
											<option value="30">30 </option>
										</select>
											<label for="s" style="padding: 5px"><strong>Mns</strong></label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<label for="dia" class="col-sm-2 control-label">Asistencia</label>
									<div class="col-sm-10">
										<label class="checkbox-inline">
										<input type="checkbox" id="dia[]" name="dia[]" value="Lunes"> Lunes
										</label>

										<label class="checkbox-inline">
										<input type="checkbox" id="dia[]" name="dia[]" value="Martes"> Martes
										</label>

										<label class="checkbox-inline">
										<input type="checkbox" id="dia[]" name="dia[]" value="Miercoles"> Miercoles
										</label>

										<label class="checkbox-inline">
										<input type="checkbox" id="dia[]" name="dia[]" value="Jueves"> Jueves
										</label>
										<label class="checkbox-inline">
										<input type="checkbox" id="dia[]" name="dia[]" value="Viernes"> Viernes
										</label>
									</div>
								</div>
							</div>
				<div id="resultados"></div>

				<div class="form-group">
					<center>
					<input type="submit" id="enviar" name="enviar" value="Registrar Admistracion" class="btn btn-info">
			 		<a href="admin_tera.php" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fas fa-angle-double-left"></i></span> Volver</a>
					</center>
				</div>
					</form>
					  </div>

				 </div>
					<br>
	 	 	</div>
		</div> 	
 	</div>
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