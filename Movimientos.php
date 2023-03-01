<?php
include_once("config.php");
$sql = "SELECT Referencia FROM productos ORDER BY Referencia";
$res = $mysqli->query($sql);

$arreglo_php = array();
if(mysqli_num_rows($res) ==0){
    array_push($arreglo_php, "No hay datos");
}else{
    while($productos = $res->fetch_array(MYSQLI_ASSOC)){
        array_push($arreglo_php, $productos["Referencia"]);
    }
}
$sql2 = "SELECT * FROM productos";
$res2 = $mysqli->query($sql2);

if(mysqli_num_rows($res2) ==0){
  array_push($arreglo_producto, "No hay datos");
}else{
  while($row = $res2->fetch_array())
  {
    $arreglo_producto[] = $row;
  }
  //echo "<script>alert('". $arreglo_producto ."');</script>";
}

?>
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

  <script>
    var vec_pro;
    $(function(){
      vec_pro =[];
      <?php
        for($p = 0; $p < count($arreglo_php); $p++){
          ?>
            vec_pro.push('<?php echo $arreglo_php[$p]?>');
      <?php } ?>
        $("#referencia").autocomplete({
            source: vec_pro
        });
        });
  </script>

  <script>
    var vec_productos;
    $(function(){
      vec_productos =[];
      vec_productos = <?php echo json_encode($arreglo_producto); ?>;
      
    });

  </script>
  <script>
    var PrecioMayor=0;
    function autollenar(){
      var referencia = document.getElementById("referencia").value;
      const resultado = vec_productos.find( x => x.Referencia === referencia);
      document.getElementById("referencia").value = resultado.Referencia;
      document.getElementById("Producto").value = resultado.Producto;
      document.getElementById("stock").value = resultado.Cantidad;
      PrecioMayor = resultado.Precio_Mayor;
    }
  </script>



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
              <a class="dropdown-item" href="#">Dash Board</a>
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
<h3>REALIZAR MOVIMIENTO DE PRODUCTOS</h3>
    <form id="" name="Datos">
      <h4>DATOS DEL PRODUCTO</h4>
      <div class="row">
        <div class="col-sm-4">
          <div class="">
            <label for="usr">Referencia:</label>
            <input type="text" class="form-control datoInput Limpiar" autocomplete = "off" name="referencia" id="referencia" placeholder ="Referencia del producto" onchange="autollenar();">
        </div> 
        </div>
        <div class="col-sm-4">
          <div class="">
            <label for="usr">Producto:</label>
            <input type="text" class="form-control datoInput Limpiar" name="Producto" id="Producto"  placeholder ="Nombre del producto" disabled>
        </div> 
        </div>
        <div class="col-sm-4">
          <div class="">
            <label for="usr">Stock:</label>
            <input type="number" class="form-control Limpiar" name="stock" id="stock"  placeholder ="Unidades disponibles" disabled>
        </div> 
        </div>
        
      </div>
      <br>
    <div class="row">
      <div class="col-sm-4">
        <div class="">
          <label for="usr">Cantidad a ingresar a bodega:</label>
          <input type="number" class="form-control datoInput Limpiar" name="cantidad" id="cantidad" placeholder ="Unidades a comprar">
      </div> 
      </div>
      
      <div class="col-sm-4">
        <br>  
        <button type="button" class="btn btn- btn-success" id="btn_guardar" name="btn_guardar" onclick="Guardar();">Registrar Movimiento</button>
        <button type="button" id="btn_guardar" class="btn btn- btn-success" name="btn_guardar" onclick="Guardar2()">Guardar</button>
      </div>
    </div>
</form>
<script type="text/javascript">
    function Guardar() {
      var referencia = document.getElementById("referencia").value;
      var cantidad = document.getElementById("cantidad").value;
      //console.log(referencia);
      //console.log(cantidad);
      var datos = {
        "referencia" : referencia,
        "cantidad" : cantidad
      };
      $.ajax({
        type: 'POST',
        data:  datos,
        url:   'Guardar_Movimiento.php',
        type:  'post',
        success:  function (response) {
         if(response == 1){
          alert("guardado");
         }else{
           alert("no guardo");
         }
        }
      });
      };
  </script>
</body>
</html>
