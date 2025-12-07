<?php
require('../../bd/conexaobd.php');
require('../../backend/verificaLogado.php');

$categoria = mb_strtoupper($_POST['categoria']);

$sql = "INSERT INTO categoria (categoria)
        VALUES ('$categoria')";

        if ( mysqli_query($conn, $sql) ) {
            echo"<script>
            alert('CATEGORIA CADASTRADA COM SUCESSO');
            location.href='cadCateg.php';
            </script>";
        } else {
            echo"<script>
            alert('ERRO AO SALVAR');
            location.href='cadCateg.php';
            </script>";
        }
?>