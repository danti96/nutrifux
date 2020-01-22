		<div class="col-sm-4 cont_menu">
			<nav class="sticky-top" >
			<ul class="menu">
				<li style="background-color: #fff;border: 2px solid"><center>
				<p>Bienvenido <strong><?php echo "".utf8_decode($row['us_usuario']);?></strong></p></center>					
				</li>
				<li class="active"><a href="../index.php">Inicio <span><i class="fas fa-home"></i></span></a></li>
				<li class="submenu"><a href="#">Cuenta <span><i class="fas fa-id-badge"></i></span><span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../perf/cuenta.php">Configuracion Cuenta</a></li>
 				</ul>
				</li>				<li class="submenu"><a href="#">Administracion <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../cita/cita.php">Administrar Citas</a></li>
					<li><a href="../paci/paciente.php">Paciente </a></li>
				</ul>
				</li>
				<li class="submenu"><a href="#">Administrar Empleado <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../carg/cargo.php">Registrar Cargo</a></li>
					<li><a href="../especi/especialidad.php">Registrar Especialidad </a></li>
					<li><a href="../tera/terapista.php">Registrar Empleado </a></li>
					<li><a href="../admi/admin_tera.php">Registrar Jornada de trabajo</a></li>
				</ul>
				</li>
				<li class="submenu"><a href="#">Gestion <span><i class="fas fa-angle-down"></i></span></a>
				<ul class="children">
					<li><a href="../usua/usuario.php">Usuarios </a></li>
					<li><a href="../tpus/tp_usuario.php">Tipo de Usuario </a></li>
				</ul>
				</li>
				<li><a href="">Reportes </a></li>
				<li><a href="../logout.php">Cerrar Sesion <span><i class="fas fa-sign-out-alt"></i></span></a></li>
			</ul>
			</nav>
		</div>