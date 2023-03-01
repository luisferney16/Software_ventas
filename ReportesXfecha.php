<?php
include_once("config.php");
$fecInicio = $_POST['fechaInicio'];   
$fecFin = $_POST['fechaFin'];
$arreglo_php = array();
//echo($fecFin);
$sql = "SELECT * FROM mfactura WHERE fecha BETWEEN '$fecInicio' AND '$fecFin'";
//$sql = "SELECT * FROM mfactura WHERE fecha BETWEEN '$fecInicio' AND '$fecFin'";
$result = $mysqli->query($sql);

$clientes = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id=$row['IDFactura'];
    $Total=$row['Total'];
    $Fecha=$row['Fecha'];
    $TipoVenta = $row['TipoFactura'];
    $arreglo_php[] = array('Id'=> $id, 'total'=> $Total, 'fecha'=> $Fecha, 'tipoventa'=>$TipoVenta);
}
print_r(json_encode($arreglo_php));



?>