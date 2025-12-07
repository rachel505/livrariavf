<?php
require('../../bd/conexaobd.php');
require('../../backend/verificaLogado.php');

$nome = mb_strtoupper($_POST['nomeUser']);
$imagem = $_POST['imagem'];
$idLivro = $_POST['livro']; 
$quantidade = $_POST['quantidade']; 
$dtEmprestimo = $_POST['dtEmprestimo']; 
$dtDevolucao = $_POST['dtDevolucao']; 
$devolvido = "N"; 

$sqlCheck = "SELECT quantidade FROM livro WHERE id = $idLivro";
$result = mysqli_query($conn, $sqlCheck);
$dados = mysqli_fetch_assoc($result);

if (!$dados || $dados['quantidade'] < $quantidade) {
    echo "<script>
            alert('ESTOQUE INSUFICIENTE!');
            location.href='cadEmprest.php';
          </script>";
    exit;
}

$sql = "INSERT INTO emprestimos (nomeUser, imagem, livro, quantidade, dtEmprestimo, dtDevolucao, devolvido)
        VALUES ('$nome', '$imagem', '$idLivro', '$quantidade', '$dtEmprestimo', '$dtDevolucao', '$devolvido')";

if (mysqli_query($conn, $sql)) {
    $sqlUpdate = "UPDATE livro SET quantidade = quantidade - $quantidade WHERE id = $idLivro";
    mysqli_query($conn, $sqlUpdate);

    echo "<script>
            alert('EMPRÉSTIMO REGISTRADO E ESTOQUE DO LIVRO ATUALIZADO');
            location.href='cadEmprest.php';
          </script>";
} else {
    echo "<script>
            alert('ERRO AO SALVAR');
            location.href='cadEmprest.php';
          </script>";
}
?>