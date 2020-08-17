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
	<title>Registro de Incendios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro de Incendios</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

	
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha" id="fecha" placeholder="Fecha del Incendio">

				<label for="lista_departamento">Departamento</label>
 
				<select name="lista_departamento" id="lista_departamento">
				</select>


				<label for="provincia">Provincia</label>
   
				<select name="provincia" id="lista_provincia">
				
					
				  </select>
				
				<label for="distrito">Distrito</label>

                
				<select name="distrito" id="lista_distrito">
				
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
			

             
                 <input type="submit" value="Registrar " class="btn_save">
                	
                	
               
                	

			</form>

		</div>
		</section>
		
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
       <script type="text/javascript" src="js/index.js"></script>

</body>
</html>