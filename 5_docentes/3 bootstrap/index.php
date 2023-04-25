<?php
//index.php Bootstrap  
$hostname = "localhost"; 
$usuario = "root"; 
$password = ""; 
$nombresBD = "labo9_crud_LNPM"; 
//Crear conexión 
$conn = mysqli_connect($hostname, $usuario, $password, $nombresBD);  
//CRUD 
if (isset($_POST['submit'])) { 
//Para insertar datos C=CREATE
$ci = $_POST['ci']; 
$nombres = $_POST['nombres']; 
$fecha_nacimiento = $_POST['fecha_nacimiento']; 
$direccion = $_POST['direccion']; 
$celular = $_POST['celular']; 
$query = "INSERT INTO docentes (ci,nombres, fecha_nacimiento, direccion,celular)  
VALUES('$ci','$nombres','$fecha_nacimiento','$direccion','$celular')"; 
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
$query = "UPDATE docentes SET ci='$ci',nombres='$nombres', fecha_nacimiento='$fecha_nacimiento', direccion='$direccion',celular='$celular'  WHERE id = $id_docente"; 
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
<link rel="stylesheet" href="bootstrap.min.css"> 
</head> 
<body> 
<div class="jumbotron text-center" style="margin-bottom:0"> 
<h1>Laboratorio 9</h1> 
<h2>Sistema de detalles del Docente</h2> 
</div> 
<div class="container-fluid" style="margin-top: 30px;">
<div class="row"> 
<div class="col-sm-4"> 
<form class="form" action="index.php" method="POST"> 
<input type="hidden" name="id_docente" value="<?php echo 
(isset($id_docente))?$id_docente:''; ?>"> 
<div class="form-group"> 
<label>ci: </label> 
<input class="form-control" type="text" name="ci" value="<?php echo 
(isset($ci))?$ci:''; ?>"> 
</div> 
<div class="form-group"> 
<label>nombres: </label> 
<input class="form-control" type="text" name="nombres" value="<?php echo 
(isset($nombres))?$nombres:''; ?>"> 
</div> 
<div class="form-group"> 
<label>fecha_nacimiento: </label> 
<input class="form-control" type="text" name="fecha_nacimiento" value="<?php echo 
(isset($fecha_nacimiento))?$fecha_nacimiento:''; ?>"> 
</div> 
<div class="form-group"> 
<label>direccion: </label> 
<input class="form-control" type="text" name="direccion" value="<?php echo 
(isset($direccion))?$direccion:''; ?>"> 
</div> 
<div class="form-group"> 
<label>celular: </label> 
<input class="form-control" type="text" name="celular" value="<?php echo 
(isset($celular))?$celular:''; ?>"> 
</div> 
<input class="btn btn-primary" type="submit" name="submit" value="Insertar"> 
<input class="btn btn-warning" type="submit" name="Update" value="Actualizar"> 
<input class="btn btn-danger" type="submit" name="Delete" value="Eliminar"> 
</form> 
</div> 
<div class="col-sm-8"> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM docentes"; 
$res = $conn->query($query);  
?> 
<table class="table table-bordered table-hover"> 
<thead> 
<tr> 
<th>ID Docente</th> 
<th>ci</th> 
<th>nombres</th> 
<th>fecha_nacimiento</th> 
<th>direccion</th> 
<th>celular</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
</thead> 
<tbody> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['ci'] . "</td>"; 
echo "<td>" . $row['nombres'] . "</td>"; 
echo "<td>" . $row['fecha_nacimiento'] . "</td>"; 
echo "<td>" . $row['direccion'] . "</td>"; 
echo "<td>" . $row['celular'] . "</td>"; 
echo "<td><a href='index.php?id_docente=" . $row['id'] .  
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
<p>By LUZ :) 2023</p> 
</div> 
</footer> 
</body> 
</html>