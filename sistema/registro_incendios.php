<?php 
	
	session_start();
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['fecha']) || empty($_POST['departamento'])|| empty($_POST['distrito']) || empty($_POST['provincia']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $fecha = $_POST['fecha'];
			$departamento = $_POST['departamento'];
			$provincia  = $_POST['provincia'];
			$distrito   = $_POST['distrito'];
			$per_afec  = $_POST['per_afec'];
			$per_damn   =$_POST['per_damn'];
            $per_fall  = $_POST['per_fall'];
            $viv_afec  = $_POST['viv_afec'];
            $viv_dest  = $_POST['viv_dest'];
			


				$query_insert = mysqli_query($conection,"INSERT INTO incendios(fecha,departamento,provincia,distrito,per_afec,per_damn,per_fall,viv_afec,viv_dest)
																	VALUES('$fecha','$departamento','$provincia','$distrito','$per_afec','$per_damn','$per_fall','$viv_afec','$viv_dest') " );
				if($query_insert){
					$alert='<p class="msg_save">El incendio ha sido registrado correctamente.</p>';
				}else
				{
					$alert='<p class="msg_error">Error al registrar el incendio.</p>';
				}

		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Nuevo Incendio</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Nuevo Incendio</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

	
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha" id="fecha" placeholder="Fecha del Incendio">

				<label for="departamento">Departamento</label>
 
                <?php 

					$query_dep = mysqli_query($conection,"SELECT * FROM departamento order by departamento");
					
					$result_dep = mysqli_num_rows($query_dep);

				 ?>

				<select name="departamento" id="departamento">
					<?php 
						if($result_dep > 0)
						{
							while ($departamento = mysqli_fetch_array($query_dep)) {
					?>
							<option value="<?php echo $departamento["iddepartamento"]; ?>"><?php echo $departamento["departamento"] ?></option>
					<?php 
							
							}
							
						}
					 ?>
				</select>

				<label for="provincia">Provincia</label>
				
                <?php 
					$query_prov = mysqli_query($conection,"SELECT * FROM provincia order by provincia ");
				
					$result_prov = mysqli_num_rows($query_prov);

				 ?>

				<select name="provincia" id="provincia">
					<?php 
						if($result_prov > 0)
						{
							while ($provincia = mysqli_fetch_array($query_prov)) {
					?>
							<option value="<?php echo $provincia["idprovincia"]; ?>"><?php echo $provincia["provincia"] ?></option>
					<?php 
							
							}
							
						}
					 ?>
				</select>
				
				<label for="distrito">Distrito</label>

                
                <?php 
					$query_dis = mysqli_query($conection,"SELECT * FROM distrito order by distrito ");
					mysqli_close($conection);
					$result_dis = mysqli_num_rows($query_dis);


				 ?>

				<select name="distrito" id="lista_distrito">
				
				<?php 
						if($result_dis > 0)
						{
							while ($distrito = mysqli_fetch_array($query_dis)) {
					?>
							<option value="<?php echo $distrito["iddistrito"]; ?>"><?php echo $distrito["distrito"] ?></option>
					<?php 
							
							}
							
						}
					 ?>
                 </select>

			    <label for="per_afec">Personas Afectadas</label>
				<input type="number" name="per_afec" id="per_afec" min="0" placeholder="0" >
			
				<label for="per_damn">Personas Damnificadas</label>
				<input type="number" name="per_damn" id="per_damn" min="0" placeholder="0">
				
				<label for="per_fall">Personas Fallecidas</label>
				<input type="number" name="per_fall" id="per_fall" min="0" placeholder="0">


				<label for="viv_afec">Viviendas Afectadas</label>
				<input type="number" name="viv_afec" id="viv_afec" min="0" placeholder="0">
				
				<label for="viv_dest">Viviendas Destruidas</label>
				<input type="number" name="viv_dest" id="viv_dest" min="0" placeholder="0">
			

               
                 	
				<form >
				
				<a href="listar_incendios.php" class="btn_cancel">&nbsp&nbsp Cancelar</a>
				<input type="submit" value="Registrar" class="btn_ok">
			</form>

                	
               
                	

			</form>

		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>