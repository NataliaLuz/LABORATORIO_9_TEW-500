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
$query = "UPDATE semestres SET semestre_numeral='$semestre_numeral', semestre_literal='$semestre_literal' WHERE id = $id_semestre"; 
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
<link rel="stylesheet" href="bootstrap.min.css"> 
</head> 
<body> 
<div class="jumbotron text-center" style="margin-bottom:0"> 
<h1>Laboratorio 9</h1> 
<h2>Sistema de detalles del Semestre</h2> 
</div> 
<div class="container-fluid" style="margin-top: 30px;">
<div class="row"> 
<div class="col-sm-4"> 
<form class="form" action="index.php" method="POST"> 
<input type="hidden" name="id_semestre" value="<?php echo 
(isset($id_semestre))?$id_semestre:''; ?>"> 
<div class="form-group"> 
<label>semestre_numeral: </label> 
<input class="form-control" type="text" name="semestre_numeral" value="<?php echo 
(isset($semestre_numeral))?$semestre_numeral:''; ?>"> 
</div> 
<div class="form-group"> 
<label>semestre_literal: </label> 
<input class="form-control" type="text" name="semestre_literal" value="<?php echo 
(isset($semestre_literal))?$semestre_literal:''; ?>"> 
</div> 

<input class="btn btn-primary" type="submit" name="submit" value="Insertar"> 
<input class="btn btn-warning" type="submit" name="Update" value="Actualizar"> 
<input class="btn btn-danger" type="submit" name="Delete" value="Eliminar"> 
</form> 
</div> 
<div class="col-sm-8"> 
<?php 
//Consulta SQL para realizar el listado de la tabla R=READ 
$query = "SELECT * FROM semestres"; 
$res = $conn->query($query);  
?> 
<table class="table table-bordered table-hover"> 
<thead> 
<tr> 
<th>ID Semestre</th> 
<th>semestre_numeral</th> 
<th>semestre_literal</th> 
<th>Actualizar/Eliminar</th> 
</tr> 
</thead> 
<tbody> 
<?php 
while ($row = $res->fetch_assoc()) { 
echo "<tr>"; 
echo "<td>" . $row['id'] . "</td>"; 
echo "<td>" . $row['semestre_numeral'] . "</td>"; 
echo "<td>" . $row['semestre_literal'] . "</td>"; 
echo "<td><a href='index.php?id_semestre=" . $row['id'] .  
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