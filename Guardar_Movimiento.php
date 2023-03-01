
<?php
include_once("config.php");
    $referencia = $_POST['referencia'];
    $cantidad = $_POST['cantidad'];
    $fecha = date("y.m.d");
    $insertSQL = "INSERT INTO movimientos (IDProducto, Cantidad, Fecha) VALUES ('$referencia','$cantidad','$fecha')";
    $result = $mysqli->query($insertSQL);
    if($result){
        $insertSQL2 = "UPDATE productos SET Cantidad = '$cantidad' WHERE Referencia = '$referencia'";
        $result2 = $mysqli->query($insertSQL2);
       echo($result);
    } 
?>
