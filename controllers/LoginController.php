<?php

require_once("models/LoginModel.php");

class LoginController 
{   
    public function Validate($username, $password, $ipv4, $date)
    {
        $LoginM=new LoginModel();
        $data=$LoginM->Search($username, $password);

        if ($data > 0)
        {
            $LoginM->Update($username, $ipv4, $date, '1');
            echo "<script>window.location='?action=alerts&tid=".$_SESSION['tid']."';</script>";
        } 
        else if ($data == 0)  
        {            
            echo "<script>alert('Usuario y/o clave incorrecta');window.location='/';</script>";
        }
        else 
        {
            echo "<script>alert('El usuario ya esta usando el sistema.');window.location='/';</script>";
        }     
    }
    
    public function ValidateD($username, $password, $ipv4, $date)
    {
        $LoginM=new LoginModel();
        $data=$LoginM->Search($username, $password);

        if ($data > 0)
        {
            $LoginM->Update($username, $ipv4, $date, '1');
            echo "<script>window.location='?action=dale&tid=".$_SESSION['tid']."';</script>";
        } 
        else if ($data == 0)  
        {            
            echo "<script>alert('Usuario y/o clave incorrecta');window.location='/';</script>";
        }
        else 
        {
            echo "<script>alert('El usuario ya esta usando el sistema.');window.location='/';</script>";
        }     
    }
    
    public function GetClientIP() 
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
    
        return $ipaddress;
    }
 
    public function Quit()
    {
        $LoginM=new LoginModel();
        $data=$LoginM->Status($_SESSION['u']);
    }
    
    public function UpdateA()
    {
        $LoginM=new LoginModel();
        $LoginM->UA();
    }
     
    public function UpdateAD()
    {
        $LoginM=new LoginModel();
        $LoginM->UAD();
    } 
         
}


?>