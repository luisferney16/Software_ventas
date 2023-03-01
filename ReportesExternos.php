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
                        <div class="col-sm-4">
                        <br>
                        <input type="date" class="form-control " require autocomplete = "off" name="fecha1" id="fecha1" placeholder ="2021-03-02">
                        </div>
                        <div class="col-sm-4">
                        <br>
                        <input type="date" class="form-control " require autocomplete = "off" name="fecha2" id="fecha2" placeholder ="2021-03-02">
                        </div>
                        <div class="col-sm-4">
                        <br>
                        <button type="button" class="btn btn- btn-success" id="generarReporte" name="generarReporte">Generar Reporte</button>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">
                        <label for="Venta">Venta:</label>
                        <input style="background-color: ; color: black; font-size: 35px;" type="number" class="form-control " name="total" id="total" placeholder ="Total a Pagar" disabled>
                        </div>
                        <div class="col-sm-4">
                        <label for="Utilidad">Utilidad:</label>
                        <input style="background-color: ; color: black; font-size: 35px;" type="number" class="form-control " name="utilidad" id="utilidad" placeholder ="Total a Utilidad" disabled>
                        </div>
                    </div>
                    <br>
                    <table id="mytable" class="table table-dark">
                        <tr>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
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
        var utilidad =0;
        var fechaInicio = $("#fecha1").val();
        var fechaFin = $("#fecha2").val();
        
        $.ajax({
          method: "POST",
          url: "ReportesExternosXFecha.php",
          data:  {fechaInicio:fechaInicio, fechaFin:fechaFin },    
          success: function(data){
            console.log(data);
             var objeto = JSON.parse(data); 
             console.log(objeto);
             var i = 1;
             for(var i=0; i< objeto.length; ++i){
               var TotalF = objeto[i].cantidad * objeto[i].total;
               
              var fila = '<tr id="row' + i + '"><td>' + objeto[i].pro + '</td><td>' + objeto[i].cantidad + '</td><td>' + objeto[i].total + '</td><td>' + TotalF + '</td><td>' + objeto[i].fecha + '</td><td>' + objeto[i].tipoventa + '</td></tr>'; //esto seria lo que contendria la fila
              $('#mytable tr:first').after(fila);
              utilidad += TotalF - (objeto[i].cantidad * objeto[i].precioMayor);
              totalV = totalV + parseFloat(TotalF);
              //console.log(objeto[1].Id);
             }
            document.getElementById("total").value = totalV;
            document.getElementById("utilidad").value = utilidad;
         console.log(totalV);
          

        }      
      });
    }); 
</script>
<div class="container">

</div>
</body>
</html>
