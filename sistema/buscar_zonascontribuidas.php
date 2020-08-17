<?php 
	session_start();

	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Zonas de Riesgo</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: listar_zonascontribuidas.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de Zonas de Contribuidas</h1>

		<form action="buscar_zonascontribuidas.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Direccion</th>
				<th>Motivo</th>
				<th>Descripcion</th>
				<th>Acciones</th>
			</tr>
		

		<?php 
			//Paginador
			

			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM zonacontribuida 
																WHERE ( 
																		motivo LIKE '%$busqueda%' OR 
																		descripcion LIKE '%$busqueda%'  ) 
																 ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT z.idzona, z.direccion, z.descripcion FROM zonacontribuida z 
                                       


										WHERE 
										( z.idzona LIKE '%$busqueda%' OR 
											z.nombre LIKE '%$busqueda%' OR 
											z.direccion LIKE '%$busqueda%' OR 
											z.tipo LIKE '%$busqueda%' ) 
										
										ORDER BY z.idzona ASC LIMIT $desde,$por_pagina ");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["idzona"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
					<td><?php echo $data["tipo"]; ?></td>
					<td>
						

					
						<a class="link_delete" href="eliminar_zonascontribuidas.php?id=<?php echo $data["idzona"]; ?>">Eliminar</a>
					
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>