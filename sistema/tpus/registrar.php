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
				<center><h3>Registro de Tipo De Usuario</h3></center>
				<form id="formulario" enctype="multipart/form-data" method="POST" autocomplete="OFF">
					 <input type="hidden" id="opcion" name="opcion" value="save">
					<div class="form-group">
						<label>Tipo De Usuario</label>
						<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Tipo De Usuario" required>
					</div>
					<div class="form-group">
						<label>Detalle del Tipo De Usuario</label>
						<input type="text" class="form-control" name="detalle" id="detalle" placeholder="Tipo De Usuario" required>
					</div>
					
					<div class="form-group"><center>
						<input type="submit" id="enviar" name="enviar" value="Registrar Tipo de Usuario" class="btn btn-info">
				 		<a href="tp_usuario.php" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fas fa-angle-double-left"></i></span> Volver</a>
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