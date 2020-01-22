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
$results = $mysqli->query("SELECT tp_id, tp_nombre FROM tipo_usuario");
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
	<div class="container-fluid" style="overflow: auto;"  id="container_cont">
		<div class="container">
			<div style="padding: 50px 0;">
				<center><h3>Registro De Usuario</h3></center>
				<form id="formulario" enctype="multipart/form-data" method="POST" autocomplete="OFF">
					<input type="hidden" id="opcion" name="opcion" value="save">
					<div class="form-group">
						<label>Nombre de Usuario *</label>
						<input type="text" class="form-control" name="user" id="user" placeholder="Nombre de Usuario" required>
					</div>
					<div class="form-group">
						<label>Contraseña *</label>
               			<input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" required>
					</div>
 					<div class="form-group">
						<label>Tipo de Usuario*</label>
					<select class="form-control" name="tp_usuario" id="tp_usuario" required>
						<option></option>
						<?php while ($rows = $results->fetch_assoc()) {?>
						<option value="<?php echo $rows['tp_id'];?>"><?php echo $rows['tp_nombre']; ?></option>
						<?php } ?>
					</select>
					</div>
 					<div class="form-group">
						<center>
						<input type="submit" id="enviar" name="enviar" value="Registrar Usuario" class="btn btn-info">
						<a href="usuario.php" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fa fa-angle-double-left"></i></span> Volver</a>
						</center>
					</div>	
				</form>
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