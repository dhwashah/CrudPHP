<?php
if (ISSET($_POST['guardarProyecto']))
{
$codProyecto = $_POST['codProyecto'];
$nomProyecto = $_POST['nomProyecto'];
$codDepartamento = $_POST['codDepartamento'];
$fecha = $_POST['fecha'];

$query = "UPDATE proyectos
			SET nomProyecto='$nomProyecto',
			codDepartamento=$codDepartamento,
			fechaInicioProyecto='$fecha'
			where codProyecto=$codProyecto";

mysqli_query($conexion,$query) or die(header("refresh:0; url=../crud/index.php?mod=0"));

//echo "<p>datos actualizados</p>";
header("refresh:0; url=../crud/index.php?mod=1");
}

if (ISSET($_POST['guardarDepartamento']))
{
	$codDepartamento = $_POST['codDepartamento'];
	$nomDepartamento = $_POST['nomDepartamento'];

	$query = "UPDATE departamentos
	SET nomDepartamento='$nomDepartamento'
	where codDepartamento=$codDepartamento";

	mysqli_query($conexion,$query) or die(header("refresh:0; url=../crud/departamentos.php?mod=0"));

	//echo "<p>datos actualizados</p>";
	header("refresh:0; url=../crud/departamentos.php?mod=1");
}

if (ISSET($_POST['guardarTrabajador']))
{
	$dni = $_POST['dni'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$activo = $_POST['activo'];

	$query = "UPDATE trabajadores
	SET nombre='$nombre', telefono='$telefono', activo='$activo'
	where dni='$dni'";

	mysqli_query($conexion,$query) or die(header("refresh:0; url=../crud/trabajadores.php?mod=0"));

	//echo "<p>datos actualizados</p>";
	header("refresh:0; url=../crud/trabajadores.php?mod=1");
}

if(ISSET($_POST['modificarDepartamento']))	//se pulso el boton modificar
{
$codDepartamento = $_POST['modificarDepartamento'];


// Realizar una consulta MySQL
$query = "SELECT nomDepartamento FROM departamentos where codDepartamento='$codDepartamento'";
$resultado = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error().'<br/>');


// Imprimir los resultados en una tabla HTML
echo "<form role='form' action='proceso.php' method='POST'>";

echo "<div class='row'>";
echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
echo "<div class='thumbnail'>";
echo "<h3 class='text-center'>Modificar Departamento</h3>";


while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<div class='form-group'>";
	echo "<label>Codigo Departamento:</label></br>";
	echo $codDepartamento;
	echo "</div>";
	echo "<input type='hidden' name='codDepartamento' value='".$codDepartamento."'>";
	
	echo "<div class='form-group'>";
	echo "<label>Nombre Departamento:</label>";
	echo "<input type='text' class='form-control' name='nomDepartamento' value='".$registro['nomDepartamento']."'>";
	echo "</div>";
}

echo "<div class='text-right btn-toolbar'>";
echo "<input class='btn btn-danger' type='submit' name='cancelarDepartamento' value='cancelar'>";
echo "<input class='btn btn-success' type='submit' name='guardarDepartamento' value='guardar'>";
echo "</div>";

echo "</div>";	//modificar
echo "</div>";	//thumbnail
echo "</div>";	//row
echo "</form>";

// Liberar resultados
mysqli_free_result($resultado);
// Cerrar la conexion
mysqli_close($conexion);
}

if(ISSET($_POST['modificarTrabajador']))	//se pulso el boton modificar
{
	$dni = $_POST['modificarTrabajador'];

	// Realizar una consulta MySQL
	$query = "SELECT dni, nombre, telefono, activo FROM trabajadores where dni='$dni'";
	$resultado = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error().'<br/>');


	// Imprimir los resultados en una tabla HTML
	echo "<form role='form' action='proceso.php' method='POST'>";

	echo "<div class='row'>";
	echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
	echo "<div class='thumbnail'>";
	echo "<h3 class='text-center'>Modificar Trabajador</h3>";


	while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		echo "<div class='form-group'>";
		echo "<label>Dni:</label></br>";
		echo $dni;
		echo "</div>";
		echo "<input type='hidden' name='dni' value='".$dni."'>";

		echo "<div class='form-group'>";
		echo "<label>Nombre Trabajador:</label>";
		echo "<input type='text' class='form-control' name='nombre' value='".$registro['nombre']."'>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "<label>Telefono:</label>";
		echo "<input type='text' class='form-control' name='telefono' value='".$registro['telefono']."'>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "<label>Activo:</label>";
		echo "<input type='text' class='form-control' name='activo' value='".$registro['activo']."'>";
		echo "</div>";
	}

	echo "<div class='text-right btn-toolbar'>";
	echo "<input class='btn btn-danger' type='submit' name='cancelarTrabajador' value='cancelar'>";
	echo "<input class='btn btn-success' type='submit' name='guardarTrabajador' value='guardar'>";
	echo "</div>";

	echo "</div>";	//modificar
	echo "</div>";	//thumbnail
	echo "</div>";	//row
	echo "</form>";

	// Liberar resultados
	mysqli_free_result($resultado);
	// Cerrar la conexion
	mysqli_close($conexion);
}
?>