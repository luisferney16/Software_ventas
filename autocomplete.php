<html>
<head>
<title>Guardar Producto</title>
</head>
<body>
<?php
include_once("config.php");

$sql = "SELECT Producto FROM productos ORDER BY Producto";
$res = $mysqli->query($sql);


$arreglo_php = array();
if(mysqli_num_rows($res) ==0){
    array_push($arreglo_php, "No hay datos");
}else{
    while($productos = $res->fetch_array(MYSQLI_ASSOC)){
        echo($productos["Producto"]);
        array_push($arreglo_php, $productos["Producto"]);
    }
}
?>
</body>
</html>