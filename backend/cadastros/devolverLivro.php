<?php
require('../../bd/conexaobd.php');
require('../../backend/verificaLogado.php');

$idEmprestimo = $_GET['id'];

$sql = "SELECT livro, quantidade, devolvido FROM emprestimos WHERE id = $idEmprestimo";
$res = mysqli_query($conn, $sql);
$dados = mysqli_fetch_assoc($res);

if ($dados['devolvido'] === "S") {
    echo "<script>alert('LIVRO JÁ DEVOLVIDO'); history.back();</script>";
    exit;
}

$idLivro = $dados['livro'];
$quantidade = $dados['quantidade'];

$sqlUp = "UPDATE emprestimos SET devolvido = 'S' WHERE id = $idEmprestimo";
mysqli_query($conn, $sqlUp);

$sqlEstoque = "UPDATE livro SET quantidade = quantidade + $quantidade WHERE id = $idLivro";
mysqli_query($conn, $sqlEstoque);

echo "<script>
        alert('DEVOLVIDO COM SUCESSO! ESTOQUE ATUALIZADO');
        location.href='cadEmprest.php';
      </script>";
?>