<?php

session_start();

session_unset();

session_destroy();

echo"<script>
        alert('VOCÊ SAIU DO SISTEMA');
        location.href='../index.html'
    </script>";

?>