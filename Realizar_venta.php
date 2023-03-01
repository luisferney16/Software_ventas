<?php
include_once("config.php");
    date_default_timezone_set("America/Bogota");
    $data = json_decode($_POST['obj'], true);
    
    //echo($data[0]["referenciapro"]);
   $Total = 0;
   for($i=0; $i<count($data); ++$i){
    $precio1 = $data[$i]["preciopro"] * $data[$i]["cantidadpro"];
    $Total = $Total + $precio1;
    }
    $fecha = date("y.m.d");
    $tipofactura = $data[0]["tipoventapro"];
   $sql = "INSERT INTO mfactura(Total, Fecha, TipoFactura) VALUES('$Total', '$fecha','$tipofactura')";
    $result = $mysqli->query($sql);
    if($result){
        $sql2 = "SELECT MAX(IDFactura) FROM mfactura";
        $result2 = $mysqli->query($sql2);
        if (mysqli_num_rows($result2)>0){
            $row=mysqli_fetch_array($result2);
        for($i=0; $i<count($data); ++$i){
            $referencia = $data[$i]["referenciapro"];
            $producto = $data[$i]["productopro"];
            $cantidad = $data[$i]["cantidadpro"];
            $precio = $data[$i]["preciopro"];
            $stock = $data[$i]['Stock'];
            $sql3 = "INSERT INTO dfactura(IDProducto, IDmfactura, Precio, Cantidad, fecha, TipoFactura) VALUES('$referencia', ' $row[0]','$precio',' $cantidad','$fecha', '$tipofactura')";
            $result3 = $mysqli->query($sql3);
            $Nstock = $stock - $cantidad;
            $sql4 = "UPDATE productos SET Cantidad = '$Nstock' WHERE Referencia = '$referencia'";
            $result4 = $mysqli->query($sql4);
        }
        echo($result4);

        }
        }else{
        echo("No guardo");
         }
    
    
    /*
    $sql = "INSERT INTO mfactura(IDDetalleFactura, Total, Fecha) VALUES('1','$Total','2021-03-01')"
    $result = $mysqli->query($sql);
    if($result){
        echo("Guardado");
    }else{
        echo("No se guardo nada");
    }
    */
   
?>