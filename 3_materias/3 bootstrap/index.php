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
$materia_nombre = $_POST['materia_nombre']; 
$hora_academica = $_POST['hora_academica']; 
$tipo = $_POST['tipo']; 
$query = "INSERT INTO materias (materia_nombre, hora_academica, tipo)  
VALUES('$materia_nombre','$hora_academica','$tipo')"; 
$res = $conn->query($query); 
header("Refresh:0"); 
}else if (isset($_GET['id_materia'])) { 
//Para seleccionar dato por un ID 
$query = "SELECT * FROM materias WHERE id ='" . $_GET['id_materia'] . "'"; 
$res = $conn->query($query); 
$row = $res->fetch_assoc(); 
$materia_nombre = $row['materia_nombre']; 
$hora_academica = $row['hora_academica']; 
$tipo = $row['tipo']; 
$id_materia = $row['id']; 
}else if (isset($_POST['Update'])) { 
//Para actualizar dato U=UPDATE 
$materia_nombre = $_POST['materia_nombre']; 
$hora_academica = $_POST['hora_academica']; 
$tipo = $_POST['tipo']; 
$id_materia = $_POST['id_materia']; 
$query = "UPDATE materias SET materia_nombre='$materia_nombre', hora_academica='$hora_academica', tipo='$tipo'  
WHERE id = $id_materia"; 
$res = $conn->query($query); 
header("Refresh:0; url=index.php"); 
}else if (isset($_POST['Delete'])) { 
//Para eliminar un dato D=DELETE 
$id_materia = $_POST['id_materia']; 
$query = "DELETE FROM materias WHERE id = $id_materia"; 
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
<h2>SISTEMA DE DETALLES DE MATERIAS</h2> 
</div> 
<div class="container-fluid" style="margin-top: 30px;">
<div class="row"> 
<div class="col-sm-4"> 
<form class="form" action="index.php" method="POST"> 
<input type="hidden" name="id_materia" value="<?php echo 
(isset($id_materia))?$id_materia:''; ?>"> 
<div class="form-group"> 
<label>materia_nombre: </label> 
<input class="form-control" type="text" name="materia_nombre" value="<?php echo 
(isset($materia_nombre))?$materia_nombre:''; ?>"> 
</div> 
<div class="form-group"> 
<label>hora_academica: </label> 
<input class="form-control" type="text" name="hora_academica" value="<?php echo 
(isset($hora_academica))?$hora_academica:''; ?>"> 
</div> 
<div class="form-group"> 
<label>tipo: </label> 
<input class="form-control" type="text" name="tipo" value="<?php echo 
(isset($tipo))?$tipo:''; ?>"> 
</div> 
<input class="btn btn-primary" type="submit" name="submit" value="Insertar"> 
<input class="btn btn-warning" type="submit" name="Update" value="Actualizar"> 
<input class="btn btn-danger" type="submit" name="Delete" value="Eliminar"> 
</form> 
</div> 
<div class="col-sm-8"> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM materias"; 
$res = $conn->query($query);  
?> 
<table class="table table-bordered table-hover"> 
<thead> 
<tr> 
<th>ID Materias</th> 
<th>materia_nombre</th> 
<th>hora_academica</th> 
<th>tipo</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
</thead> 
<tbody> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['materia_nombre'] . "</td>"; 
echo "<td>" . $row['hora_academica'] . "</td>"; 
echo "<td>" . $row['tipo'] . "</td>"; 

echo "<td><a href='index.php?id_materia=" . $row['id'] .  
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