<?php
require('../../bd/conexaobd.php');
require('../../backend/verificaLogado.php');

$titulo = mb_strtoupper($_POST['titulo']);
$categoria = mb_strtoupper($_POST['categoria']);
$autor = mb_strtoupper($_POST['autor']); 
$quantidade = mb_strtoupper($_POST['quantidade']);

$pasta = "uploads/"; 

if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

$nomeImg = uniqid() . "_" . $_FILES['imagem']['name'];
$caminho = $pasta . $nomeImg;

if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {

$sql = "INSERT INTO livro (imagem, categoria, titulo, autor, quantidade)
        VALUES ('$caminho', '$categoria', '$titulo', '$autor', '$quantidade')";

        if ( mysqli_query($conn, $sql) ) {
            echo"<script>
            alert('LIVRO CADASTRADO COM SUCESSO');
            location.href='cadLivro.php';
            </script>";
        } else {
            echo"<script>
            alert('ERRO AO SALVAR');
            location.href='cadLivro.php';
            </script>";
        }}else {
            echo "<script>
            alert('ERRO AO FAZER UPLOAD DA IMAGEM');
            location.href='cadLivro.php';
            </script>";
        }
?>