<?php 

    $pchtml = explode(",", $chtml);

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Consumo diario', 'Revenue'],
          ['<?php echo $pchtml[0]; ?>', <?php echo $pchtml[1]; ?>],
          ['<?php echo $pchtml[2]; ?>', <?php echo $pchtml[3]; ?>],
          ['<?php echo $pchtml[4]; ?>', <?php echo $pchtml[5]; ?>],
          ['<?php echo $pchtml[6]; ?>', <?php echo $pchtml[7]; ?>],
          ['<?php echo $pchtml[8]; ?>', <?php echo $pchtml[9]; ?>],
          ['<?php echo $pchtml[10]; ?>', <?php echo $pchtml[11]; ?>],
          ['<?php echo $pchtml[12]; ?>', <?php echo $pchtml[13]; ?>],
          ['<?php echo $pchtml[14]; ?>', <?php echo $pchtml[15]; ?>],
          ['<?php echo $pchtml[16]; ?>', <?php echo $pchtml[17]; ?>],
          ['<?php echo $pchtml[18]; ?>', <?php echo $pchtml[19]; ?>],
          ['<?php echo $pchtml[20]; ?>', <?php echo $pchtml[21]; ?>],
          ['<?php echo $pchtml[22]; ?>', <?php echo $pchtml[23]; ?>],
          ['<?php echo $pchtml[24]; ?>', <?php echo $pchtml[25]; ?>],
          ['<?php echo $pchtml[26]; ?>', <?php echo $pchtml[27]; ?>],
          ['<?php echo $pchtml[28]; ?>', <?php echo $pchtml[29]; ?>],
        ]);

        var options = {
          chart: {
            title: 'RESELLER : <?php echo $res; ?>',
            subtitle: 'Consumo de \u00faltimos 15 d\u00edas',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
      
    </script>
  </head>
  <body>
        <table>
            <tr>
                <td><a href='?action=menu&tid=<?php echo $_SESSION['tid']; ?>'><< REGRESAR</a></td>
            </tr>
            <tr>
                <td><div id="columnchart_material" style="width: 900px; height: 500px;">Calculando, espere un momento por favor...</div></td>
            </tr>
        </table>
  </body>
</html>