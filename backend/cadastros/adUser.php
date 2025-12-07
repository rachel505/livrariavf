<?php
require('../../bd/conexaobd.php');
require('../../backend/verificaLogado.php');


$nome = mb_strtoupper($_POST['nome']);
$email = mb_strtoupper($_POST['email']);

$sql = "INSERT INTO usuario (nome, email)
        VALUES ('$nome', '$email')";

        if ( mysqli_query($conn, $sql) ) {
            echo"<script>
            alert('USUARIO CADASTRADO COM SUCESSO');
            location.href='cadUser.php';
            </script>";
        } else {
            echo"<script>
            alert('ERRO AO SALVAR');
            location.href='cadUser.php';
            </script>";
        }
?>