<?php
//index.php Bootstrap  
$hostname = "localhost"; 
$usuario = "root"; 
$password = ""; 
$nombreBD = "labo9_crud_LNPM"; 
//Crear conexión 
$conn = mysqli_connect($hostname, $usuario, $password, $nombreBD);  
//CRUD 
if (isset($_POST['submit'])) { 
//Para insertar datos C=CREATE 
$carrera_codigo = $_POST['carrera_codigo']; 
$carrera_nombre = $_POST['carrera_nombre']; 
$carrera_abreviacion = $_POST['carrera_abreviacion']; 
$query = "INSERT INTO carreras (carrera_codigo, carrera_nombre, carrera_abreviacion)  
VALUES('$carrera_codigo','$carrera_nombre','$carrera_abreviacion')"; 
$res = $conn->query($query); 
header("Refresh:0"); 
}else if (isset($_GET['id_carrera'])) { 
//Para seleccionar dato por un ID 
$query = "SELECT * FROM carreras WHERE id ='" . $_GET['id_carrera'] . "'"; 
$res = $conn->query($query); 
$row = $res->fetch_assoc(); 
$carrera_codigo = $row['carrera_codigo']; 
$carrera_nombre = $row['carrera_nombre']; 
$carrera_abreviacion = $row['carrera_abreviacion']; 
$id_carrera = $row['id']; 
}else if (isset($_POST['Update'])) { 
//Para actualizar dato U=UPDATE 
$carrera_codigo = $_POST['carrera_codigo']; 
$carrera_nombre = $_POST['carrera_nombre']; 
$carrera_abreviacion = $_POST['carrera_abreviacion']; 
$id_carrera = $_POST['id_carrera']; 
$query = "UPDATE carreras SET carrera_codigo='$carrera_codigo', carrera_nombre='$carrera_nombre', carrera_abreviacion='$carrera_abreviacion'  
WHERE id = $id_carrera"; 
$res = $conn->query($query); 
header("Refresh:0; url=index.php"); 
}else if (isset($_POST['Delete'])) { 
//Para eliminar un dato D=DELETE 
$id_carrera = $_POST['id_carrera']; 
$query = "DELETE FROM carreras WHERE id = $id_carrera"; 
$res = $conn->query($query); 
} 
?> 
<!DOCTYPE html> 
<html lang="es"> 
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Laboratorio 9</title> 
<link rel="stylesheet" href="bootstrap.min.css"> 
</head> 
<body> 
<div class="jumbotron text-center" style="margin-bottom:0"> 
<h1>Laboratorio 9</h1> 
<h2>SISTEMA DE DETALLES DE CARRERA</h2> 
</div> 
<div class="container-fluid" style="margin-top: 30px;">
<div class="row"> 
<div class="col-sm-4"> 
<form class="form" action="index.php" method="POST"> 
<input type="hidden" name="id_carrera" value="<?php echo 
(isset($id_carrera))?$id_carrera:''; ?>"> 
<div class="form-group"> 
<label>carrera_codigo: </label> 
<input class="form-control" type="text" name="carrera_codigo" value="<?php echo 
(isset($carrera_codigo))?$carrera_codigo:''; ?>"> 
</div> 
<div class="form-group"> 
<label>carrera_nombre: </label> 
<input class="form-control" type="text" name="carrera_nombre" value="<?php echo 
(isset($carrera_nombre))?$carrera_nombre:''; ?>"> 
</div> 
<div class="form-group"> 
<label>carrera_abreviacion: </label> 
<input class="form-control" type="text" name="carrera_abreviacion" value="<?php echo 
(isset($carrera_abreviacion))?$carrera_abreviacion:''; ?>"> 
</div> 
<input class="btn btn-primary" type="submit" name="submit" value="Insertar"> 
<input class="btn btn-warning" type="submit" name="Update" value="Actualizar"> 
<input class="btn btn-danger" type="submit" name="Delete" value="Eliminar"> 
</form> 
</div> 
<div class="col-sm-8"> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM carreras"; 
$res = $conn->query($query);  
?> 
<table class="table table-bordered table-hover"> 
<thead> 
<tr> 
<th>ID Carrera</th> 
<th>carrera_codigo</th> 
<th>carrera_nombre</th> 
<th>carrera_abreviacion</th>  
<th>Actualizar/Eliminar</th> 
</tr> 
</thead> 
<tbody> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['carrera_codigo'] . "</td>"; 
echo "<td>" . $row['carrera_nombre'] . "</td>"; 
echo "<td>" . $row['carrera_abreviacion'] . "</td>"; 
echo "<td><a href='index.php?id_carrera=" . $row['id'] .  
"'>Seleccionar</a></td>"; 
echo "</tr>";  
} 
?> 
</tbody> 
</table> 
</div> 
</div> 
</div> 
<footer>
<div class="jumbotron text-left" style="margin-bottom:0"> 
<p>By LUZ 2023</p> 
</div> 
</footer>
</body> 
</html>