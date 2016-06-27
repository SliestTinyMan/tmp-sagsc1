<?php

$documento = $_POST["documento"];

//$con=new mysqli("localhost", "lima1sagsc", "kqP6didD53kT", "SAG_SC_LIMA1");
$con=new mysqli('intranet.tecnicom.pe:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
$con->query("SET NAMES 'utf8'");

//MySqli Select Query
$sql0 = "SELECT * FROM tmp_usuarios WHERE DOCUMENTO='".$documento."'";
$results0 = $con->query($sql0);
if($results0->num_rows > 0){
	echo "0";
}else{
	$sql = "SELECT * FROM usuarios WHERE DOCUMENTO='".$documento."'";
	$results = $con->query($sql);
	$row = $results->fetch_assoc();

	if ($row["CONFIRMADO"] =="e01e"){
	   echo "1C01SCL";
	}else{
	   echo "0";
	}

}



?>
