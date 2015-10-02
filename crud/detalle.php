<div style='margin-top:40px'></div>
<div class="text-center">
    <div id='tabla' class="h1">Proyecto</div>
</div>

<?php
$cod = $_POST['detalleProyecto'];

// Realizar una consulta MySQL
$query = "SELECT pro.codProyecto, pro.nomProyecto, dep.nomDepartamento, pro.fechaInicioProyecto, tra.dni, tra.nombre, tra.telefono, tra.activo, trapro.fechaInicioTrabajador
FROM proyectos as pro
inner join departamentos as dep on dep.codDepartamento=pro.codDepartamento
inner join trabajadorproyecto as trapro on trapro.codProyecto=pro.codProyecto
inner join trabajadores as tra on tra.dni=trapro.dni
where pro.codProyecto=$cod
order by pro.codProyecto";

$resultado = mysqli_query($conexion,$query) or die('Consulta fallida: ' . mysqli_error($conexion).'<br/>');


// Imprimir los resultados en una tabla HTML
echo "<div class='row'>";
echo "<div class='col-lg-12 col-md-12 col-sm-12'>";

echo "<div class='table-responsive'>";

echo "<table class='table table-hover'>";
echo "<tr class='text-center'>";
echo "<td><h4><strong>Codigo Proyecto</h4></strong></td>";
echo "<td><h4><strong>Nombre Proyecto</h4></strong></td>";
echo "<td><h4><strong>Nombre Departamento</h4></strong></td>";
echo "<td><h4><strong>Fecha Inicio Proyecto</h4></strong></td>";
echo "</tr>";

$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	echo "<tr class='text-center'>";
	echo "<td style='vertical-align:middle'>".$registro['codProyecto']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['nomProyecto']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['nomDepartamento']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['fechaInicioProyecto']."</td>";
	echo "</tr>";

echo "</table>";
echo "</div>";	//div de la tabla para hacerla responsive
echo "</div>";	//proyectos



echo "<div style='margin-top:140px'></div>";

echo "<div class='text-center'>";
echo "<div class='h1'>Trabajador del proyecto</div>";
echo "<table class='table table-hover'>";
echo "</div>";

echo "<div class='table-responsive'>";

echo "<tr class='text-center'>";
echo "<td><h4><strong>Dni</h4></strong></td>";
echo "<td><h4><strong>Nombre</h4></strong></td>";
echo "<td><h4><strong>Telefono</h4></strong></td>";
echo "<td><h4><strong>Activo</h4></strong></td>";
echo "<td><h4><strong>Fecha Inicio Trabajador</h4></strong></td>";
echo "</tr>";

echo "<tr class='text-center'>";
echo "<td style='vertical-align:middle'>".$registro['dni']."</td>";
echo "<td style='vertical-align:middle'>".$registro['nombre']."</td>";
echo "<td style='vertical-align:middle'>".$registro['telefono']."</td>";
echo "<td style='vertical-align:middle'>".$registro['activo']."</td>";
echo "<td style='vertical-align:middle'>".$registro['fechaInicioTrabajador']."</td>";
echo "</tr>";

while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<tr class='text-center'>";
	echo "<td style='vertical-align:middle'>".$registro['dni']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['nombre']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['telefono']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['activo']."</td>";
	echo "<td style='vertical-align:middle'>".$registro['fechaInicioTrabajador']."</td>";
	echo "</tr>";
}

echo "</table>";
echo "</div>";	//div de la tabla para hacerla responsive
echo "</div>";	//proyectos
echo "</div>";	//tamaños
echo "</div>";	//row



// Liberar resultados
mysqli_free_result($resultado);
// Cerrar la conexion
mysqli_close($conexion);
?>