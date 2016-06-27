<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
date_default_timezone_set('America/Lima');

if (isset($_GET["action"])){ $action = $_GET["action"]; }else{ $action = ""; }
if (isset($_GET["tid"])){ $tid = $_GET["tid"]; }else{ $tid = ""; }
if (isset($_GET["reseller"])){ $res = $_GET["reseller"]; }else{ $res = ""; }

/*if ($tid==$_SESSION['tid'])
{*/
    switch ($action) {

        case 'login':
            UpdateTID();
            if ($_POST['LoginUsername'] == 'alertac2')
            {
                require_once("controllers/LoginController.php");
                $LoginC = new LoginController();
                $LoginC->ValidateD($_POST['LoginUsername'], $_POST['LoginPassword'], $LoginC->GetClientIP(), date("j-m-Y h:i:sa"));
                //echo "<script>window.location='?action=dale&tid=".$_SESSION['tid']."';</script>";
            }
            else
            {
                require_once("controllers/LoginController.php");
                $LoginC = new LoginController();
                $LoginC->Validate($_POST['LoginUsername'], $_POST['LoginPassword'], $LoginC->GetClientIP(), date("j-m-Y h:i:sa"));
            }
        break;

        case 'alerts':
            UpdateTID();
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $chtml = $AlertC->Mostrar();
            echo "
                <script>
                    var interval = 1000;
                    function doAjax() {
                        var parametros = {
                            'usr' : '".$_SESSION['usr']."',
                            'tid' : '".$_SESSION['tid']."'
                        };
                        var parametros2 = {
                            'usr2' : '".$_SESSION['usr']."',
                            'tid2' : '".$_SESSION['tid']."'
                        };
                        $.ajax({
                            data:  parametros,
                            url:   'http://alertaciudadana.tecnicom.pe/?action=valerts&tid=".$_SESSION['tid']."',
                            type:  'post',
                            beforeSend: function () {
                                    console.log('Enviando agente ".$_SESSION['usr']."');
                            },
                            success:  function (response) {
                                    console.log('success');
                            },
                            complete: function (data) {
                                console.log(data.responseText);
                                if (data.responseText > 0)
                                {
                                    console.log('update');
                                    $.ajax({
                                        data:  parametros2,
                                        url:   'http://alertaciudadana.tecnicom.pe/?action=updatea&tid=".$_SESSION['tid']."',
                                        type:  'post',
                                        beforeSend: function () {
                                                console.log('Enviado update');
                                        },
                                        success:  function (response) {
                                                console.log('success');
                                        },
                                        complete: function (data) {
                                            console.log('OK');
                                        }
                                    });
                                    window.location='?action=alerts&tid=".$_SESSION['tid']."';
                                }
                                else
                                {
                                setTimeout(doAjax, interval);
                                }
                            }
                        });
                    }
                    setTimeout(doAjax, interval);
                </script>
                ";
            require_once('views/alerts/sagsc/index.php');
        break;

        case 'dale':
            UpdateTID();
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $chtml = $AlertC->MostrarD();
            echo "
                <script>
                    var interval = 1000;
                    function doAjax() {
                        var parametros = {
                            'usr' : '".$_SESSION['usr']."',
                            'tid' : '".$_SESSION['tid']."'
                        };
                        var parametros2 = {
                            'usr2' : '".$_SESSION['usr']."',
                            'tid2' : '".$_SESSION['tid']."'
                        };
                        $.ajax({
                            data:  parametros,
                            url:   'http://alertaciudadana.tecnicom.pe/?action=valertsd&tid=".$_SESSION['tid']."',
                            type:  'post',
                            beforeSend: function () {
                                    console.log('Enviando agente ".$_SESSION['usr']."');
                            },
                            success:  function (response) {
                                    console.log('success');
                            },
                            complete: function (data) {
                                console.log(data.responseText);
                                if (data.responseText > 0)
                                {
                                    console.log('update');
                                    $.ajax({
                                        data:  parametros2,
                                        url:   'http://alertaciudadana.tecnicom.pe/?action=updatead&tid=".$_SESSION['tid']."',
                                        type:  'post',
                                        beforeSend: function () {
                                                console.log('Enviado update');
                                        },
                                        success:  function (response) {
                                                console.log('success');
                                        },
                                        complete: function (data) {
                                            console.log('OK');
                                        }
                                    });
                                    window.location='?action=dale&tid=".$_SESSION['tid']."';
                                }
                                else
                                {
                                setTimeout(doAjax, interval);
                                }
                            }
                        });
                    }
                    setTimeout(doAjax, interval);
                </script>
                ";
            require_once('views/alerts/sagsc/index2.php');
        break;

        case 'attend':
            UpdateTID();
            echo "<script>console.log('Attend');</script>";
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $chtml = $AlertC->Atender($_GET["l"]);
        break;

        case 'attend2':
            UpdateTID();
            echo "<script>console.log('Attend2');</script>";
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $chtml = $AlertC->AtenderD($_GET["l"]);
        break;

        case 'updatea':
            require_once("controllers/LoginController.php");
            $LoginC = new LoginController();
            $LoginC->UpdateA();
        break;

        case 'updatead':
            require_once("controllers/LoginController.php");
            $LoginC = new LoginController();
            $LoginC->UpdateAD();
        break;

        case 'updalert':
            require_once("controllers/AlertController.php");

            $AlertC = new AlertController();

            return $AlertC->ActualizarAlerta($_POST['dni'], $_POST['nombre'], $_POST['telefono'], $_POST['sel1'], $_POST['comment'], $_POST['idalert'], $_POST['cmaplat'], $_POST['cmaplng']);
        break;

        case 'updalertdd':
            require_once("controllers/AlertController.php");
            //$adb=new mysqli('localhost', 'root', 'CC@i0f;&d=+r8I$', 're-lima1-mysql');
            $adb=new mysqli('localhost', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
            $adb->query("SET NAMES 'utf8'");
            $sql = "DELETE FROM derivados WHERE AGENT='1' ORDER BY ID DESC LIMIT 1";
            $adb->query($sql);

            $AlertC = new AlertController();
            return $AlertC->ActualizarAlerta($_POST['dni'], $_POST['nombre'], $_POST['telefono'], $_POST['sel1'], $_POST['comment'], $_POST['idalert'], $_POST['cmaplat'], $_POST['cmaplng']);
        break;


        case 'valerts':
            $usr = $_POST['usr'];
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $data = $AlertC->UpdateData($usr);
            echo $data;
        break;

        case 'valertsd':
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $data = $AlertC->UpdateDataD();
            echo $data;
        break;

        case 'derivar':
            $alert = $_POST['alert'];
            $agent = $_POST['agent'];
            require_once("controllers/AlertController.php");
            $AlertC = new AlertController();
            $data = $AlertC->InsertD($agent, $alert);
        break;

        case 'nalert':

       if ($tid==$_SESSION['tid']) {

            UpdateTID();

            echo "<script>console.log('N Alert');</script>";

            $datos = "<div class='jumbotron'>
                <table style='width:100%;'>
                <tr>
                    <td style='width:50%;'>
                    <p><kbd>USUARIO(DNI): <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='dni' ></kbd></p>
                    <p class='text-info'>NOMBRE: <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='nombre' ></p>
                    <p class='text-info'>TELÉFONO: <input type='text' style='color:#000;border-style: solid; border-width: 0; padding: 0;' id='telefono' ><button type='button' class='btn btn-success'>C</button></p>
                    <p><code>TIPO DE ALERTA: SERENAZGO</code></p>
                    <p class='text-info'>LA HORA SE AGREGA DE FORMA AUTOM&Aacute;TICA</p>
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
                        <div id='markerStatus'></div>
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

            require_once("views/alerts/AttendAlert2.php");

        }else{
            UpdateTID();
            require_once('views/login/8lf/index.php');
        }

    break;

        case 'quit':
            UpdateTID();
            require_once("controllers/LoginController.php");
            $LoginC = new LoginController();
            $LoginC->Quit();
            require_once('views/login/8lf/index.php');
       break;

        default:
            UpdateTID();
            require_once('views/login/8lf/index.php');
        break;
    }
/*}
else
{
    UpdateTID();
    require_once('views/login/8lf/index.php');
}*/

function UpdateTID()
{
    $str =  date("j").date("i").date("z").date("s");
    $_SESSION['tid'] = md5($str);
}


?>
