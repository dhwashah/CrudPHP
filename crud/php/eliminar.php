<?php
if (ISSET($_POST['eliminarProyecto']))
{
	$cod = $_POST['eliminarProyecto'];
	$query = "DELETE FROM proyectos WHERE codProyecto='$cod'";
	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../crud/index.php?del=0"));
	
	header("refresh:0; url=../crud/index.php?del=1");
}

if (ISSET($_POST['eliminarDepartamento']))
{
	include 'conexion.php';
	$cod = $_POST['eliminarDepartamento'];
	$query = "DELETE FROM departamentos WHERE codDepartamento='$cod'";
	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../../crud/departamentos.php?del=0"));
	
	header("refresh:0; url=../../crud/departamentos.php?del=1");
}

if (ISSET($_POST['eliminarTrabajador']))
{
	include 'conexion.php';
	$cod = $_POST['eliminarTrabajador'];
	$query = "DELETE FROM trabajadores WHERE dni='$cod'";
	mysqli_query($conexion,$query)
		or die(header("refresh:0; url=../../crud/trabajadores.php?del=0"));
	
	header("refresh:0; url=../../crud/trabajadores.php?del=1");
}
?>