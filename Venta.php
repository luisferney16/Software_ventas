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
   <script>
     var productos_compra;
     productos_compra = [];
     var total =0;
    function añadirproductos(){
      var objeto = {
        
          referenciapro : document.getElementById("referencia").value,
          productopro : document.getElementById("Producto").value,
          cantidadpro : document.getElementById("cantidad").value,
          Stock : document.getElementById("stock").value,
          preciopro : document.getElementById("Precio").value,
          tipoventapro : document.getElementById("tipoventa").value
       }
       if(document.getElementById("referencia").value == "" || document.getElementById("Producto").value == "" || document.getElementById("cantidad").value == "" || document.getElementById("Precio").value == ""){
        Swal.fire({position: 'top-end', icon: "warning", title: 'Los campos deben estar llenos.', showConfirmButton: false, timer: 1500 })
       }else if(parseInt(document.getElementById("stock").value) < document.getElementById("cantidad").value){
        Swal.fire({position: 'top-end', icon: "warning", title: 'Cantidad no valida.', showConfirmButton: false, timer: 1500 })
       }else if(parseFloat(document.getElementById("Precio").value) < parseFloat(PrecioMayor)  ){
        Swal.fire({position: 'top-end', icon: 'warning', title: 'Precio no valido.', showConfirmButton: false, timer: 1500 })
       }else{
        productos_compra.push(objeto);
       var i = 1;
       var fila = '<tr id="row' + i + '"><td>' + objeto.referenciapro + '</td><td>' + objeto.productopro + '</td><td>' + objeto.cantidadpro + '</td><td>' + objeto.preciopro + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Quitar</button></td></tr>'; //esto seria lo que contendria la fila
       $('#mytable tr:first').after(fila);
       var j =0; 
       var subtotal=0;
       subtotal = parseFloat(objeto.preciopro) * parseFloat(objeto.cantidadpro);
       total = total + subtotal;
       Swal.fire({position: 'top-end', icon: 'success', title: 'Añadido correctamente.', showConfirmButton: false, timer: 1500 })
       document.getElementById("total").value = total;
       }
       
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
    <h3>REALIZAR VENTA</h3>
    <form id="">
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
      <h4>DATOS DE FACTURA</h4>
    <div class="row">
      <div class="col-sm-4">
        <div class="">
          <label for="usr">Cantidad:</label>
          <input type="number" class="form-control datoInput Limpiar" name="cantidad" id="cantidad" placeholder ="Unidades a vender">
      </div> 
      </div>
      <div class="col-sm-4">
        <div class="">
          <label for="usr">Precio:</label>
          <input type="number" class="form-control datoInput Limpiar" name="Precio" id="Precio" placeholder ="Precio de venta">
        </div> 
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="sel1">Tipo de Venta:</label>
          <select class="form-control" id="tipoventa">
            <option>Presencial</option>
            <option>Virtual</option>
          </select>
        </div>
        <button type="button" style="width: 50%; text-align: center;" class="btn btn-danger" id="añadir" name="añadir" onclick = "añadirproductos();">AÑADIR</button>
      </div>
    </div>
    <br>  
        
</form>
<div class="container">
  <h4>PRODUCTOS PARA COMPRA</h4>     
  <table id="mytable" class="table table-dark">
    
      <tr>
        <th>Referencia</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Eliminar</th>
      </tr>
  
  </table>
  <div class="row">
    <div class="col-sm-4">
      <div class="">
        <input style="background-color: darkgrey; color: white; font-size: 20px;" type="number" class="form-control " name="total" id="total" placeholder ="Total a Pagar">
      </div> 
    </div>
    <div class="col-sm-4">
      <button type="submit" class="btn btn- btn-success" id="Comprar" name="Comprar" onclick="Guardar();">REALIZAR COMPRA</button>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#añadir').click(function() {
                $('.Limpiar').val('');
            });
        });

        // Obtenemos una referencia al elemento
      const $elemento = document.querySelector("#mytable");
      // El botón solo es para la demostración
      const $btnLimpiar = document.querySelector("#Comprar");
      // Y en el click, limpiamos
      $btnLimpiar.addEventListener("click", () => {
          $elemento.innerHTML = "";
      });

    var obj ={};
    function Guardar(){
    obj= JSON.stringify(productos_compra);
    $.ajax({
      type: "POST",
      url: "Realizar_venta.php",
      data:{obj:  obj},
      success:function(server){
        if(server == 1){
          Swal.fire({position: 'top-end', icon: 'success', title: 'Se registró la factura con exito.', showConfirmButton: false, timer: 1500 })
        }else{
          alert("Se ha producido un error");
        }
      }
    });
    }
    </script>
</body>
</html>
