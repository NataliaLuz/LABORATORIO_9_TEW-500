<?php 
//index.php Sin Estilos (CSS) 
$hostname = "localhost"; 
$usuario = "root"; 
$password = ""; 
$nombreBD = "labo9_crud_LNPM"; 
//Crear conexión 
$conn = mysqli_connect($hostname, $usuario, $password, $nombreBD); 
//CRUD 
if (isset($_POST['Insert'])) { 
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
</head> 
<body> 
<div> 
<h1>Laboratorio 9</h1> 
<h2>Sistema de detalles de Carreras</h2> 
</div> 
<form action="index.php" method="POST"> 
<input type="hidden" name="id_carrera" value="<?php echo 
(isset($id_carrera))?$id_carrera:''; ?>">
Carrera_Codigo: <input type="text" name="carrera_codigo" value="<?php echo (isset($carrera_codigo))?$carrera_codigo:''; ?>"> 
Nombre: <input type="text" name="carrera_nombre" value="<?php echo (isset($carrera_nombre))?$carrera_nombre:'';  ?>"> 
Abreviacion: <input type="text" name="carrera_abreviacion" value="<?php echo (isset($carrera_abreviacion))?$carrera_abreviacion:''; ?>"> 
<input type="submit" name="Insert" value="Insertar"> 
<input type="submit" name="Update" value="Actualizar"> 
<input type="submit" name="Delete" value="Eliminar"> 
</form> 
<br> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM carreras"; 
$res = $conn->query($query);  
?> 
<table border="1"> 
<tr> 
<th>ID Carrera</th> 
<th>Carrera_Codigo</th> 
<th>Nombre</th> 
<th>Abreviacion</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['carrera_codigo'] . "</td>"; 
echo "<td>" . $row['carrera_nombre'] . "</td>"; 
echo "<td>" . $row['carrera_abreviacion'] . "</td>"; 
echo "<td><a href='index.php?id_carrera=" . $row['id'] . "'>Seleccionar</a></td>"; 
echo "</tr>";  
} 
?> 
</table> 
</body> 
</html>