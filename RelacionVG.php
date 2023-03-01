<?php
include_once("config.php");
$fecInicio = $_POST['fechaInicio'];   
$fecFin = $_POST['fechaFin'];
$arreglo_php = array();
//echo($fecFin);
$sql = "SELECT * FROM mfactura WHERE fecha BETWEEN '$fecInicio' AND '$fecFin'";
$sql2 = "SELECT * FROM gastos WHERE FechaG BETWEEN '$fecInicio' AND '$fecFin'";
//$sql = "SELECT * FROM mfactura WHERE fecha BETWEEN '$fecInicio' AND '$fecFin'";
$result = $mysqli->query($sql);
$result2 = $mysqli->query($sql2);
$clientes = array(); //creamos un array
$TotalV =0;
$TotalG =0;
while($row = mysqli_fetch_array($result)) 
{ 
    
    $TotalV =$row['Total'] + $TotalV;
    //$arreglo_php[] = array();
}
while ($row = mysqli_fetch_array($result2)) {
  # code...
  $TotalG =$row['ValorG'] + $TotalG;
  
}
$arreglo_php[] = array('totalV'=> $TotalV,'totalG'=> $TotalG);
print_r(json_encode($arreglo_php));



?>