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
				<center><h3>Perfil de Usuario</h3></center>
			</div>
			<center>
				<div class="col-sm-8">
				<form autocomplete="off" onsubmit="return ERegistrar();" id="formulario">
					<input type="hidden" name="id" id="id" value="<?php echo $row['us_id']; ?>">
					<div class="form-group">
						<div class="row">
							<label class="col-sm-2"><strong>Nombre De Usuario :</strong></label>
							<div class="col-sm-10">
							<label class="form-control" style="text-align: left;"><?php echo $row['us_usuario']; ?></label>
							</div>
						</div>					
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-2"><strong>Constraseña De Usuario :</strong></label>
							<div class="col-sm-10">
							<label class="form-control"  style="text-align: left;"><strong>******************</strong></label>
							</div>
						</div>					
					</div>
					<div class="form-group">
						<center>
						<a href="editar.php?id=<?php echo $row['us_id']; ?>" id="enviar" name="enviar" class="btn btn-info">Editar Cuenta</a>
				 		<a href="../" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fas fa-angle-double-left"></i></span> Volver</a>
						</center>
					</div>	
 				</form>
				<div id="resultados"></div>
				</div>
			</center>
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
</body>
</html>