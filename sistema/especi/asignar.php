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
	<title>FisiosaludXP</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../css/style.css">
<style>
	#content{
		position: absolute;
		min-height: 50%;
		width: 80%;
		top: 20%;
		left: 5%;
	}

	.selected{
		cursor: pointer;
	}
	.selected:hover{
		background-color: #0585C0;
		color: white;
	}
	.seleccionada{
		background-color: #0585C0;
		color: white;
	}
</style>
</head>
<body>
<div class="container-fluid  contenido">
	<div class="content">
		<div class=" cont_menu">
			<nav class="sticky-top" >
			<ul class="menu">
				<li style="background-color: #fff;border: 2px solid"><center>
					<img src="../images/perfil.png" class="img-fluid" style="width: 80px;height: auto;border: 2px solid green;margin: 2px;"><p>Bienvenido <strong><?php echo "".utf8_decode($row['us_usuario']);?></strong></p></center>					
				</li>
				<li><a href="../index.php">Inicio <span><i class="fas fa-home"></i></span></a></li>
				<li class="submenu"><a href="#">Cuenta <span><i class="fas fa-id-badge"></i></span><span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../fx_perf/cuenta.php">Configuracion Cuenta</a></li>
 				</ul>
				</li>
				<li class="submenu"><a href="#">Administracion <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../fx_cita/cita.php">Administrar Citas</a></li>
					<li><a href="../fx_paci/paciente.php">Registrar Paciente</a></li>
				</ul>
				</li>
				<li class="submenu"><a href="#">Registro <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../fx_carg/cargo.php">Registrar Cargo</a></li>
					<li class="active"><a href="../fx_especi/especialidad.php">Registrar Especialidad </a></li>
					<li><a href="../fx_tera/terapista.php">Registrar Empleado </a></li>
					<li><a href="../fx_admi/admin_tera.php">Registrar Jornada de trabajo</a></li>
				</ul>
				</li>
				<li class="submenu"><a href="#">Gestion <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../fx_usua/usuario.php">Usuarios </a></li>
					<li><a href="../fx_tpus/tp_usuario.php">Tipo de Usuario </a></li>
				</ul>
				</li>
				<li><a href="">Inventario </a></li>
				<li><a href="">Reportes </a></li>
				<li><a href="../logout.php">Cerrar Sesion <span><i class="fas fa-sign-out-alt"></i></span></a></li>
			</ul>
			</nav>
		</div>
	</div>
    <!--===========================================-->
	<div class="container-fluid" style="overflow: auto;"  id="container_cont">
		<div class="container">
			<div style="padding: 50px 0;">
				<center><h3>Asignar Especialidad</h3></center>
				<form  id="formulario2" enctype="multipart/form-data" method="POST" autocomplete="off">
					<input type="hidden" id="opcion" name="opcion" value="asignar">
					<div class="form-group">
					<div class="row">
						<label class="col-sm-2">Buscar Empleado</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="DNI, Primer Apellido, Segundo Apellido" id="textdni" name="textdni">
						</div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
						<label class="col-sm-2">Nombre del Empleado  </label>
						<div class="col-sm-10"  id="result_search">
						
						</div>
					</div>
					</div>
					<hr>
					<div class="form-group">
					<div class="row">
						<label class="col-sm-2">Buscar Especialidad</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Especialidad" id="textespeci" name="textespeci">
						</div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
						<label class="col-sm-2">Especialidad </label>
						<div class="col-sm-5"  id="result_search_e">
						
						</div>
						<div class="col-sm">
							<button id="bt_add" type="button" class="btn btn-secondary">Agregar</button>
							<button id="bt_del" type="button" class="btn btn-secondary">Eliminar</button>
						</div>
					</div><br>
					<div class="row">
						<div class="offset-2 col-sm-5 table-responsive">
						<table id="tabla" class="display table table-hover table-bordered">
						    <thead class="thead-dark">
						 <tr>
							<th>id</th>
							<th>Especialidad</th>
							<th>Em</th>
						 </tr>
						</thead><tbody></tbody>
						</table>
						</div>							
					</div>
					</div>
					<br><br><div id="resultados"></div><br><br>
					<div class="form-group">
						<center>
						<input type="submit" id="enviar" name="enviar" value="Guardar Registro" class="btn btn-info">
				 		<a href="especialidad.php" class="btn btn-success" role="button" aria-pressed="true"><span style="padding-right: 5px;"><i class="fas fa-angle-double-left"></i></span> Volver</a>
						</center>
					</div>
				</form>
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