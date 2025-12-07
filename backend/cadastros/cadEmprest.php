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
    <form method="POST" action="adEmprest.php">

        <h4>CADASTRAR EMPRESTIMOS</h4>

        <label>NOME:</label>
        <select name="nomeUser" input class="form-control">
             <?php
                require('../../bd/conexaobd.php');
                $sql="SELECT * FROM usuario";

                $result= mysqli_query($conn, $sql);

                while($registro = mysqli_fetch_assoc($result)){
                    $id = $registro['nomeUser'];
                    $nome = $registro['nome'];

                    echo "<option value='$nome'>$nome</option>";
                }
             ?>
        </select>
        <br>

        <label>IMAGEM:</label>
        <select name="imagem" input class="form-control">
             <?php
                require('../../bd/conexaobd.php');
                $sql="SELECT * FROM livro";

                $result = mysqli_query($conn, $sql);

                while($registro = mysqli_fetch_assoc($result)){
                    $id = $registro['id'];
                    $imagem = $registro['imagem'];

                    echo "<option value='$imagem'>$imagem</option>";
                }
             ?>
        </select>
        <br>

        <label>LIVRO:</label>
        <select name="livro" input class="form-control">
             <?php
                require('../../bd/conexaobd.php');
                $sql="SELECT * FROM livro";

                $result = mysqli_query($conn, $sql);

                while($registro = mysqli_fetch_assoc($result)){
                    $id = $registro['id'];
                    $livro = $registro['titulo'];

                    echo "<option value='$id'>$livro</option>";
                }
             ?>
        </select>
        <br>

        <label>QUANTIDADE:</label>
        <input class="form-control" type="number" name="quantidade" placeholder="Ex: 1..." required>
        <br>
        
        <label>DATA DE EMPRESTIMO:</label>
        <input class="form-control" type="date" name="dtEmprestimo" required>
        <br>
 
        <label>DATA DE DEVOLUÇÃO:</label>
        <input class="form-control" type="date" name="dtDevolucao" required>
        <br>

        <input type="submit" class="btn btn-outline-success" value="CADASTRAR"> 
    </form>
    <br>

<?php


$sql = "SELECT * FROM emprestimos";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>
        <tr>
          <td>ID</td>
          <td>NOME</td>
          <td>LIVRO</td>
          <td>QUANTIDADE</td>
          <td>DATA DE EMPRESTIMO</td>
          <td>DATA DE DEVOLUÇÃO</td>
          <td>DEVOLVIDO</td>
          <td>STATUS</td>
          <td>AÇÕES</td>
        </tr>
";

$hoje = date('Y-m-d');

while($registro = mysqli_fetch_assoc($result)){

    $id = $registro['id'];
    $nomeUser = $registro['nomeUser'];
    $imagem = $registro['imagem'];
    $quantidade = $registro['quantidade'];
    $botaoDevolver = $registro['devolvido'] === 'S' ? '<span class="text-primary">Devolvido</span>' : "<a href='devolverLivro.php?id=$id' class='btn btn-primary btn-sm'>DEVOLVER</a>";
    $urldel = "deletarLivro.php?id=$id";

    $dtEmprestimo = date('d/m/Y', strtotime($registro['dtEmprestimo']));
    
    $dataDevolucaoOriginal = $registro['dtDevolucao'];
    $dtDevolucao = date('d/m/Y', strtotime($dataDevolucaoOriginal));

    $devolvido = $registro['devolvido'] === 'S' ? 'S' : 'N';
    
    $diasEntreEmprestimoEDevolucao = (strtotime($dataDevolucaoOriginal) - strtotime($registro['dtEmprestimo'])) / 86400;

    if ($diasEntreEmprestimoEDevolucao < 0) {
        $aviso = "<span style='color: red; font-weight: bold;'>Data inválida</span>";
    } else if ($diasEntreEmprestimoEDevolucao <= 30) {
        $aviso = "<span style='color: orange; font-weight: bold;'>Prazo: $diasEntreEmprestimoEDevolucao dias</span>";
    } else {
        $aviso = "<span style='color: green;'>Prazo: $diasEntreEmprestimoEDevolucao dias</span>";
    }

    echo "<tr>
      <td>$id</td>
      <td>$nomeUser</td>
      <td><img src='$imagem' width='120'></td>
      <td>$quantidade</td>
      <td>$dtEmprestimo</td>
      <td>$dtDevolucao</td>
      <td>$devolvido</td>
      <td>$aviso</td>    
      <td>$botaoDevolver</td>    
      <td><a href='$urldel' class='btn btn-danger btn-sm'>EXCLUIR</a></td>  

    </tr>";
}
echo "</table>";
?>

<footer class="mt-7">
    <p class="mb-0">Sistema De Gerenciamento de Livros © 2025 – Cadastro de Empréstimos</p>
</footer>

</body>
</html>