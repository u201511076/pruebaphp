<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		
		if(empty($_POST['idzona']))
		{

			header("location: listar_zonasriesgo.php");
			mysqli_close($conection);
		}
		$idzona = $_POST['idzona'];

		$query_delete = mysqli_query($conection,"DELETE FROM zonas WHERE idzona =$idzona ");
		mysqli_close($conection);
		if($query_delete){
			header("location: listar_zonasriesgo.php");
		}else{
			echo "Error al eliminar";
		}

	}



	if(empty($_REQUEST['id']))
	{
		header("location: listar_zonasriesgo.php");
		mysqli_close($conection);
	}else{

		$idzona = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT z.idzona,z.nombre,z.direccion, z.tipo from zonas z
												WHERE z.idzona = $idzona");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$direccion = $data['direccion'];
				$tipo    = $data['tipo'];
			}
		}else{
			header("location: listar_zonasriesgo.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Direccion: <span><?php echo $direccion; ?></span></p>
			<p>Tipo: <span><?php echo $tipo; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idzona" value="<?php echo $idzona; ?>">
				<a href="listar_zonasriesgo.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>