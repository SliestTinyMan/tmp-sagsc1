<?php

class dbmysqli 
{
    public static function connect() 
    {
        $conn=new mysqli("intranet.tecnicom.pe:3306", "int_sup1", "oZtz9~LIl[Fp", "int16_tecnicom_lima");
        $conn->query("SET NAMES 'utf8'");

        if ($conn->connect_errno) {
    	echo "<script>console.log('Fallo al conectar a MySQL: ".$conn->connect_errno.", ".$conn->connect_error."');</script>";
		}
		echo "<script>console.log('".$conn->host_info."');</script>";
	} 
}
 
?>