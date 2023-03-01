
<!DOCTYPE html>
<html lang="esp">
<head>
  <title>Gastos</title>
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
              <a class="dropdown-item" href="Listar_pro.php">Consultar productos</a>
              <a class="dropdown-item" href="Movimientos.php">Registrar Movimiento</a>
                
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Gestión Ventas
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="Venta.php">Registrar Venta</a>
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
<h3>REPORTAR GASTOS</h3>
    <form id="" name="Datos">
      <h4>GASTOS:</h4>
      <div class="row">
        <div class="col-sm-5">
          <div class="">
            <label for="usr">Descripción del Gasto:</label>
            <input type="text" class="form-control datoInput Limpiar" autocomplete = "off" name="gasto" id="gasto" placeholder ="Descripción del gasto">
        </div> 
        </div>
        <div class="col-sm-5">
        <div class="">
          <label for="usr">Valor del Gasto:</label>
          <input type="number" class="form-control datoInput Limpiar" name="valor" id="valor" placeholder ="Ingrese aqui el total gastado">
      </div> 
      </div>
      </div>
      <br>
    <div class="row">
      <div class="col-sm-6" style="text-align: center;">
        <br>  
        <button type="button" class="btn btn- btn-success" id="btn_guardar" name="btn_guardar" onclick="Guardar();">Registrar Gasto</button>
      </div>
    </div>
</form>
<script type="text/javascript">
    function Guardar() {
      var valor = document.getElementById("valor").value;
      var gasto = document.getElementById("gasto").value;
      //console.log(referencia);
      //console.log(cantidad);
      var datos = {
        "valor" : valor,
        "gasto" : gasto
      };
      $.ajax({
        type: 'POST',
        data:  datos,
        url:   'Guardar_Gastos.php',
        type:  'post',
        success:  function (response) {
         if(response == 1){
          Swal.fire({position: 'top-end', icon: 'success', title: 'Guardado correctamente.', showConfirmButton: false, timer: 1500 })
         }else{
           alert("no guardo");
         }
        }
      });
      };
  </script>
</body>
</html>
