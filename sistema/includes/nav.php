<nav>
			<ul>
				<li><a href="index.php">Mapa</a></li>
			<?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="listar_usuarios.php">Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="principal">
					<a href="#">Zonas de Riesgo</a>
					<ul>
						<li><a href="registrar_zona.php">Nueva Zona</a></li>
						<li><a href="listar_zonasriesgo.php">Lista de Zonas</a></li>
					
					</ul>
				</li>

				<li class="principal">
					<a href="#">Incendios</a>
					<ul>
						<li><a href="registro_incendios.php">Nuevo Incendio</a></li>
						<li><a href="listar_incendios.php">Lista de Incendios</a></li>
					</ul>
				</li>


				<li class="principal">
					<a href="#">Zonas Contribuidas</a>
					<ul>
						
						<li><a href="listar_zonascontribuidas.php">Lista de Zonas Contribuidas</a></li>	
					</ul>
				</li>

				<li class="principal">
					<a href="#">Configuración</a>
					<ul>
						
						<li><a href="configuracion.php">Mi Perfil</a></li>	
					</ul>
				</li>
				
				
				
			
			</ul>
		</nav>