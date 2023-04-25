<?php 
//index.php Sin Estilos (CSS) 
$hostname = "localhost"; 
$usuario = "root"; 
$password = ""; 
$nombresBD = "labo9_crud_LNPM"; 
//Crear conexión 
$conn = mysqli_connect($hostname, $usuario, $password, $nombresBD); 
//CRUD 
if (isset($_POST['Insert'])) { 
//Para insertar datos C=CREATE 
$ci = $_POST['ci']; 
$nombres = $_POST['nombres']; 
$fecha_nacimiento = $_POST['fecha_nacimiento']; 
$direccion = $_POST['direccion'];
$celular = $_POST['celular']; 
$query = "INSERT INTO docentes (ci, nombres, fecha_nacimiento, direccion, celular)  
VALUES('$ci ','$nombres','$fecha_nacimiento','$direccion','$celular')"; 
$res = $conn->query($query); 
header("Refresh:0"); 
}else if (isset($_GET['id_docente'])) { 
//Para seleccionar dato por un ID 
$query = "SELECT * FROM docentes WHERE id ='" . $_GET['id_docente'] . "'"; 
$res = $conn->query($query); 
$row = $res->fetch_assoc(); 
$ci = $row['ci']; 
$nombres = $row['nombres']; 
$fecha_nacimiento = $row['fecha_nacimiento']; 
$direccion = $row['direccion']; 
$celular = $row['celular']; 
$id_docente = $row['id']; 
}else if (isset($_POST['Update'])) { 
//Para actualizar dato U=UPDATE 
$ci = $_POST['ci']; 
$nombres = $_POST['nombres']; 
$fecha_nacimiento = $_POST['fecha_nacimiento']; 
$direccion = $_POST['direccion']; 
$celular = $_POST['celular'];
$id_docente = $_POST['id_docente']; 
$query = "UPDATE docentes SET ci='$ci', nombres='$nombres', fecha_nacimiento='$fecha_nacimiento', direccion='$direccion', celular='$celular'  
WHERE id = $id_docente"; 
$res = $conn->query($query); 
header("Refresh:0; url=index.php"); 
}else if (isset($_POST['Delete'])) { 
//Para eliminar un dato D=DELETE 
$id_docente = $_POST['id_docente']; 
$query = "DELETE FROM docentes WHERE id = $id_docente"; 
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
<h2>Sistema de detalles del Docente</h2> 
</div> 
<form action="index.php" method="POST"> 
<input type="hidden" name="id_docente" value="<?php echo 
(isset($id_docente))?$id_docente:''; ?>">
CI: <input type="text" name="ci" value="<?php echo (isset($ci))?$ci:''; ?>"> 
Nombres: <input type="text" name="nombres" value="<?php echo (isset($nombres))?$nombres:''; ?>"> 
Fecha_nacimiento: <input type="text" name="fecha_nacimiento" value="<?php echo (isset($fecha_nacimiento))?$fecha_nacimiento:'';  ?>"> 
Direccion: <input type="text" name="direccion" value="<?php echo (isset($direccion))?$direccion:''; ?>"> 
Celular: <input type="text" name="celular" value="<?php echo (isset($celular))?$celular:''; ?>"> 
<input type="submit" name="Insert" value="Insertar"> 
<input type="submit" name="Update" value="Actualizar"> 
<input type="submit" name="Delete" value="Eliminar"> 
</form> 
<br> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM docentes"; 
$res = $conn->query($query);  
?> 
<table border="1"> 
<tr> 
<th>ID Docente</th> 
<th>Nombres: <input type="text" name="nombres" value="<?php echo (isset($nombres))?$nombres:''; ?>"> </th> 
<th>Fecha_nacimiento</th> 
<th>Direccion</th> 
<th>Celular</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['nombres'] . "</td>"; 
echo "<td>" . $row['fecha_nacimiento'] . "</td>"; 
echo "<td>" . $row['direccion'] . "</td>"; 
echo "<td>" . $row['celular'] . "</td>"; 
echo "<td><a href='index.php?id_docente=" . $row['id'] . "'>Seleccionar</a></td>"; 
echo "</tr>";  
} 
?> 
</table> 
</body> 
</html>