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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
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
      <form method="POST" action="adLivro.php" enctype="multipart/form-data">

        <h4>CADASTRAR LIVRO</h4>

        <label>IMAGEM DO LIVRO:</label>
        <input type="file" id="" class="form-control" placeholder="" name="imagem" required>
        <br>
        
        <label>TITULO:</label>
        <input class="form-control" type="text" name="titulo" placeholder="Ex: O Quinze"required>
        <br>

        <label>CATEGORIA:</label>
        <select name="categoria" input class="form-control">
             <?php
                require('../../bd/conexaobd.php');
                $sql="SELECT * FROM categoria";

                $result = mysqli_query($conn, $sql);

                while($registro = mysqli_fetch_assoc($result)){
                    $id = $registro['id'];
                    $categoria = $registro['categoria'];

                    echo "<option value='$categoria'>$categoria</option>";
                }
             ?>
        </select>
        <br>

        <label>AUTOR(A):</label>
        <input class="form-control" type="text" name="autor" placeholder="Ex: Rachel de Queiroz" required>
        <br>

        <label>QUANTIDADE:</label>
        <input class="form-control" type="number" name="quantidade" placeholder="Ex: 1..." required>
        <br>

        <input type="submit" class="btn btn-outline-success" value="CADASTRAR"> 
    </form><br>

<?php
$sql = "SELECT * FROM livro";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>
        <tr>
          <td>ID</td>
          <td>IMAGEM</td>
          <td>TITULO</td>
          <td>CATEGORIA</td>
          <td>AUTOR</td>
          <td>QUANTIDADE</td>
          <td>AÇÕES</td>
        </tr>
";

while($registro = mysqli_fetch_assoc($result)){

    $id = $registro['id'];
    $imagem = $registro['imagem'];
    $titulo = $registro['titulo'];
    $categoria = $registro['categoria'];
    $autor = $registro['autor'];
    $quantidade = $registro['quantidade'];

    $urledt = "editarLivro.php?id=$id";
    $urldel = "deletarLivro.php?id=$id";

    echo "<tr>
      <td>$id</td>
      <td><img src='$imagem' width='120'></td>
      <td>$titulo</td>
      <td>$categoria</td>
      <td>$autor</td>
      <td>$quantidade</td>
      
      <td>
      <a href='$urledt' class='btn btn-success btn-sm'>EDITAR</a>
      <a href='$urldel' class='btn btn-danger btn-sm'>EXCLUIR</a>
      </td>     
        </tr>";
}
 echo "</table>";
?>

<footer class="mt-7">
    <p class="mb-0">Sistema De Gerenciamento de Livros © 2025 – Cadastro de Livros</p>
</footer>

</body>
</html>