<?php
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    require '../func/conexion.php';
    include '../func/funciones.php';
    
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
<link rel="icon" type="image/png" href="images/icon.png" />
	<title>NUTRIFUX</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid  contenido">
	<div class="content"><div class="col-sm-4 cont_menu">
	<nav class="sticky-top" >
	<ul class="menu">
		<li style="background-color: #fff;border: 2px solid"><center>
			<p>Bienvenido <strong><?php echo "".utf8_decode($row['us_usuario']);?></strong></p></center>					
		</li>
		<li class="active"><a href="index.php">Inicio <span><i class="fas fa-home"></i></span></a></li>
		<li class="submenu"><a href="#">Cuenta <span><i class="fas fa-angle-down"></i></span></a>
		<ul class="children">
			<li><a href="perf/cuenta.php">Configuracion Cuenta</a></li>
			</ul>
		</li>
		<li class="submenu"><a href="#">Administracion <span><i class="fas fa-angle-down"></i></span></a>
		<ul class="children">
			<li><a href="cita/cita.php">Administrar Citas</a></li>
			<li><a href="paci/paciente.php">Paciente </a></li>
		</ul>
		</li>
		<li class="submenu"><a href="#">Administrar Empleado <span><i class="fas fa-angle-down"></i></span></a>
		<ul class="children">
			<li><a href="carg/cargo.php">Registrar Cargo</a></li>
			<li><a href="especi/especialidad.php">Registrar Especialidad </a></li>
			<li><a href="tera/terapista.php">Registrar Empleado </a></li>
			<li><a href="admi/admin_tera.php">Registrar Jornada de trabajo</a></li>
		</ul>
		</li>
		<li class="submenu"><a href="#">Gestion <span><i class="fas fa-angle-down"></i></span></a>
		<ul class="children">
			<li><a href="usua/usuario.php">Usuarios </a></li>
			<li><a href="tpus/tp_usuario.php">Tipo de Usuario </a></li>
		</ul>
		</li>
		<li><a href="">Reportes </a></li>
		<li><a href="logout.php">Cerrar Sesion <span><i class="fas fa-sign-out-alt"></i></span></a></li>
	</ul>
	</nav>
</div>
	</div>
	<div class="container-fluid" id="container_cont">
		<div class="container">
			<center  style=""><h1>BIENVENIDO AL SISTEMA DE INTEGRAL NUTRIFUX </h1></center>
			<div class="form-group" style="padding: 20px 0 5px 0;">
			<div class="row">
			  
			  <div class="col-sm" style="background-color: white; border: 1px solid;border-radius: 5px; margin-right: 10px;">
			  	<div class="row" style="background-color:#3F3F3F;padding: 5px;color: #fff">
			  	<label>El funcionamiento del sistema, comienza con el registro de:</label>
			  	</div>			  	
				<ul class="list-group list-group-flush" id="list_ini">
				  <li class="list-group-item"><strong>-</strong> Especialidad</li>
				  <li class="list-group-item"><strong>-</strong> Cargo</li>
				</ul>
			  </div>

			  <div class="col-sm" style="background-color: white; border: 1px solid;border-radius: 5px; margin-right: 10px;">
			  	<div class="row" style="background-color:#3F3F3F;padding: 5px;color: #fff">
			  	<label>Para Crear nuevos usuario para el inicio de sesion se comienza con el registro de:</label>
			  	</div>
				<ul class="list-group list-group-flush" id="list_ini">
				  <li class="list-group-item"><strong>-</strong> Tipo de Usuario</li>
				  <li class="list-group-item"><strong>-</strong> Usuario</li>
				</ul>
			  </div>

			</div>
			</div>
			<div class="form-group" style="padding: 2px 0;">
			<div class="row">
			  
			  <div class="col-sm" style="background-color: white; border: 1px solid;border-radius: 5px; margin-right: 10px;">
			  	<div class="row" style="background-color:#3F3F3F;padding: 5px;color: #fff">
			  	<label>El registro de Empleados, comienza con el registro de:</label>
			  	</div>			  	
				<ul class="list-group list-group-flush" id="list_ini">
				  <li class="list-group-item"><strong>-</strong> Empleado</li>
				  <li class="list-group-item"><strong>-</strong> Administrar Empleado</li>
				</ul>
			  </div>

			</div>
			</div>
		</div>
	</div>
</div>

<!--===========================================-->
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/all.js"></script>
<script src="js/cmpt.js"></script>
</body>
</html>