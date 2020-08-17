$(document).ready(function(){
 
 $.ajax({
    type: 'POST',
    url: 'sistema/cargar_dep.php'
  })
  .done(function(listas_dep){
    $('#lista_departamento').html(listas_dep)
  })
  .fail(function(){
    alert('Hubo un errror al cargar')
  })
