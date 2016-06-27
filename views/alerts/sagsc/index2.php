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

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <style>
        body {
          background: url(../content/images/bg.jpg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
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
          height: 90%;
        }
        #infoPanel {
          width: 100%;
        }
        
        .row {
          width:100%;
          height:100%;
        }
        
        .col-md-3 {
          padding-left: 0 !important;
          padding-right: 0 !important;
          background-color:#4B4B4D;
          height: 96.7%;
          -webkit-box-shadow: 2px 2px 36px 0px rgba(0,0,0,0.75);
          -moz-box-shadow: 2px 2px 36px 0px rgba(0,0,0,0.75);
          box-shadow: 2px 2px 36px 0px rgba(0,0,0,0.75);
        }
        .col-md-9 {
          padding-left: 0 !important;
          padding-right: 0 !important;
          background-color:#0089CC;
          color:#fff;
          -webkit-box-shadow: 13px 2px 36px 0px rgba(0,0,0,0.75);
          -moz-box-shadow: 13px 2px 36px 0px rgba(0,0,0,0.75);
          box-shadow: 13px 2px 36px 0px rgba(0,0,0,0.75);
        }
        
        .menu {
          width:100%;
          padding:1px;
          border:1px solid #021a40 !important;
          cursor: pointer;
        }
        
      </style>

<!--<script language="JavaScript">
  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "Recuerde presionar Salir en el menú para salir.";
  }
</script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

<body>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="content/images/logo2.jpg" style="width:30%;" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="?action=quit&tid=<?php echo $_SESSION['tid']; ?>">Salir</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <div class="container">
      <div style="height:4em;"></div>
      <?php echo $chtml; ?>
   </div> 
 <!-- <div class="row">
    <div class="col-md-3">
      <img src="content/images/logo.jpg" style="width: 100%;" />
      <img src="content/images/m1.jpg" class="menu" onmouseover="this.src='content/images/m1a.jpg'" onmouseout="this.src='content/images/m1.jpg'" />
      <img src="content/images/m2.jpg" class="menu" onmouseover="this.src='content/images/m2a.jpg'" onmouseout="this.src='content/images/m2.jpg'" />
      <!--<img src="content/images/m3.jpg" style="width: 100%;" onmouseover="this.src='content/images/m3a.jpg'" onmouseout="this.src='content/images/m3.jpg'" />
      <img src="content/images/m4.jpg" style="width: 100%;" onmouseover="this.src='content/images/m4a.jpg'" onmouseout="this.src='content/images/m4.jpg'" />
    </div>
    <div class="col-md-9">
      <div id='mapCanvas'></div>
      <div id='infoPanel' style='padding-left: 0.5%;'>
        <div id='markerStatus'>Ubicado</div>
        <div id='info'></div> 
        <div id='address'></div>
      </div>  
    </div>
  </div> -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="content/js/ie10-viewport-bug-workaround.js"></script>
    
</body>
</html>