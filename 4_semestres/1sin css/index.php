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
$semestre_numeral = $_POST['semestre_numeral']; 
$semestre_literal = $_POST['semestre_literal']; 

$query = "INSERT INTO semestres (semestre_numeral, semestre_literal)  
VALUES('$semestre_numeral','$semestre_literal')"; 
$res = $conn->query($query); 
header("Refresh:0"); 
}else if (isset($_GET['id_semestre'])) { 
//Para seleccionar dato por un ID 
$query = "SELECT * FROM semestres WHERE id ='" . $_GET['id_semestre'] . "'"; 
$res = $conn->query($query); 
$row = $res->fetch_assoc(); 
$semestre_numeral = $row['semestre_numeral']; 
$semestre_literal = $row['semestre_literal']; 

$id_semestre = $row['id']; 
}else if (isset($_POST['Update'])) { 
//Para actualizar dato U=UPDATE 
$semestre_numeral = $_POST['semestre_numeral']; 
$semestre_literal = $_POST['semestre_literal']; 

$id_semestre = $_POST['id_semestre']; 
$query = "UPDATE semestres SET semestre_numeral='$semestre_numeral', semestre_literal='$semestre_literal' 
WHERE id = $id_semestre"; 
$res = $conn->query($query); 
header("Refresh:0; url=index.php"); 
}else if (isset($_POST['Delete'])) { 
//Para eliminar un dato D=DELETE 
$id_semestre = $_POST['id_semestre']; 
$query = "DELETE FROM semestres WHERE id = $id_semestre"; 
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
<h2>Sistema de detalles del Semestre</h2> 
</div> 
<form action="index.php" method="POST"> 
<input type="hidden" name="id_semestre" value="<?php echo 
(isset($id_semestre))?$id_semestre:''; ?>">
semestre_numeral: <input type="text" name="semestre_numeral" value="<?php echo (isset($semestre_numeral))?$semestre_numeral:''; ?>"> 
semestre_literal: <input type="text" name="semestre_literal" value="<?php echo (isset($semestre_literal))?$semestre_literal:'';  ?>"> 

<input type="submit" name="Insert" value="Insertar"> 
<input type="submit" name="Update" value="Actualizar"> 
<input type="submit" name="Delete" value="Eliminar"> 
</form> 
<br> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM semestres"; 
$res = $conn->query($query);  
?> 
<table border="1"> 
<tr> 
<th>ID Semestre</th> 
<th>semestre_numeral</th> 
<th>semestre_literal</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['semestre_numeral'] . "</td>"; 
echo "<td>" . $row['semestre_literal'] . "</td>"; 
echo "<td><a href='index.php?id_semestre=" . $row['id'] . "'>Seleccionar</a></td>"; 
echo "</tr>";  
} 
?> 
</table> 
</body> 
</html>