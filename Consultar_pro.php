<html>
<head>
<title>Guardar Producto</title>
</head>
<body>
<?php
include_once("config.php");
		$query="SELECT * FROM productos";
		$productosc=mysqli_query($mysqli,$query);
		if (mysqli_num_rows($productosc)>0) {
			while ($row=mysqli_fetch_array($productosc)) {
			echo "<tr>";
                        echo "<td>".$row['Referencia']."</td>";
                        echo "<td>".$row['Producto']."</td>";
                        echo "<td>".$row['Precio_Mayor']."</td>";
                        echo "<td>".$row['Proveedor']."</td>";
                        echo "<td>".$row['Foto']."</td>";
                       
			}
		}
		
 		mysqli_close($mysqli);
?>
</body>
</html>