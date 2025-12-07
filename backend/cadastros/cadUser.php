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
            margin-top: 170px;
        }
    </style>
      <form method="POST" action="adUser.php">

        <h4>CADASTRAR USUÁRIO</h4>

        <label>NOME:</label>
        <input class="form-control" type="text" name="nome" placeholder="Ex: Mary" required>
        <br>

        <label>EMAIL:</label>
        <input class="form-control" type="email" name="email" placeholder="Ex: mary@gmail.com" required>
        <br>
        
        <input type="submit" class="btn btn-outline-success" value="CADASTRAR"> 
    </form><br>
<?php

$sql = "SELECT * FROM usuario";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>
        <tr>
          <td>ID</td>
          <td>NOME</td>
          <td>EMAIL</td>
          <td>AÇÕES</td>
        </tr>
";

while($registro = mysqli_fetch_assoc($result)){

    $id = $registro['id'];
    $nome = $registro['nome'];
    $email = $registro['email'];
    $assunto = urlencode("Lembrete de Devolução de Livro");
    $mensagem = urlencode("Olá $nome, Este é um lembrete de que o prazo para devolução do livro da Livraria V&F está se aproximando. Por favor, verifique sua data de entrega para evitar atrasos. Obrigada!");
  
    $urldel = "acoes/deletePess.php?id=$id";
    $urledt = "editarPess.php?id=$id";

    echo "<tr>
      <td>$id</td>
      <td>$nome</td>
      <td>$email</td>

      <td>
      <a href='$urledt' class='btn btn-success btn-sm'>EDITAR</a>
      <a href='$urldel' class='btn btn-danger btn-sm'>EXCLUIR</a>
      <a href='mailto:$email?subject=$assunto&body=$mensagem' class='btn btn-primary btn-sm'>ENVIAR EMAIL</a>
      </td>   
        </tr>";

}
 echo "</table>";
?>

<footer class="mt-7">
    <p class="mb-0">Sistema De Gerenciamento de Livros © 2025 – Cadastro de Usuário</p>
</footer>

</body>
</html>