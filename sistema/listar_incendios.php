<?php 
	session_start();
	
	
	include "../conexion.php";	

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Incendios en el Peru</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<a href="registro_incendios.php" class="btn_new">Registrar Incendio</a>

        <a href="registro_incendios.php" class="btn_new">Predecir Zonas De Riesgo</a>

		
		<form action="buscar_usuarios.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Fecha</th>
				<th>Departamento</th>
				<th>Provincia</th>
				<th>Distrito</th>
				<th>Personas Afectadas</th>
				<th>Personas Damnificadas</th>
				<th>Personas Fallecidas</th>
				<th>Viviendas Afectadas</th>
				<th>Viviendas Destruidas</th>
	
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM incendios");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 10;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT i.idincendio,i.fecha,de.departamento,p.provincia,d.distrito,i.per_afec,i.per_damn,i.per_fall,i.viv_afec,i.viv_dest

				FROM 
				    incendios i  INNER JOIN Distrito d on i.distrito=d.iddistrito 
				                 INNER JOIN Provincia p on i.provincia=p.idprovincia
                                 INNER JOIN Departamento de on i.departamento=de.iddepartamento
				    ORDER BY i.idincendio 

				    ASC LIMIT $desde,$por_pagina ");
			
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["idincendio"]; ?></td>
					<td><?php echo $data["fecha"]; ?></td>
					<td><?php echo $data['departamento'] ?></td>
					<td><?php echo $data['provincia'] ?></td>
					<td><?php echo $data['distrito'] ?></td>
                    <td><?php echo $data["per_afec"]; ?></td>
					<td><?php echo $data["per_damn"]; ?></td>
					<td><?php echo $data["per_fall"]; ?></td>

                   	<td><?php echo $data["viv_afec"]; ?></td>
					<td><?php echo $data["viv_dest"]; ?></td>


					<td>
						<a class="link_edit" href="editar_incendio.php?id=<?php echo $data["idincendio"]; ?>">Editar</a>|
					
						<a class="link_delete" href="eliminar_incendio.php?id=<?php echo $data["idincendio"]; ?>">Eliminar</a>
					
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>