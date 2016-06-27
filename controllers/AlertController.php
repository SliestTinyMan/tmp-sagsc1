<?php

require_once("models/AlertModel.php");

class AlertController 
{   
    public function UpdateData($ord)
    {
        $alertas=new AlertModel();
        $loading=$alertas->VerifyAlertList($ord);
        return $loading;
    }
    
    public function UpdateDataD()
    {
        $alertas=new AlertModel();
        $loading=$alertas->VerifyAlertListD();
        return $loading;
    }
    
    public function Mostrar()
    {
        date_default_timezone_set("America/Lima");
        $fecha=date("d")."/".date("m")."/".date("Y");
        $alertas=new AlertModel();

        $datos=$alertas->ObtenerAlertas($fecha,'NO');

        return $datos;
    }

    public function Atender($id)
    {
        $alertas=new AlertModel();
        $datos=$alertas->AtenderAlerta($id);

        $array = explode("!", $datos);
        $datos = $array[0];
        $latitud = $array[1];
        $longitud = $array[2];
        $nombre = $array[3];
        
        require_once("views/alerts/AttendAlert.php");
    }
    
    public function AtenderD($id)
    {
        $alertas=new AlertModel();
        $datos=$alertas->AtenderAlertaD($id);

        $array = explode("!", $datos);
        $datos = $array[0];
        $latitud = $array[1];
        $longitud = $array[2];
        $nombre = $array[3];
        
        require_once("views/alerts/AttendAlertD.php");
    }
    
     public function ActualizarAlerta($dni, $n, $t, $s, $c, $id, $lat, $lng)
    {
        $alertas=new AlertModel();

        $datos=$alertas->UpdateAlert($dni, $n, $t, $s, $c, $id, $lat, $lng);
        //return $datos;
    }
     
    public function ActualizarAlerta2($dni, $n, $t, $s, $c, $lat, $lng)
    {
        $alertas=new AlertModel();

        $datos=$alertas->UpdateAlert2($dni, $n, $t, $s, $c, $lat, $lng);
        //return $datos;
    } 
    
    public function InsertD($ag, $al)
    {
        $alertas=new AlertModel();
        $datos=$alertas->NUA($ag, $al);
    }
    
    public function MostrarD()
    {
        date_default_timezone_set("America/Lima");
        $fecha=date("d")."/".date("m")."/".date("Y");
        $alertas=new AlertModel();
        $datos=$alertas->ObtenerAlertasD();
        return $datos;
    }

}


?>