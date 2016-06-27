<?php

class AlertModel
{
    private $db;

    public function __construct()
    {
        $adb=new mysqli('intranet.tecnicom.pe:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
        //$this->db=new mysqli('db-sag-sc1.cam4laqbbkeo.us-east-1.rds.amazonaws.com:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
        $this->db->query("SET NAMES 'utf8'");

        if ($this->db->connect_errno)
        {
    		echo "<script>console.log('Fallo al conectar a MySQL: ".$this->db->connect_errno.", ".$this->db->connect_error."');</script>";
		}
		//echo "<script>console.log('".$this->db->host_info."');</script>";
    }

    public function ObtenerAlertas($fecha,$estado){

        $counter = 0;

        $chtml="";

        $sql = "SELECT * FROM alertas WHERE (ATENDIDO='".$estado."' AND FECHA='".$fecha."')ORDER BY ID DESC";
        $results=$this->db->query($sql);

        // Construir contenido de lista de alertas (HTML) en base a fecha obtenida
        while($row = $results->fetch_assoc()) {

            $sql2 = "SELECT * FROM usuarios WHERE DOCUMENTO = '".$row['USUARIO']."' ORDER BY ID ASC";
            $results2=$this->db->query($sql2);
            $row2 = $results2->fetch_assoc();

            $counter = $counter + 1;
                $chtml = $chtml."
                <div class='jumbotron' style='background-color: rgba(255, 255, 255, 0.7); color: rgba(255, 255, 255, 0.7);'>
                    <p><kbd>USUARIO(DNI): ".$row['USUARIO']."</kbd></p>
                    <p><code>NOMBRE: ".$row2['NOMBRE']."</code></p>
                    <p class='text-info'>ENVIADO A LAS ".$row['HORA']." HRS</p>
                    <p><a class='btn btn-lg btn-primary' href='?action=attend&tid=".$_SESSION['tid']."&l=".$row['ID']."' role='button'>Atender »</a></p>
                </div>";

        }

        if ($counter > 0)
        {
            if ($counter > $_SESSION['alerts'] || $counter > 0)
            {
                $chtml =  $chtml."<script>var audio = new Audio('content/audio/alarm1.wav');audio.play();$('body').css('background', \"url('../content/images/alert.gif')\");</script>";
                $_SESSION['alerts']  = $counter;
            }else{
                $_SESSION['alerts']  = $counter;
            }
        }
        return $chtml;
    }

    public function AtenderAlerta($id){

        $chtml="";

        $sql = "SELECT * FROM alertas WHERE ID='".$id."'";
        $results = $this->db->query($sql);
        $row = $results->fetch_assoc();

        $sql1 = "SELECT * FROM usuarios WHERE DOCUMENTO='".$row['USUARIO']."' ORDER BY ID DESC";
        $results1 = $this->db->query($sql1);
        $row1 = $results1->fetch_assoc();

        $chtml = $chtml."
            <div class='jumbotron'>
                <table style='width:100%;'>
                <tr>
                    <td style='width:50%;'>
                    <p><kbd>USUARIO(DNI): <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='dni' value='".$row['USUARIO']."'></kbd></p>
                    <p class='text-info'>NOMBRE: <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='nombre' value='".$row1['NOMBRE']."'></p>
                    <p class='text-info'>TELÉFONO: <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='telefono' value='".$row1['TELEFONO']."'></p>
                    <p><code>TIPO DE ALERTA: SERENAZGO</code></p>
                    <p class='text-info'>ENVIADO A LAS ".$row['HORA']." HRS <button id='derivar' type='button' class='btn btn-success' onclick='ajax_derivar();'> DERIVAR</button></p>
                    </td>
                    <td style='width:50%;'>
                    <div class='form-group'>
                        <label for='sel1'>Evento:</label>
                        <select class='form-control' id='sel1'>
                        <option value='101'>ACCIDENTE DE TRANSITO</option>
                        <option value='102'>ACTOS OBSCENOS</option>
                        <option value='103'>AGRESION FISICA / VIOLENCIA FAMILIAR</option>
                        <option value='104'>ALTERACION AL ORDEN PUBLICO</option>
                        <option value='105'>ANIEGO / TUBERIA ROTA</option>
                        <option value='106'>APOYO DE INCENDIOS</option>
                        <option value='107'>ASALTOS / DISPAROS</option>
                        <option value='108'>AUXILIO MEDICO</option>
                        <option value='109'>BULLICIOS</option>
                        <option value='110'>COMERCIO AMBULATORIO</option>
                        <option value='111'>CORTO CIRCUITO / CABLE CAIDO</option>
                        <option value='112'>DROGADICTOS</option>
                        <option value='113'>ERRADICACION DE ESCOLARES</option>
                        <option value='114'>ERRADICACION DE HOMOSEXUALES Y MERETRICES</option>
                        <option value='115'>ERRADICACION DE PANDILLEROS / GRESCA</option>
                        <option value='116'>ERRADICACION DE PERSONAS LIBANDO LICOR</option>
                        <option value='117'>EXTRAVIADOS</option>
                        <option value='118'>INTENTO DE SUICIDIO</option>
                        <option value='119'>INTERVENCION A PERSONAS SOSPECHOSAS</option>
                        <option value='120'>INTERVENCION A VEHICULOS SOSPECHOSOS</option>
                        <option value='121'>MATERIAL DE CONSTRUCCION / LLENADO DE TECHO</option>
                        <option value='122'>OPERATIVOS</option>
                        <option value='123'>ORATES</option>
                        <option value='124'>PEGADO DE AFICHES / BANNERS / ESTRADOS</option>
                        <option value='125'>PERSECUCION A VEHICULOS</option>
                        <option value='126'>QUEMA DE BASURA / DESMONTE</option>
                        <option value='127'>ROBO AL PASO</option>
                        <option value='128'>ROBOS FRUSTRADOS</option>
                        <option value='129'>SUJETO INCONSCIENTE</option>
                        <option value='130'>SUJETOS EBRIOS</option>
                        <option value='131'>TRASLADO DE PRESUNTOS</option>
                        <option value='132'>VEHICULOS DESMANTELADOS</option>
                        <option value='133'>VEHICULOS RECUPERADOS</option>
                        <option value='134'>VICTIMA DE EXTORSIÓN Y ATENTADOS</option>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='comment'>Detalle:</label>
                        <textarea class='form-control' rows='5' id='comment'></textarea>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                    <div id='mapCanvas'></div>
                      <div id='infoPanel'>
                        <div id='markerStatus'>Ubicado</div>
                        <div id='info'></div>
                        <div id='address'></div>
                      </div>
                    </td>
                </tr>

                <tr>
                    <td colspan='2' style='text-align:center;'>
                    <br>
                    <button type='button' class='btn btn-success' onclick='ajax_update();'>Atendido</button>
                    </td>
                </tr>

                </table>
            </div>
            </div>";

        if ($row['LATITUD']=='undefined'){
            $latitud = '-12.045694146170797';
        }else{
            $latitud=$row['LATITUD'];
        }
        if ($row['LONGITUD']=='undefined'){
            $longitud = '-77.042730570105';
        }else{
            $longitud=$row['LONGITUD'];
        }
        return $chtml."!".$latitud."!".$longitud."!".$row1['NOMBRE'];

        echo "<script>
                ventana = window.open('sip:51".$row1['TELEFONO']."');
                ventana.close();
            </script>";
    }

    public function AtenderAlertaD($id){

        $chtml="";

        $sql = "SELECT * FROM alertas WHERE ID='".$id."'";
        $results = $this->db->query($sql);
        $row = $results->fetch_assoc();

        $sql1 = "SELECT * FROM usuarios WHERE DOCUMENTO='".$row['USUARIO']."' ORDER BY ID DESC";
        $results1 = $this->db->query($sql1);
        $row1 = $results1->fetch_assoc();

        $chtml = $chtml."
            <div class='jumbotron'>
                <table style='width:100%;'>
                <tr>
                    <td style='width:50%;'>
                    <p><kbd>USUARIO(DNI): ".$row['USUARIO']."</kbd></p>
                    <p class='text-info'>NOMBRE: ".$row1['NOMBRE']."</p>
                    <p class='text-info'>TELÉFONO: ".$row1['TELEFONO']."</p>
                    <p><code>TIPO DE ALERTA: SERENAZGO</code></p>
                    <p class='text-info'>ENVIADO A LAS ".$row['HORA']." HRS </p>
                    </td>
                    <td style='width:50%;'>
                    <div class='form-group'>
                        <label for='sel1'>Evento:</label>
                        <select class='form-control' id='sel1'>
                        <option value='101'>ACCIDENTE DE TRANSITO</option>
                        <option value='102'>ACTOS OBSCENOS</option>
                        <option value='103'>AGRESION FISICA / VIOLENCIA FAMILIAR</option>
                        <option value='104'>ALTERACION AL ORDEN PUBLICO</option>
                        <option value='105'>ANIEGO / TUBERIA ROTA</option>
                        <option value='106'>APOYO DE INCENDIOS</option>
                        <option value='107'>ASALTOS / DISPAROS</option>
                        <option value='108'>AUXILIO MEDICO</option>
                        <option value='109'>BULLICIOS</option>
                        <option value='110'>COMERCIO AMBULATORIO</option>
                        <option value='111'>CORTO CIRCUITO / CABLE CAIDO</option>
                        <option value='112'>DROGADICTOS</option>
                        <option value='113'>ERRADICACION DE ESCOLARES</option>
                        <option value='114'>ERRADICACION DE HOMOSEXUALES Y MERETRICES</option>
                        <option value='115'>ERRADICACION DE PANDILLEROS / GRESCA</option>
                        <option value='116'>ERRADICACION DE PERSONAS LIBANDO LICOR</option>
                        <option value='117'>EXTRAVIADOS</option>
                        <option value='118'>INTENTO DE SUICIDIO</option>
                        <option value='119'>INTERVENCION A PERSONAS SOSPECHOSAS</option>
                        <option value='120'>INTERVENCION A VEHICULOS SOSPECHOSOS</option>
                        <option value='121'>MATERIAL DE CONSTRUCCION / LLENADO DE TECHO</option>
                        <option value='122'>OPERATIVOS</option>
                        <option value='123'>ORATES</option>
                        <option value='124'>PEGADO DE AFICHES / BANNERS / ESTRADOS</option>
                        <option value='125'>PERSECUCION A VEHICULOS</option>
                        <option value='126'>QUEMA DE BASURA / DESMONTE</option>
                        <option value='127'>ROBO AL PASO</option>
                        <option value='128'>ROBOS FRUSTRADOS</option>
                        <option value='129'>SUJETO INCONSCIENTE</option>
                        <option value='130'>SUJETOS EBRIOS</option>
                        <option value='131'>TRASLADO DE PRESUNTOS</option>
                        <option value='132'>VEHICULOS DESMANTELADOS</option>
                        <option value='133'>VEHICULOS RECUPERADOS</option>
                        <option value='134'>VICTIMA DE EXTORSIÓN Y ATENTADOS</option>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='comment'>Detalle:</label>
                        <textarea class='form-control' rows='5' id='comment'></textarea>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                    <div id='mapCanvas'></div>
                      <div id='infoPanel'>
                        <div id='markerStatus'>Ubicado</div>
                        <div id='info'></div>
                        <div id='address'></div>
                      </div>
                    </td>
                </tr>

                <tr>
                    <td colspan='2' style='text-align:center;'>
                    <br>
                    <button type='button' class='btn btn-success' onclick='ajax_update();'>Atendido</button>
                    </td>
                </tr>

                </table>
            </div>
            </div>";

        if ($row['LATITUD']=='undefined'){
            $latitud = '-12.045694146170797';
        }else{
            $latitud=$row['LATITUD'];
        }
        if ($row['LONGITUD']=='undefined'){
            $longitud = '-77.042730570105';
        }else{
            $longitud=$row['LONGITUD'];
        }
        return $chtml."!".$latitud."!".$longitud."!".$row1['NOMBRE'];

        echo "<script>
                ventana = window.open('sip:51".$row1['TELEFONO']."');
                ventana.close();
            </script>";
    }

    public function UpdateAlert($dni, $n, $t, $s, $c, $id, $lat, $lng)
    {
        $sql = "UPDATE alertas SET USUARIO='".$dni."',EVENTO='".$s."',DETALLE='".$c."', ATENDIDO='SI', LATITUD='".$lat."',LONGITUD='".$lng."' WHERE ID='".$id."'";
        //echo "<script>console.log('".$id."')</script>";
        $this->db->query($sql);
        //$ldg = "1";
        $sql2 = "UPDATE usuarios SET NOMBRE='".$n."',TELEFONO='".$t."' WHERE DOCUMENTO='".$dni."'";
        $this->db->query($sql2);
        //$ldg = "1+2";
        //return $ldg;
    }

    public function UpdateAlert2($dni, $n, $t, $s, $c, $lat, $lng)
    {
        $hora = date('H').":".date('i');
        $fecha = date("d")."/".date("m")."/2016";
        $sql = "INSERT INTO alertas (USUARIO, EVENTO, DETALLE, ATENDIDO, LATITUD, LONGITUD, HORA, FECHA, CATEGORIA) VALUES ('".$dni."', '".$s."', '".$c."', 'SI', '".$lat."', '".$lng."', '".$hora."', '".$fecha."', '1')";
        //echo "<script>console.log('".$id."')</script>";
        $this->db->query($sql);

        $sql2 = "INSERT INTO usuarios (NOMBRE, DOCUMENTO, TELEFONO) VALUES ('".$n."', '".$dni."', '".$t."')";
        $this->db->query($sql2);

        //$ldg = "1";
       /* $sql3 = "SELECT * FROM usuarios WHERE DOCUMENTO = '".$dni."'";
    	$results = $this->db->query($sql3);

        if ($results->num_rows > 0)
        {
            return ".";
        }
        else
        {
            $sql2 = "INSERT INTO usuarios (NOMBRE, DOCUMENTO, TELEFONO) VALUES ('".$n."', '".$dni."', '".$t."')";
            $this->db->query($sql2);
        }*/

        //$ldg = "1+2";
        //return $ldg;
    }

    public function VerifyAlertList($a)
    {
        $sql = "SELECT * FROM Login_Users WHERE Agent='".$a."'";
        $results = $this->db->query($sql);
        $row = $results->fetch_assoc();
        return $row['UpdateList'];
    }

    public function NUA($a, $b)
    {
        $sql = "INSERT INTO derivados (AGENT, ALERT) VALUES ('".$a."', '".$b."')";
        $this->db->query($sql);
        $sql2 = "UPDATE Login_Users SET UpdateList='1' WHERE User='tecnicom101'";
        $this->db->query($sql2);
    }

    public function ObtenerAlertasD(){

        $counter = 0;

        $chtml="";

        $sql = "SELECT * FROM derivados ORDER BY ID ASC";
        $results=$this->db->query($sql);

        while($row = $results->fetch_assoc()) {

            $sql2 = "SELECT * FROM alertas WHERE ID = '".$row['ALERT']."' ORDER BY ID ASC";
            $results2=$this->db->query($sql2);
            $row2 = $results2->fetch_assoc();

            $sql3 = "SELECT * FROM usuarios WHERE DOCUMENTO = '".$row2['USUARIO']."' ORDER BY ID ASC";
            $results3=$this->db->query($sql3);
            $row3 = $results3->fetch_assoc();

            $counter = $counter + 1;
                $chtml = $chtml."
                <div class='jumbotron' style='background-color: rgba(255, 255, 255, 0.7); color: rgba(255, 255, 255, 0.7);'>
                    <p><kbd>USUARIO(DNI): ".$row2['USUARIO']."</kbd></p>
                    <p><code>NOMBRE: ".$row3['NOMBRE']."</code></p>
                    <p class='text-info'>ENVIADO A LAS ".$row2['HORA']." HRS</p>
                    <p><a class='btn btn-lg btn-primary' href='?action=attend2&tid=".$_SESSION['tid']."&l=".$row2['ID']."' role='button'>Atender »</a></p>
                </div>";

        }

        if ($counter > 0)
        {
            if ($counter > $_SESSION['alerts'] || $counter > 0)
            {
                $chtml =  $chtml."<script>var audio = new Audio('content/audio/alarm1.wav');audio.play();$('body').css('background', \"url('../content/images/alert.gif')\");</script>";
                $_SESSION['alerts']  = $counter;
            }else{
                $_SESSION['alerts']  = $counter;
            }
        }

        return $chtml;
    }

    public function VerifyAlertListD()
    {
        $sql = "SELECT * FROM Login_Users WHERE User='tecnicom101'";
        $results = $this->db->query($sql);
        $row = $results->fetch_assoc();
        return $row['UpdateList'];
    }
}

?>
