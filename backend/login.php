<?php

require('../bd/conexaobd.php');

$email = $_POST['email'];
$senha = $_POST['senha']; 

$sql = "SELECT * FROM adm WHERE email = '$email' AND senha = '$senha' AND isAdmin = 'S'";

$result = mysqli_query($conn, $sql);
$numR = $result->num_rows; 

if ($numR > 0) {
    while($registro = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['email'] = $registro['email']; 
        $_SESSION['senha'] = $registro['senha']; 
        $_SESSION['id'] = $registro['id']; 
        $_SESSION['logado'] = true; 

        echo "<script>
        location.href='../frontend/principal2.html'
        </script>";

    }
} else {
        echo "<script>
        alert('OS DADOS INFORMADOS ESTÃO INCORRETOS');
        location.href='../frontend/form.html'
        </script>";
}

?>