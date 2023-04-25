<?php
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
$query = "UPDATE carreras SET carrera_codigo='$carrera_codigo', carrera_nombre='$carrera_nombre', 
carrera_abreviacion='$carrera_abreviacion' WHERE id = $id_carrera";
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
<link rel="stylesheet" href="estilos.css"> 
</head> 
<body> 
<div style="width:100%; text-align:center"> 
<h1>Laboratorio 9</h1> 
<h2>SISTEMA DE DETALLES DE CARRERA</h2> 
</div> 
<form class="form" action="index.php" method="POST"> 
<input type="hidden" name="id_carrera" value="<?php echo 
(isset($id_carrera))?$id_carrera:''; ?>"> 
<div class="w3-cell-row w3-center w3-padding"> 
carrera_codigo: <input style="margin:10px;display: inline-block;" type="text" 
name="carrera_codigo" value="<?php echo (isset($carrera_codigo))?$carrera_codigo:''; ?>"> 
carrera_nombre: <input style="margin:10px;display: inline-block;" type="text" 
name="carrera_nombre" value="<?php echo (isset($carrera_nombre))?$carrera_nombre:''; ?>"> 
carrera_abreviacion: <input style="margin:10px;display: inline-block;" type="text" 
name="carrera_abreviacion" value="<?php echo (isset($carrera_abreviacion))?$carrera_abreviacion:''; ?>"> 
</div> 
<div class="w3-cell-row w3-center w3-padding"> 
<input class="w3-btn w3-blue w3-border w3-margin" type="submit" name="submit" 
value="Insertar"> 
<input class="w3-btn w3-orange w3-border w3-margin" type="submit" name="Update" 
value="Actualizar"> 
<input class="w3-btn w3-red w3-border w3-margin" type="submit" name="Delete" 
value="Eliminar"> 
</div> 
</form> 
<br> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM carreras"; 
$res = $conn->query($query);  
?> 
<table class="w3-table-all w3-small"> 
<tr> 
<th>ID Carrera</th> 
<th>carrera_codigo</th> 
<th>carrera_nombre</th> 
<th>carrera_abreviacion</th> 
 
<th>Actualizar/Eliminar</th> 
</tr> 
<?php
    while ($row = $res->fetch_assoc()) { 
    echo "<tr class='w3-hover-blue' style='cursor:pointer;'>"; 
    echo "<td>" . $row['id'] . "</td>"; 
    echo "<td>" . $row['carrera_codigo'] . "</td>"; 
    echo "<td>" . $row['carrera_nombre'] . "</td>"; 
    echo "<td>" . $row['carrera_abreviacion'] . "</td>"; 
    echo "<td><a href='index.php?id_carrera=" . $row['id'] .  
    "'>Seleccionar</a></td>"; 
    echo "</tr>";  
    } 
    ?> 
    </table> 
    </body> 
    </html>