<?php
include_once("config.php");
    $valor = $_POST['valor'];
    $des = $_POST['gasto'];
    $fecha = date("y.m.d");
    $insertSQL = "INSERT INTO gastos (DescripcionG,ValorG, FechaG) VALUES ('$des','$valor','$fecha')";
    $result = $mysqli->query($insertSQL);
    echo($result);
?>
