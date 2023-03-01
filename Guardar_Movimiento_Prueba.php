<?php

include_once("config.php");
    $referencia = $_POST['referencia'];
    $cantidad = $_POST['cantidad'];
    $fecha = '2021-02-02';
    $insertSQL = "INSERT INTO movimientos (IDProducto, Cantidad, Fecha) VALUES ('$referencia','$cantidad','$fecha')";
    $result = $mysqli->query($insertSQL);
    if($result){
        $insertSQL2 = "UPDATE productos SET Cantidad = '$cantidad' WHERE Referencia = '$referencia'";
        $result2 = $mysqli->query($insertSQL2);
        if($result2){
            print_r(json_encode($result2));
        }else{
            print_r("No se logró actualizar el producto");
        }
    } 
?>