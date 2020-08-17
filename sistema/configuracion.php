<?php 


	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Configuración</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		

   <div class="divInfoSistem">

   <div> <h1 class="titlePanelControl">Mi Perfil </h1></div>
       <div class="containerPerfil">

           <div class="containerDataUser">
           <div>
             <img src="img/logoUser.png">
           </div>
            
    
           <h4>Información Personal</h4>

       <div><label>Nombre: </label> <span> <?=$_SESSION['nombre']; ?> </span> </div>

    <div> <label> Apellido: </label> <span> <?=$_SESSION['apellido']; ?> </span> </div>

    <div> <label> Correo: </label> <span> <?=$_SESSION['email']; ?> </span> </div>
       
       <br>
     <h4>Datos Usuario </h4>
     <div> <label> Usuario: </label> <span> <?=$_SESSION['user']; ?> </span> </div>

     <div> <label> Tipo de Usuario: </label> <span> <?=$_SESSION['rol_name']; ?> </span> </div>
      </div>



           </div>
        </div> 
    </div>

   
    
   </section>

	<?php include "includes/footer.php"; ?>
</body>
</html>


















   





