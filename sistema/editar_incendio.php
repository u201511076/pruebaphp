<?php 
	
	session_start();
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['fecha']) || empty($_POST['departamento'])|| empty($_POST['distrito']) || empty($_POST['provincia']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $idincendio = $_POST['idincendio'];
		    $fecha = $_POST['fecha'];
			$departamento = $_POST['departamento'];
			$provincia  = $_POST['provincia'];
			$distrito   = $_POST['distrito'];
			$per_afec  = $_POST['per_afec'];
			$per_damn  = $_POST['per_damn'];
			$per_fall  = $_POST['per_fall'];
			$viv_afec  = $_POST['viv_afec'];
			$viv_dest  = $_POST['viv_dest'];
			
	

       					$sql_update = mysqli_query($conection,"UPDATE incendios SET  
       						per_afec='$per_afec',per_damn= '$per_damn',per_fall='$per_fall',viv_afec= '$viv_afec', viv_dest='$viv_dest'
															WHERE idincendio= $idincendio");
				
				if($sql_update){
					$alert='<p class="msg_save">El incendio ha sido actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el incendio.</p>';
				}


		}

	}


		if(empty($_REQUEST['id']))
	{
		header('Location: listar_incendios.php');
		mysqli_close($conection);
	}
	

	 $idincendio = $_REQUEST['id'];

     $query_incendio= mysqli_query($conection,"SELECT i.idincendio,i.fecha,de.iddepartamento,de.departamento,p.idprovincia,p.provincia,d.iddistrito ,d.distrito,i.per_afec,i.per_damn,i.per_fall, i.viv_afec,i.viv_dest FROM 
				    incendios i  INNER JOIN Distrito d on i.distrito=d.iddistrito 
				                 INNER JOIN Provincia p on i.provincia=p.idprovincia
                                 INNER JOIN Departamento de on i.departamento=de.iddepartamento where idincendio=$idincendio");
     $result_incendio= mysqli_num_rows($query_incendio);

     if($result_incendio >0)
      {
       $data_incendio= mysqli_fetch_assoc($query_incendio);
       print_r($data_incendio);

      }

      else
      {

       header('Location: listar_incendios.php');

      }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Incendios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar de Incendios</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" >

	            <input type="hidden" name="idincendio" value="<?php $data_incendio["idincendio"]; ?>"> 
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha" id="fecha"  value="<?php echo $data_incendio["fecha"]; ?>">

				<label for="departamento">Departamento</label>
 
                <?php 

					$query_dep = mysqli_query($conection,"SELECT * FROM departamento order by departamento");
					
					$result_dep = mysqli_num_rows($query_dep);

				 ?>

				<select name="departamento" id="departamento" class="notItemOne">
					<option value=" <?php echo $data_incendio["iddepartamento"]; ?>" selected> <?php echo $data_incendio["departamento"] ?>   </option>
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

				<select name="provincia" id="provincia"  class="notItemOne">
					<option value=" <?php echo $data_incendio["idprovincia"]; ?>" selected> <?php echo $data_incendio["provincia"] ?>   </option>
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

				<select name="distrito" id="distrito"  class="notItemOne">
				 <option value=" <?php echo $data_incendio["iddistrito"]; ?>" selected> <?php echo $data_incendio["distrito"] ?>   </option>
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
				<input type="number" name="per_afec" id="per_afec" min="0" placeholder="0" value="<?php echo $data_incendio["per_afec"]; ?>">
			
				<label for="per_damn">Personas Damnificadas</label>
				<input type="number" name="per_damn" id="per_damn" min="0" placeholder="0" value="<?php echo $data_incendio["per_damn"]; ?>">
				
				<label for="per_fall">Personas Fallecidas</label>
				<input type="number" name="per_fall" id="per_fall" min="0" placeholder="0" value="<?php echo $data_incendio["per_fall"]; ?>">


				<label for="viv_afec">Viviendas Afectadas</label>
				<input type="number" name="viv_afec" id="viv_afec" min="0" placeholder="0" value="<?php echo $data_incendio["viv_afec"]; ?>">
				
				<label for="viv_dest">Viviendas Destruidas</label>
				<input type="number" name="viv_dest" id="viv_dest" min="0" placeholder="0" value="<?php echo $data_incendio["viv_dest"] ?>">

			


				<input type="submit" value="Actualizar Incendio" class="btn_save">

			</form>

		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>