<?php

session_start(); 

if (!isset($_SESSION['logado'])){
    echo "<script>
    alert('OPS, FAÇA LOGIN PARA CONTINUAR');
    location.href='../../frontend/form.html'
    </script>";
}

?>