<!DOCTYPE html>
<html lang="esp">
<head>
  <title>Venta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="estilos.css">

  
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="#">DETROIT</a>
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
              <a class="dropdown-item" href="Listar_pro.php">Consultar productos</a>
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
    <h3>REPORTE DE VENTAS</h3>

    <div class="card text-white bg-primary mb-3" style="max-width: 70rem;">
                <div class="card-header" style="text-align: center;">
                    <h4>    Ventas por día:</h4>
                </div>
                <div class="card-body">
                    <div class ="row">
                        <div class="col-sm-3">
                        <br>
                        <input type="date" class="form-control " require autocomplete = "off" name="fecha1" id="fecha1" placeholder ="2021-03-02">
                        </div>
                        <div class="col-sm-3">
                        <br>
                        <input type="date" class="form-control " require autocomplete = "off" name="fecha2" id="fecha2" placeholder ="2021-03-02">
                        </div>
                        <div class="col-sm-2">
                        <br>
                        <button type="button" class="btn btn- btn-success" id="generarReporte" name="generarReporte">Generar Reporte</button>
                        </div>
                        <div class="col-sm-3">
                        <input style="background-color: ; color: black; font-size: 35px;" type="number" class="form-control " name="total" id="total" placeholder ="Total a Pagar" disabled>
                        </div>
                    </div>
                    <br>
                    <table id="mytable" class="table table-dark">
                        <tr>
                          <th>Referencia</th>
                          <th>Total</th>
                          <th>Fecha</th>
                          <th>Tipo Venta</th>
                        </tr>
                    </table>
                </div>

                <br>
   </div>
</div>
<script>
    $("#generarReporte").click(function(){   
        var vector =[];
        var totalV=0;
        var fechaInicio = $("#fecha1").val();
        var fechaFin = $("#fecha2").val();
        
        $.ajax({
          method: "POST",
          url: "ReportesXfecha.php",
          data:  {fechaInicio:fechaInicio, fechaFin:fechaFin },    
          success: function(data){
            
             var objeto = JSON.parse(data); 
             var i = 1;
             for(var i=0; i< objeto.length; ++i){ 
              var fila = '<tr id="row' + i + '"><td>' + objeto[i].Id + '</td><td>' + objeto[i].total + '</td><td>' + objeto[i].fecha + '</td><td>' + objeto[i].tipoventa + '</td></tr>'; //esto seria lo que contendria la fila
              $('#mytable tr:first').after(fila);
              totalV = totalV + parseFloat(objeto[i].total);
              console.log(objeto[1].Id);
             }
            document.getElementById("total").value = totalV;
         console.log(totalV);
          

        }      
      });
    }); 
</script>
<div class="container">

</div>
</body>
</html>
