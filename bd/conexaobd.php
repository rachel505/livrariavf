<?php

$conn = mysqli_connect("localhost", "root", "");

if ($conn) {
    mysqli_select_db($conn, "livrariavf");
} else {
    die("FALHA AO CONECTAR-SE");
}

?>