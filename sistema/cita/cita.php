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

?>
<!DOCTYPE html>
<html>
<head>
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
	<div class="container-fluid"  style="overflow: auto;"  id="container_cont"> 
		<div class="container">
			<div style="padding: 50px 0;">
				<center><h3>Agendamiento de Cita</h3></center>
			<div class="col-sm" style="border: 2px solid;padding: 10px;">
				<form id="formulario" enctype="multipart/form-data" method="POST" autocomplete="OFF">
					<div class="form-group">
						<div class="row">
							<label class="col-sm-2">Tipo de reservacion</label>
							<div class="col-sm-10">
							<select class="form-control col-sm-5" onChange="tipo_reservacion(this.value);">
								<option value="NaH"></option>
								<option value="evaluacion">Nueva Cita</option>
							</select>
							</div>
						</div>
					</div>
					
					<div id="evaluacion" style="display: none;">
						<hr style="height: 10px;border-color: black;">
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<div class="row">
										<label class="col-sm-3">Tipo de Jornada</label>
										<div class="col-sm-7">
										<select name="tipojornada" id="tipojornada" class="form-control" onChange="tipo_jornada(this.value);">
											<option value="NaH"></option>
											<option value="Matutino">Matutino</option>
											<option value="Vespertino">Vespertino</option>
										</select>
										</div>
									</div>
								</div>
								<div  id="divfecha" style="display: none;">
								<div class="form-group">
									<div class="row">
										<label class="col-sm-3">Fecha de la Cita</label>
										<div class="col-sm-7">
											<input type="date" id="fecha" name="fecha" class="form-control">
										</div>
									</div>
								</div>
								</div>
								<div id="matutinohora" style="display: none;">
									<div class="form-group">
										<div class="row">
										<label class="col-sm-3">Hora Reserva de Cita</label>
											<div class="col-sm-9">
												<div class="col-sm-7 row">
													<select class="form-control col-sm" name="hora_inicio" id="hora_inicio">
														<option value=""></option>
														<option value="08">08 </option>
														<option value="09">09 </option>
														<option value="10">10 </option>
														<option value="11">11 </option>
														<option value="12">12 </option>
													</select>
													<label for="" style="padding: 5px"><strong>Hrs</strong></label>
													<select class="form-control col-sm" name="min_inicio" id="min_inicio">
														<option value=""></option>
														<option value="00">00 </option>
														<option value="30">30 </option>
													</select>
													<label for="" style="padding: 5px"><strong>Mns</strong></label>
												</div>
											</div>
										</div>
									</div>									
								</div>
								<div id="vespertinohora" style="display: none;">
									<div class="form-group">
										<div class="row">
										<label class="col-sm-3">Hora Reserva de Cita</label>
											<div class="col-sm-9">
												<div class="col-sm-7 row">
													<select class="form-control col-sm" name="hora_inicio" id="hora_inicio">
														<option value=""></option>
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
													<select class="form-control col-sm" name="min_inicio" id="min_inicio">
														<option value=""></option>
														<option value="00">00 </option>
														<option value="30">30 </option>
													</select>
													<label for="" style="padding: 5px"><strong>Mns</strong></label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="divterapista" style="display: none;">
									<div class="form-group">
										<div class="row">
											<label class="col-sm-3">Asignar Empleado</label>
											<div class=" col-sm-7">
												<input type="text" name="terapista" id="terapista" placeholder="Nombre del Empleado" class="form-control">
												<input type="hidden" name="id" id="id" placeholder="id" class="form-control">

											</div>

										</div>
									</div>
								</div>

							</div>
							<div class="col-sm" id="result_search" style="display: none;"></div>
						</div>
					</div>

					<div id="terapia" style="display: none;">
						<h2>Terapia</h2>
					</div>

   				</form>
 			</div>
				<div id="resultados"></div>
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