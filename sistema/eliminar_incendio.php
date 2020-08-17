<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		
		if(empty($_POST['idincendio']))
		{

			header("location: listar_incedios.php");
			mysqli_close($conection);
		}
		$idincendio = $_POST['idincendio'];

		$query_delete = mysqli_query($conection,"DELETE FROM incendios WHERE idincendio =$idincendio ");
		mysqli_close($conection);
		if($query_delete){
			header("location: listar_incedios.php");
		}else{
			echo "Error al eliminar";
		}

	}


	if(empty($_REQUEST['id']))
	{
		header("location: listar_incedios.php");
		mysqli_close($conection);
	}else{

		$idincendio = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT i.idincendio,i.fecha,i.departamento,i.provincia,i.distrito from incendios i
												WHERE i.idincendio = $idincendio");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$fecha = $data['fecha'];
				$departamento = $data['departamento'];
				$provincia     = $data['provincia'];
                $distrito     = $data['distrito'];

			}
		}else{
			header("location: listar_incendios.php");
		}


	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Incendio</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Fecha: <span><?php echo $fecha; ?></span></p>
			<p>Departamento: <span><?php echo $departamento; ?></span></p>
			<p>Provincia: <span><?php echo $provincia; ?></span></p>
            <p>Distrito: <span><?php echo $distrito; ?></span></p>


			<form method="post" action="">
				<input type="hidden" name="idincendio" value="<?php echo $idincendio; ?>">
				<a href="listar_incendios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>