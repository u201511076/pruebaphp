<?php 
	
	session_start();
	include "../conexion.php";


	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['direccion']) || empty($_POST['nombre'])|| empty($_POST['lat']) || empty($_POST['lng']) || empty($_POST['tipo'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $nombre = $_POST['nombre'];
			$direccion = $_POST['direccion'];
			$lat  = $_POST['lat'];
			$lng   = $_POST['lng'];
			$tipo  = $_POST['tipo'];
			
			$usuario= $_SESSION['user'];
            $root = $_SERVER ['REMOTE_ADDR'];
       
			$query = mysqli_query($conection,"SELECT * FROM zonas WHERE direccion = '$direccion'");
			
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">La zona de riesgo ya ha sido creda.</p>';
			}else
			{

				$query_insert = mysqli_query($conection,"INSERT INTO zonas(nombre,direccion,lat,lng,tipo,user_reg,cpc_reg)
																	VALUES('$nombre','$direccion','$lat','$lng',$tipo ,'$usuario','$root')");
				if($query_insert){
					$alert='<p class="msg_save">Zona de Riesgo creado correctamente.</p>';
				}else
				{
					$alert='<p class="msg_error">Error al crear la zona.</p>';
				}

			}


		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Nueva Zona de Riesgo</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Nueva Zona de Riesgo</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre de la Zona">

				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion de la Zona">
			
				<label for="lat">Latitud</label>
				<input type="text" name="lat" id="lat" placeholder="latitud">
				
				<label for="lng">Longuitud</label>
				<input type="text" name="lng" id="lng" placeholder="longuitud">
			

			   <label for="tipo">Tipo</label>
				
                
                <?php 
					$query_tipo = mysqli_query($conection,"SELECT * FROM tipo");
					mysqli_close($conection);
					$result_tipo = mysqli_num_rows($query_tipo);


				 ?>

			    <select name="tipo" id="tipo">
				<?php 
						if($result_tipo > 0)
						{
							while ($tipo = mysqli_fetch_array($query_tipo)) {
					?>
							<option value="<?php echo $tipo["idtipo"]; ?>"><?php echo $tipo["tipo"] ?></option>
					<?php 
							
							}
							
						}
					 ?>
                 </select>

              

				<form >
				
				<a href="listar_zonasriesgo.php" class="btn_cancel">&nbsp&nbsp Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>

			</form>

		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>