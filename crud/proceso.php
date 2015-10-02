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
</head>
<body>


<div class="container">

<?php
include 'html/cabecera.html';

if(ISSET($_POST['cancelarProyecto']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../crud/index.php");
}
if(ISSET($_POST['cancelarDepartamento']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../crud/departamentos.php");
}
if(ISSET($_POST['cancelarTrabajador']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../crud/trabajadores.php");
}

include 'php/conexion.php';

if(ISSET($_POST['modificarProyecto']))	//se pulso el boton modificar
{
$codProyecto = $_POST['modificarProyecto'];


// Realizar una consulta MySQL
$query = "SELECT codProyecto, nomProyecto, codDepartamento, fechaInicioProyecto FROM proyectos where codProyecto='$codProyecto'";
$resultado = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error().'<br/>');

$query = "SELECT codDepartamento, nomDepartamento FROM departamentos";
$departamentos = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error().'<br/>');


// Imprimir los resultados en una tabla HTML
echo "<form role='form' action='proceso.php' method='POST'>";

echo "<div class='row'>";
echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
echo "<div class='thumbnail'>";
echo "<h3 class='text-center'>Modificar Proyecto</h3>";


while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<div class='form-group'>";
	echo "<label>Codigo Proyecto:</label></br>";
	echo $registro['codProyecto'];
	echo "</div>";
	echo "<input type='hidden' name='codProyecto' value='".$registro['codProyecto']."'>";
	
	echo "<div class='form-group'>";
	echo "<label>Proyecto:</label>";
	echo "<input type='text' class='form-control' name='nomProyecto' value='".$registro['nomProyecto']."'>";
	echo "</div>";

	echo "<div class='form-group'>";
	echo "<label>Departamento:</label>";
	echo "<select class='form-control' name='codDepartamento'>";
	while ($row = mysqli_fetch_array($departamentos, MYSQLI_ASSOC)) {
		if($registro['codDepartamento'] != $row['codDepartamento'])
			echo "<option value='".$row['codDepartamento']."'>".$row['nomDepartamento']."</option>";
		else
			echo "<option selected value='".$row['codDepartamento']."'>".$row['nomDepartamento']."</option>";
	}
	echo "</select>";
	echo "</div>";
	
	
	echo "<div class='form-group'>";
	echo "<label>Fecha:</label>";
	echo "<input type='date' class='form-control' name='fecha' value='".$registro['fechaInicioProyecto']."'>";
	echo "</div>";
}
echo "<div class='text-right btn-toolbar'>";
echo "<input class='btn btn-danger' type='submit' name='cancelarProyecto' value='cancelar'>";
echo "<input class='btn btn-success' type='submit' name='guardarProyecto' value='guardar'>";
echo "</div>";

echo "</div>";	//modificar
echo "</div>";	//thumbnail
echo "</div>";	//tamaños
echo "</div>";	//row
echo "</form>";

// Liberar resultados
mysqli_free_result($resultado);
mysqli_free_result($departamentos);
// Cerrar la conexion
mysqli_close($conexion);
}
else  //guardar los cambios o eliminar registro
{
	if(ISSET($_POST['guardarProyecto']) || 
			ISSET($_POST['modificarDepartamento']) || 
			ISSET($_POST['modificarTrabajador']) ||
			ISSET($_POST['guardarDepartamento']) ||
			ISSET($_POST['guardarTrabajador']))
		include 'php/guardar.php';

	if(ISSET($_POST['eliminarProyecto']) || ISSET($_POST['eliminarDepartamento']) || ISSET($_POST['eliminarTrabajador']))	//borrar
		include 'php/eliminar.php';
	
	if(ISSET($_POST['insertarProyecto']) || ISSET($_POST['insertarDepartamento']) || ISSET($_POST['insertarTrabajador']))	//crear
		include 'php/insertar.php';
	
	if(ISSET($_POST['detalleProyecto']))	//detalle
		include 'detalle.php';
}
?>
</div>
</body>
</html>