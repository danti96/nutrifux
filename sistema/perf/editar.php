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
	    
    if(!isset( $_GET['id'])){ //En caso de no existir la sesión redireccionamos
        header("Location: ../index.php");
    }
	 $vid = $_GET['id'];
	 $res = $mysqli->query("SELECT *FROM usuario WHERE us_id ='$vid'");
	$rows =	mysqli_fetch_array($res,MYSQL_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/icon.png" />
	<title>FisiosaludXP</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container-fluid  contenido">
	<div class="content">
		<?php require '../menu.php'; ?>
	</div>
	<div class="container-fluid"> 
		<div class="container">
			<div style="padding: 50px 0;">
				<center><h3>Perfil de Usuario</h3></center>
			</div>
			<center>
				<div class="col-sm-8">
				<form autocomplete="off" onsubmit="return ERegistrar();" id="formulario">
				<input type="hidden" name="id" id="id" value="<?php echo $rows['us_id']; ?>">
					<div class="form-group">
						<div class="row">
							<label class="col-sm-3"><strong>Nombre de Ususario:</strong></label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="text" name="user" id="user" class="form-control" value="<?php echo $rows['us_usuario']; ?>">
								    <div class="input-group-prepend">
								        <span class="input-group-text"><i class="fa fa-user"></i></span>
								    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-3"><strong>Contraseña Actual:</strong></label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="password" name="pass" id="pass" class="form-control">
								    <div class="input-group-prepend">
								        <span class="input-group-text"><i class="fa fa-eye" id="show"></i></span>
								    </div>
								</div>
							</div>
						</div>
					</div>
					<label id="poo"></label><br>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-3"><strong>Nueva Contraseña :</strong></label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="password" name="n_pass" id="n_pass" class="form-control">
								    <div class="input-group-prepend">
								        <span class="input-group-text"><i class="fa fa-eye" id="shown"></i></span>
								    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-sm-3"><strong>Nueva Contraseña :</strong></label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="password" name="r_pass" id="r_pass" class="form-control">
								    <div class="input-group-prepend">
								        <span class="input-group-text"><i class="fa fa-eye" id="showr"></i></span>
								    </div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<center>
						<input type="submit" id="enviar" name="enviar" value="Modificar" class="btn btn-info">
				 		<a href="cuenta.php" class="btn btn-danger" role="button" aria-pressed="true">Cancelar</a>
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
<script src="../js/cmpt.js"></script>
<script src="extra/script.js"></script>
</body>
</html>