var latitud;
var longitud;
var datos_enviados = 0;

function enviar_alerta(boton){

  if (datos_enviados == 0) {
    datos_enviados = 1;
     var documento = "67584930";
     var latitud= "-12.0924666";
     var longitud= "-77.0812727";

     $.ajax({
       type: 'POST',
       data: 'documento='+documento+'&alerta=1'+'&latitud='+latitud+'&longitud='+longitud,
       url: 'http://alertasanmiguel.tecnicom.pe/scripts/reg_13102039.php',
     success: function(data){
        alert("Alerta enviada, nos comunicaremos en breve");
        //window.location.href = 'http://alertasanmiguel.tecnicom.pe';
     },
     error: function(data){
       alert('error_');
     }
     });
  }
}
