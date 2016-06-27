<?php

require_once("models/MenuModel.php");

class MenuController 
{
       
    public function ObtainData($who,$today)
    {
        switch ($who) 
        {
            case 'resellers':
                $MenuM = new MenuModel();
                return $MenuM->Resellers($today);
            break;
            
            default:
                echo " code...";
            break;
        }
    }
     
}


?>