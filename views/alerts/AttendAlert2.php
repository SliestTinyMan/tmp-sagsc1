<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="content/images/favicon.png">

  <title>Alerta Ciudadana</title>

    <!-- Bootstrap core CSS -->
    <link href="content/framework/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <style>
      #map {
        width:100%;
        height: 400px;
      }
      
      .inputa{
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
      }
      
      .w44{
          width: 44%;
      }
     
      #mapCanvas {
        width: 100%;
        height: 400px;
      }
      #infoPanel {
        width: 100%;
      }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4P5UMlmniwiJ1UkJ8lGM3ntZVwAjks8o"></script>
    <script type="text/javascript">
      var cmaplat;
      var cmaplng;
        var geocoder = new google.maps.Geocoder();

        function geocodePosition(pos) {
          geocoder.geocode({
            latLng: pos
          }, function(responses) {
            if (responses && responses.length > 0) {
              updateMarkerAddress(responses[0].formatted_address);
            } else {
              updateMarkerAddress('Cannot determine address at this location.');
            }
          });
        }

        function updateMarkerStatus(str) {
          document.getElementById('markerStatus').innerHTML = str;
        }

        function updateMarkerPosition(latLng) {
          document.getElementById('info').innerHTML = [
            latLng.lat(),
            latLng.lng()
          ].join(', ');
          cmaplat = latLng.lat();
          cmaplng = latLng.lng();
        }

        function updateMarkerAddress(str) {
          document.getElementById('address').innerHTML = str;
        }

        function initialize() {
          var latLng = new google.maps.LatLng(-12.079545305512537, -77.09299113244629);
          var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: 15,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          var marker = new google.maps.Marker({
            position: latLng,
            title: 'Point A',
            map: map,
            draggable: true
          });
          
          // Update current position info.
          updateMarkerPosition(latLng);
          geocodePosition(latLng);
          
          // Add dragging event listeners.
          google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Ubicando...');
          });
          
          google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('Moviendo...');
            updateMarkerPosition(marker.getPosition());
          });
          
          google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('Ubicado');
            geocodePosition(marker.getPosition());
          });
        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);

        
                function ajax_update() {
                    var dni = $( "#dni" ).val();
                    var nombre = $( "#nombre" ).val();
                    var telefono = $( "#telefono" ).val();
                    var sel1 = $( "#sel1" ).val();
                    var comment = $( "#comment" ).val();
                    
                    var parametros = {
                        'dni' : dni,
                        'nombre' : nombre,
                        'telefono' : telefono,
                        'sel1' : sel1,
                        'comment' : comment,
                        'cmaplat' : cmaplat,
                        'cmaplng' : cmaplng
                    };
                    $.ajax({
                        data:  parametros,
                        url:   '/?action=updalert2&tid=n92388g93r242873fgh329',
                        type:  'post',
                        beforeSend: function () {
                            $('#jumbotron').html('<h2>Procesando, espere un momento por favor...</h2>'); 
                                //console.log('Enviando');
                        },
                        success:  function (response) {
                            $('#jumbotron').html('<h2>Actualizando base de datos...</h2>'); 
                                //console.log('success');
                                
                        },
                        complete: function (data) {
                            //console.log(data.responseText);
                            alert('Alerta guardada correctamente');
                            window.location='/?action=alerts&tid=<?php echo $_SESSION['tid'];?>';                            
                        }
                    });
                }

            
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

 <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



  </head>

<body>

  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="#">SC Huaral</a>

        </div>
        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="?action=alerts&tid=<?php echo $_SESSION['tid']; ?>">Alertas</a></li>
            <li class="active"><a href="?action=nalert&tid=<?php echo $_SESSION['tid']; ?>">Nueva alerta</a></li>
            <!--<li><a href="#" onclick="alert('A&uacute;n hace falta m&aacute;s informaci&oactue;n.');">Partes</a></li>-->
            <li><a href="#" onclick="alert('Hace falta mayor cantidad de registros (alertas).');">Reportes</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Filtro<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?action=alerts1&tid=<?php echo $_SESSION['tid']; ?>">Seguridad</a></li>
                <li><a href="?action=alerts2&tid=<?php echo $_SESSION['tid']; ?>">Emergencias</a></li>
                <li><a href="?action=alerts3&tid=<?php echo $_SESSION['tid']; ?>">Servicios</a></li>
                <li><a href="?action=alerts4&tid=<?php echo $_SESSION['tid']; ?>">Otros</a></li>
                <li><a href="?action=alerts&tid=<?php echo $_SESSION['tid']; ?>">Ver todas</a></li>
              </ul>
            </li>
          </ul>

<!--            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="http://getbootstrap.com/examples/navbar/">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="http://getbootstrap.com/examples/navbar-static-top/">Static top</a></li>
              <li><a href="http://getbootstrap.com/examples/navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div>--><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    <div id="alertas">
      <?php echo $datos; ?>
    </div>

    </div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="content/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>