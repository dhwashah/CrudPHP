<!DOCTYPE html> 
<html>
<head>
<title>CRUD PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-theme.css" />
<script type = "text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type = "text/javascript" src="js/bootstrap.js"></script>
<script type = "text/javascript" src="js/alert.js"></script>
<script type = "text/javascript" src="js/modal.js"></script>
<script type = "text/javascript" src="js/selectedItem.js"></script>
</head>
<body>

<div class="container">

<?php
include 'html/cabecera.html';
?>
  
  <div style='margin-top:40px'></div>
  <div class="text-center">
    <div id='tabla' class="h1">Trabajadores</div>
  </div>
  

<?php
include 'php/conexion.php';

// Realizar una consulta MySQL
$query = 'SELECT dni, nombre, telefono, activo FROM trabajadores 
			order by dni';

$resultado = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error($conexion).'<br/>');

// Imprimir los resultados en una tabla HTML
echo "<form id='form' action='proceso.php' method='POST'>";
echo "<div class='row'>";
echo "<div class='col-lg-12 col-md-12 col-sm-12'>";

echo "<div class='table-responsive'>";
echo "<table class='table table-hover'>";
echo "<tr class='text-center'>";
echo "<td><h4><strong>Dni</strong></h4></td>";
echo "<td><h4><strong>Nombre</strong></h4></td>";
echo "<td><h4><strong>Telefono</strong></h4></td>";
echo "<td><h4><strong>Activo</strong></h4></td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

	while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		echo "<tr class='text-center'>";
			echo "<td style='vertical-align:middle'>".$registro['dni']."</td>";
			echo "<td style='vertical-align:middle'>".$registro['nombre']."</td>";
			echo "<td style='vertical-align:middle'>".$registro['telefono']."</td>";
			echo "<td style='vertical-align:middle'>".$registro['activo']."</td>";

			echo "<td><button class='btn btn-primary' type='submit' name='modificarTrabajador' value='".$registro['dni']."'>modificar</button></td>";			
			echo "<td><a name='eliminar' class='btn btn-danger' data-toggle='modal' data-target='#eliminarModal' value=".$registro['dni'].">eliminar</a></td>";
			
		echo "</tr>";
	}
echo "<tr><td colspan='6' class='text-right'><button class='btn btn-success' type='submit' name='insertarTrabajador' value='insertar'>insertar</button></td></tr>";
echo "</table>";
echo "</div>";	//div de la tabla para hacerla responsive
echo "</div>";	//proyectos
echo "</div>";	//tamaños
echo "</div>";	//row
echo "</form>";

// Liberar resultados
mysqli_free_result($resultado);
// Cerrar la conexion
mysqli_close($conexion);


//mensajes de estado
if(ISSET($_GET['mod']))
{
	if($_GET['mod'] == 1)
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-success'>";
		echo "Registro modificado correctamente";
		echo "</div>";
		echo "</div>";
	}
	else 
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-danger'>";
		echo "El registro no se ha podido modificar";
		echo "</div>";
		echo "</div>";
	}
}

if(ISSET($_GET['del']))
{
	if($_GET['del'] == 1)
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-success'>";
		echo "Registro eliminado correctamente";
		echo "</div>";
		echo "</div>";
	}
	else
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-danger'>";
		echo "El registro no se ha podido eliminar";
		echo "</div>";
		echo "</div>";
	}
}
if(ISSET($_GET['ins']))
{
	if($_GET['ins'] == 1)
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-success'>";
		echo "Registro creado correctamente";
		echo "</div>";
		echo "</div>";
	}
	else
	{
		echo "<div id='alert' style='display:none' class='text-center col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>";
		echo "<div role='alert' class='alert alert-danger'>";
		echo "El registro no se ha podido crear";
		echo "</div>";
		echo "</div>";
	}
}
?>
     
</div>

<!-- Modal -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="open">Eliminar registro</h4>
              </div>
              <div class="modal-body">
                <div>
                  <p> ¿Seguro que desea eliminar el registro? </p>
                </div>
              </div>
              <div class="modal-footer">
              	<form action="php/eliminar.php" method="post">
                	<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                	<button id='btnEliminar' type="submit" name="eliminarTrabajador" value=-1 class="btn btn-default"> Si </button>
                </form>
              </div>
            </div>
          </div>
        </div>
            
</body>
</html>