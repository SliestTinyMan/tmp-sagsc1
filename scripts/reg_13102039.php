<?php

date_default_timezone_set("America/Lima");

$documento = $_POST["documento"];
$alerta = $_POST["alerta"];
$latitud = $_POST["latitud"];
$longitud = $_POST["longitud"];

$hora = date("H").":".date("i");;
$fecha = date("d")."/".date("m")."/".date("Y");

//$con=new mysqli("localhost", "root", "CC@i0f;&d=+r8I$", "re-lima1-mysql");
$con=new mysqli('intranet.tecnicom.pe:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
$con->query("SET NAMES 'utf8'");

$sql = "SELECT * FROM usuarios WHERE DOCUMENTO='".$documento."'";
$results = $con->query($sql);
$row = $results->fetch_assoc();

$sql1 =  "INSERT INTO alertas (USUARIO, BOTON, LATITUD, LONGITUD, HORA, FECHA) VALUES ('".$documento."','".$alerta."','".$latitud."','".$longitud."','".$hora."','".$fecha."')";
mysqli_query($con,$sql1);

// definir sector y actualizar
$sql2 = "UPDATE Login_Users SET UpdateList='1'";
mysqli_query($con,$sql2);

mysqli_close($con);

?>
