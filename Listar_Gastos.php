

<!DOCTYPE html>
<html lang="esp">
<head>
    <title>Listar Gastos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<style>
  #div1 {
    overflow:scroll;
    height:400px;
    width:100%;
    color: green;
}
</style>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="index.html">DETROIT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Gestión Productos
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="Registrar_producto.php">Registrar Producto</a>
                <a class="dropdown-item" href="Consultar_producto.html">Consultar productos</a>
                <a class="dropdown-item" href="Movimientos.php">Registrar Movimiento</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Gestión Ventas
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="Venta.php">Realizar Venta</a>
            <a class="dropdown-item" href="Reportes.php">Ventas por Fecha</a>
              <a class="dropdown-item" href="Gastos.php">Registrar Gastos</a>
              <a class="dropdown-item" href="Listar_Gastos.php">Listar Gastos</a>
              <a class="dropdown-item" href="Relacion.php">Estado de Resultado</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Inventario
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Productos existentes</a>
              <a class="dropdown-item" href="#">stock</a>
            </div>
          </li>    
      
    </ul>
  </div>  
</nav>
<br>
<br><br>

<div class="container">
    <h3>LISTADO DE GASTOS</h3>
    <div class="cajas">
        <label for="usr">Ingrese Fecha:</label>
        <input type="date"  class="form-control" id="myInput" onkeyup="myFunction()" title="Type in a name">
    </div>                             
    <div id="div1">       
    <div class="table-responsive">          
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Descripción</th>
          <th>Valor</th>
          
        </tr>
      </thead>
      <tbody>
<?php
    include_once("config.php");
		$query="SELECT * FROM gastos";
		$productosc=mysqli_query($mysqli,$query);
		if (mysqli_num_rows($productosc)>0) {
			while ($row=mysqli_fetch_array($productosc)) {
                
                    echo "<tr>";
                        echo "<td>".$row['FechaG']."</td>";
                        echo "<td>".$row['DescripcionG']."</td>";
                        echo "<td>".$row['ValorG']."</td>";
                    echo "</tr>";   
                
			}
		}
		
 		mysqli_close($mysqli);
?>
    </tbody>
    </table>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    </div>
    </div>
  </div>
    </body>
    </html>