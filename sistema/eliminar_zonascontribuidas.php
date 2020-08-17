<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		
		if(empty($_POST['idzona']))
		{

			header("location: listar_zonascontribuidas.php");
			mysqli_close($conection);
		}
		$idzona = $_POST['idzona'];

		$query_delete = mysqli_query($conection,"DELETE FROM zonacontribuida WHERE idzona =$idzona ");
		mysqli_close($conection);
		if($query_delete){
			header("location: listar_zonascontribuidas.php");
		}else{
			echo "Error al eliminar";
		}

	}



	if(empty($_REQUEST['id']))
	{
		header("location: listar_zonascontribuidas.php");
		mysqli_close($conection);
	}else{

		$idzona = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT z.idzona,z.direccion from zonacontribuida z
												WHERE z.idzona = $idzona");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				
				$direccion = $data['direccion'];
				
			}
		}else{
			header("location: listar_zonascontribuidas.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Zona</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			
			<p>Direccion: <span><?php echo $direccion; ?></span></p>
			

			<form method="post" action="">
				<input type="hidden" name="idzona" value="<?php echo $idzona; ?>">
				<a href="listar_zonascontribuidas.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>