<?php 
    $hostname = "localhost"; 
    $usuario = "root"; 
    $password = ""; 
    $nombreBD = "labo9_crud_LNPM"; 
 
    //Crear conexión 
    $conn = mysqli_connect($hostname, $usuario, $password, $nombreBD);  
    //CRUD 
    if (isset($_POST['submit'])) {         //Para insertar datos C=CREATE 
        $semestre_numeral = $_POST['semestre_numeral']; 
        $semestre_literal = $_POST['semestre_literal']; 
        
        $query = "INSERT INTO semestres (semestre_numeral, semestre_literal) VALUES('$semestre_numeral','$semestre_literal')";        
        $res  = $conn->query($query);        
        header("Refresh:0"); 
    }else if (isset($_GET['id_semestre'])) { 
        //Para seleccionar dato por un ID 
        $query = "SELECT * FROM semestres WHERE id ='" . $_GET['id_semestre'] . "'"; 
        $res  = $conn->query($query); 
        $row = $res->fetch_assoc(); 
        $semestre_numeral = $row['semestre_numeral']; 
        $semestre_literal = $row['semestre_literal']; 
        $email = $row['email']; 
        $id_semestre = $row['id']; 
 
    }else if (isset($_POST['Update'])) { 
        //Para actualizar dato U=UPDATE 
        $semestre_numeral = $_POST['semestre_numeral']; 
        $semestre_literal = $_POST['semestre_literal']; 
       
        $id_semestre = $_POST['id_semestre']; 
        $query = "UPDATE semestres SET semestre_numeral='$semestre_numeral', semestre_literal='$semestre_literal' WHERE id = $id_semestre";         $res  = $conn->query($query);         header("Refresh:0; url=index.php"); 
         
    }else if (isset($_POST['Delete'])) {         //Para eliminar un dato D=DELETE 
        $id_semestre = $_POST['id_semestre']; 
        $query = "DELETE FROM  semestres  WHERE id = $id_semestre"; 
        $res  = $conn->query($query); 
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
        <h2>Sistema de detalles del Semestre</h2> 
    </div> 
    <form class="form" action="index.php" method="POST"> 
        <input type="hidden" name="id_semestre" value="<?php echo (isset($id_semestre))?$id_semestre:''; ?>"> 
 
        <div class="w3-cell-row w3-center w3-padding"> 
            semestre_numeral: <input style="margin:10px;display: inline-block;" type="text" name="semestre_numeral" value="<?php echo (isset($semestre_numeral))?$semestre_numeral:''; ?>"> 
            semestre_literal: <input style="margin:10px;display: inline-block;" type="text" name="semestre_literal" value="<?php echo (isset($semestre_literal))?$semestre_literal:''; ?>"> 
           
        </div> 
 
        <div class="w3-cell-row w3-center w3-padding"> 
            <input class="w3-btn w3-blue w3-border w3-margin" type="submit" name="submit" value="Insertar"> 
            <input class="w3-btn w3-orange w3-border w3-margin" type="submit" name="Update" value="Actualizar"> 
            <input class="w3-btn w3-red w3-border w3-margin" type="submit" name="Delete" value="Eliminar">             
        </div> 
    </form> 
    <br> 
    <?php 
        //Consulta SQL para realizar el listado de la tabla R=READ 
        $query = "SELECT * FROM semestres"; 
        $res  = $conn->query($query);         
    ?> 
    <table class="w3-table-all w3-small"> 
        <tr> 
            <th>ID Semestre</th> 
            <th>semestre_numeral</th> 
            <th>semestre_literal</th>  
            <th>Actualizar/Eliminar</th> 
        </tr>         <?php 
        while ($row = $res->fetch_assoc()) { 
            echo "<tr class='w3-hover-blue' style='cursor:pointer;'>"; 
            echo "<td>" . $row['id'] . "</td>"; 
            echo "<td>" . $row['semestre_numeral'] . "</td>"; 
            echo "<td>" . $row['semestre_literal'] . "</td>";          
             echo "<td><a href='index.php?id_semestre=" . $row['id'] . "'>Seleccionar</a></td>"; 
            echo "</tr>";          } 
        ?> 
    </table> 
</body> 
</html> 
