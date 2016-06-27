<?php

$id = $_POST["id"];
$text = $_POST["text"];
$evento = $_POST["evento"];

//$con=new mysqli("localhost", "lima1sagsc", "kqP6didD53kT", "SAG_SC_LIMA1");
$con=new mysqli('localhost', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
$sql =  "UPDATE alertas SET DETALLE='".$text."',ATENDIDO='SI',EVENTO='".$evento."' WHERE ID='".$id."'";
mysqli_query($mysqli,$sql);

?>
