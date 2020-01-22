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
		<div style="height: 150px"><br>
			<center ><h3>Registro de Usuario</h3></center>
			<div style="padding: 10px;">
				<div>
					<div><a href="registrar.php" class="btn btn-info">Agregar Usuario<span style="padding-left: 10px;font-size:15px;"><i class="fas fa-plus-square"></i></span></a></div>
				</div>
			</div>
		</div>
    <!--===========================================-->
  		<div class="table-responsive">
  		<section id="usuario_tabla"></section>
  		</div>

	</div>
</div>

<!--===========================================-->

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/all.js"></script>
<script src="../js/cmpt.js"></script>
<script src="extra/script.js"></script>
</body>
</html>