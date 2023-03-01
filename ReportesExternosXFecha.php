<?php
include_once("config.php");
$fecInicio = $_POST['fechaInicio'];   
$fecFin = $_POST['fechaFin'];
$arreglo_php = array();
//echo($fecFin);
//$sql = "SELECT * FROM mfactura WHERE TipoFactura = 'Virtual' AND fecha BETWEEN '$fecInicio' AND '$fecFin'";
$sql = "SELECT productos.Producto AS pro, productos.Precio_Mayor AS precioMayor, Precio, dfactura.Cantidad, Fecha, TipoFactura FROM `dfactura` INNER JOIN productos ON dfactura.IDProducto = productos.Referencia AND dfactura.TipoFactura = 'Virtual' AND dfactura.Fecha BETWEEN '$fecInicio' AND '$fecFin'";

//$sql = "SELECT * FROM mfactura WHERE fecha BETWEEN '$fecInicio' AND '$fecFin'";
$result = $mysqli->query($sql);

$clientes = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $pro=$row['pro'];
    $Total=$row['Precio'];
    $Cantidad = $row['Cantidad'];
    $Fecha=$row['Fecha'];
    $TipoVenta = $row['TipoFactura'];
    $PrecioM = $row['precioMayor'];
    $arreglo_php[] = array('pro'=> $pro, 'total'=> $Total, 'precioMayor'=> $PrecioM,'cantidad'=> $Cantidad, 'fecha'=> $Fecha, 'tipoventa'=>$TipoVenta);
}
print_r(json_encode($arreglo_php));



?>