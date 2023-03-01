<?php
include_once("config.php");
    $buscarreferencia = "SELECT * FROM productos WHERE Referencia = '$_POST[referencia]' ";
    $result = $mysqli->query($buscarreferencia);
    $count = mysqli_num_rows($result);
    
    if($count == 1){
        echo('2');
    }else{
        $query = "INSERT INTO  productos (Referencia,Producto,Precio_Mayor,Cantidad,Proveedor) VALUES ('$_POST[referencia]','$_POST[Producto]','$_POST[Precio_Mayor]',0,'$_POST[Proveedor]')";
        $result2 = $mysqli->query($query);
        echo($result2);
    }
    
mysqli_close($mysqli);
?>