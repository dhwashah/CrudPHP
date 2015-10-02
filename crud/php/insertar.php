<?php
if(ISSET($_POST['guardarProyecto']))	//se pulso el boton guardar
{
	include 'conexion.php';
	
	$codProyecto = $_POST['codProyecto'];
	$nomProyecto = $_POST['nomProyecto'];
	$codDepartamento = $_POST['codDepartamento'];
	$fecha = $_POST['fecha'];
	
	$query = "INSERT INTO proyectos (codProyecto, nomProyecto, codDepartamento, fechaInicioProyecto)
			VALUES ('$codProyecto','$nomProyecto',$codDepartamento,'$fecha')";

	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../../crud/index.php?ins=0"));
	
	//echo "<p>registro insertado</p>";
	header("refresh:0; url=../../crud/index.php?ins=1");
}
if(ISSET($_POST['cancelarProyecto']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../../crud/index.php");
}
if(ISSET($_POST['insertarProyecto']))
{
	$query = "SELECT codDepartamento, nomDepartamento FROM departamentos";
	$departamentos = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error($conexion).'<br/>');

	$query = "SELECT count(codProyecto) as cantidad FROM proyectos";
	$cantidad = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error($conexion).'<br/>');
	
	$row = mysqli_fetch_array($cantidad, MYSQLI_ASSOC);
	$cantidad = $row['cantidad'];
	$cantidad++;
	
	
	echo "<form role='form' action='php/insertar.php' method='POST'>";
	
	echo "<div class='row'>";
	echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
	echo "<div class='thumbnail'>";
	echo "<h3 class='text-center'>Insertar Proyecto</h3>";
	
	
	echo "<div class='form-group'>";
	echo "<label>Codigo proyecto:</label>";
	echo "<input type='text' class='form-control' name='codProyecto' value=$cantidad>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Nombre proyecto:</label>";
	echo "<input type='text' class='form-control' name='nomProyecto' autofocus>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Departamento:</label>";
	echo "<select class='form-control' name='codDepartamento'>";
	while ($row = mysqli_fetch_array($departamentos, MYSQLI_ASSOC)) {
		echo "<option value='".$row['codDepartamento']."'>".$row['nomDepartamento']."</option>";
	}
	echo "</select>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Fecha:</label>";
	echo "<input type='date' class='form-control' name='fecha' value='".date('Y-m-d')."'>";
	echo "</div>";
	
	
	echo "<div class='text-right btn-toolbar'>";
	echo "<input class='btn btn-danger' type='submit' name='cancelarProyecto' value='cancelar'>";
	echo "<input class='btn btn-success' type='submit' name='guardarProyecto' value='guardar'>";
	echo "</div>";
	echo "</form>";
	
	// Liberar resultados
	mysqli_free_result($departamentos);
	// Cerrar la conexion
	mysqli_close($conexion);
}


if(ISSET($_POST['guardarDepartamento']))	//se pulso el boton guardar
{
	include 'conexion.php';

	//$codDepartamento = $_POST['codDepartamento'];
	$nomDepartamento = $_POST['nomDepartamento'];

	$query = "INSERT INTO departamentos (nomDepartamento)
	VALUES ('$nomDepartamento')";

	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../../crud/departamentos.php?ins=0"));

	//echo "<p>registro insertado</p>";
	header("refresh:0; url=../../crud/departamentos.php?ins=1");
}
if(ISSET($_POST['cancelarDepartamento']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../../crud/departamentos.php");
}
if(ISSET($_POST['insertarDepartamento']))
{
	$query = "SELECT codDepartamento, nomDepartamento FROM departamentos";
	$departamentos = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error($conexion).'<br/>');


	echo "<form role='form' action='php/insertar.php' method='POST'>";

	echo "<div class='row'>";
	echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
	echo "<div class='thumbnail'>";
	echo "<h3 class='text-center'>Insertar Departamento</h3>";

	echo "<div class='form-group'>";
	echo "<label>Nombre Departamento:</label>";
	echo "<input type='text' class='form-control' name='nomDepartamento' autofocus>";
	echo "</div>";

	echo "<div class='text-right btn-toolbar'>";
	echo "<input class='btn btn-danger' type='submit' name='cancelarDepartamento' value='cancelar'>";
	echo "<input class='btn btn-success' type='submit' name='guardarDepartamento' value='guardar'>";
	echo "</div>";
	echo "</form>";

	// Liberar resultados
	mysqli_free_result($departamentos);
	// Cerrar la conexion
	mysqli_close($conexion);
}


if(ISSET($_POST['guardarTrabajador']))	//se pulso el boton guardar
{
	include 'conexion.php';

	$dni = $_POST['dni'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$activo = $_POST['activo'];
	

	$query = "INSERT INTO trabajadores (dni, nombre, telefono, activo)
		VALUES ('$dni', '$nombre', '$telefono', '$activo')";

	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../../crud/trabajadores.php?ins=0"));
	
	//echo "<p>registro insertado</p>";
	header("refresh:0; url=../../crud/trabajadores.php?ins=1");
}
if(ISSET($_POST['cancelarTrabajador']))	//se pulso el boton cancelar
{
	header("refresh:0; url=../../crud/trabajadores.php");
}
if(ISSET($_POST['insertarTrabajador']))
{
	echo "<form role='form' action='php/insertar.php' method='POST'>";

	echo "<div class='row'>";
	echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
	echo "<div class='thumbnail'>";
	echo "<h3 class='text-center'>Insertar Trabajador</h3>";

	echo "<div class='form-group'>";
	echo "<label>Dni:</label>";
	echo "<input type='text' class='form-control' name='dni' autofocus>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Nombre:</label>";
	echo "<input type='text' class='form-control' name='nombre'>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Teléfono:</label>";
	echo "<input type='text' class='form-control' name='telefono'>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<label>Activo:</label>";
	echo "<input type='text' class='form-control' name='activo'>";
	echo "</div>";
	

	echo "<div class='text-right btn-toolbar'>";
	echo "<input class='btn btn-danger' type='submit' name='cancelarTrabajador' value='cancelar'>";
	echo "<input class='btn btn-success' type='submit' name='guardarTrabajador' value='guardar'>";
	echo "</div>";
	echo "</form>";

	// Cerrar la conexion
	mysqli_close($conexion);
}
?>