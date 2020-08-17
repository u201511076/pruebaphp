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

			$idzona = $_POST['idzona'];
			$nombre = $_POST['nombre'];
			$direccion = $_POST['direccion'];
			$lat  = $_POST['lat'];
			$lng   = $_POST['lng'];
			$tipo  = $_POST['tipo'];
			$usermod= $_SESSION['user'];
		    $rootmod = $_SERVER ['REMOTE_ADDR'];
		

			$query = mysqli_query($conection,"SELECT * FROM zonas
													   WHERE (direccion = '$direccion' AND idzona != $idzona)");

			$result = mysqli_fetch_array($query);
		

			if($result > 0){
				$alert='<p class="msg_error">La direccion de la zona ya fue regitrada.</p>';
			}else{

				
					$sql_update = mysqli_query($conection,"UPDATE zonas
															SET nombre ='$nombre', direccion='$direccion',
															lat='$lat',lng= '$lng' ,tipo='$tipo',user_mod='$usermod',cpc_mod='$rootmod'
															WHERE idzona= $idzona ");
				

				if($sql_update){
					$alert='<p class="msg_save">Zona de riesgo actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la zona de riesgo.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: listar_zonasriesgo.php');
		mysqli_close($conection);
	}
	$idzona = $_REQUEST['id'];

	$query_zonas= mysqli_query($conection,"SELECT z.idzona,z.nombre,z.direccion,z.lat,z.lng,t.idtipo, t.tipo FROM zonas z 
		INNER JOIN tipo t on z.tipo=t.idtipo WHERE idzona= $idzona");
	
	$result_zonas = mysqli_num_rows($query_zonas);

	if($result_zonas >0){
		
		$data=mysqli_fetch_assoc($query_zonas);
	}

	else{
		
		header('Location: listar_zonasriesgo.php');
		
		}
	

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Zona</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Zona de Riesgo</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<input type="hidden" name="idzona" value="<?php echo $data["idzona"]; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre de la Zona" value="<?php echo $data["nombre"]; ?>">

				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion de la Zona" value="<?php echo $data["direccion"]; ?>">
			
				<label for="lat">Latitud</label>
				<input type="text" name="lat" id="lat" placeholder="latitud" value="<?php echo $data["lat"]; ?>">
				
				<label for="lng">Longuitud</label>
				<input type="text" name="lng" id="lng" placeholder="longuitud" value="<?php echo $data["lng"]; ?>">
			
				
               <label for="tipo">Tipo</label>
              
                <?php 

					$query_tip = mysqli_query($conection,"SELECT * FROM tipo");
					
					$result_tip= mysqli_num_rows($query_tip);

				 ?>


				<select name="tipo" id="tipo" class="notItemOne">
                   <option value=" <?php echo $data["idtipo"]; ?>" selected> <?php echo $data["tipo"] ?>   </option>

                   <?php 

						if($result_tip > 0)
						{
							while ($tipo = mysqli_fetch_array($query_tip)) {
					?>
							<option value="<?php echo $tipo["idtipo"]; ?>"><?php echo $tipo["tipo"] ?></option>
					<?php 
							
							}
							
						}
					 ?>

				</select>
				
				<input type="submit" value="Actualizar Zona" class="btn_save">
                

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>