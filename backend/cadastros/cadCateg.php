<?php
require('../../frontend/principal.html');
require('../../bd/conexaobd.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria VF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">   
    <link rel="stylesheet" href="../../frontend/css/estilo.css">
</head>
<body>
    <style>
        footer {
            background-color: #ffffff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.08);
            margin-top: 50px;
        }
    </style>
    <div class="container">
    
    <form method="POST"  action="adCateg.php"  class="item-form">

        <h4>CADASTRAR CATEGORIA</h4>
        <br><br>

        <label>DESCRIÇÃO:</label>
        <input class="form-control" type="text" name="categoria" placeholder="Ex: Ficção" required>
        <br>
     
        <input type="submit" class="btn btn-outline-success" value="CADASTRAR"> 
        </a>
    </form>
    <br><br>
    </div>

<?php

$sql = "SELECT * FROM categoria";
$result = mysqli_query($conn, $sql);

echo "<table border='2'>
        <tr>
          <td>ID</td>
          <td>CATEGORIA</td>
          <td>ACÕES</td>
        </tr>
";

while($registro = mysqli_fetch_assoc($result)){

    $id = $registro['id'];
    $categoria = $registro['categoria'];
    
    $urldel = "acoes/deleteCateg.php?id=$id";
    $urledt = "editarCateg.php?id=$id";

    echo "<tr>
      <td>$id</td>
      <td>$categoria</td>
      
      <td>
      <a href='$urledt' class='btn btn-success btn-sm'>EDITAR</a>
      <a href='$urldel' class='btn btn-danger btn-sm'>EXCLUIR</a>
      </td>  
          </tr>";

}
 echo "</table>";
?>

<footer class="mt-7">
    <p class="mb-0">Sistema De Gerenciamento de Livros © 2025 – Cadastro de Categorias</p>
</footer>

</body>
</html>