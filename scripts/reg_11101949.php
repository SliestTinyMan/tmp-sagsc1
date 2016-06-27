<?php

/*date_default_timezone_set('Etc/UTC');
require_once('mail/PHPMailerAutoload.php');*/

$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];

//$con=new mysqli("localhost", "root", "CC@i0f;&d=+r8I$", "re-lima1-mysql");
$con=new mysqli('intranet.tecnicom.pe:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
$con->query("SET NAMES 'utf8'");

$sql =  "INSERT INTO usuarios (NOMBRE, DOCUMENTO, TELEFONO, EMAIL, CONFIRMADO, POR)
	VALUES ('{$nombre}','{$documento}','{$telefono}','{$email}','e01e','0')";
mysqli_query($con,$sql);

/*$code = getRandomCode();*/

/*$sql0 = "SELECT * FROM usuarios WHERE DOCUMENTO = '".$documento."'";
$result = mysqli_query($con,$sql0);
$datos=$result->num_rows;*/

/*$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;

$mail->Debugoutput = 'html';
$mail->Host = 'ssl://p3plcpnl0442.prod.phx3.secureserver.net';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'registro@guiaventura.com';
$mail->Password = 'RsI$6Hwg+r8@';
$mail->setFrom('registro@guiaventura.com', 'Registro Usuario');
$mail->addAddress('jmhidalgoa@live.com', 'Juan M');
$mail->Subject = 'REGISTRO USUARIO';
*/

/*if ($datos>0) {

	$row = mysqli_fetch_assoc($result);

	$sql =  "INSERT INTO tmp_usuarios (NOMBRE, DOCUMENTO, TELEFONO, EMAIL, CONFIRMADO, POR)
	VALUES ('{$nombre}','{$documento}','{$telefono}','{$email}','e01e','0')";
	mysqli_query($con,$sql);

	$body = "ESTE USUARIO SE REGISTRO ANTERIORMENTE CON ESTOS DATOS: \n -NOMBRE: ".$row['NOMBRE']." \n -DOCUMENTO: ".$row['DOCUMENTO']." \n -TELEFONO: ".$row['TELEFONO']." \n -EMAIL: ".$row['EMAIL']." \n \n INTENTO DE NUEVO REGISTRO: \n -NOMBRE: ".$nombre." \n -DOCUMENTO: ".$documento." \n -TELEFONO: ".$telefono." \n -EMAIL: ".$email." \n \n PARA CONFIRMAR EL ACCESO INGRESE AL SIGUIENTE ENLACE: \n http://re-lima1-mobile.guiaventura.com/scripts/?o=".$code."&u=1";

}else{

	$sql =  "INSERT INTO usuarios (NOMBRE, DOCUMENTO, TELEFONO, EMAIL, CONFIRMADO, POR)
	VALUES ('{$nombre}','{$documento}','{$telefono}','{$email}','{$code}','0')";
	mysqli_query($con,$sql);

	$body = "ESTE ES EL DETALLE REGISTRADO: \n -NOMBRE: ".$nombre." \n -DOCUMENTO: ".$documento." \n -TELEFONO: ".$telefono." \n -EMAIL: ".$email." \n PARA CONFIRMAR EL ACCESO INGRESE AL SIGUIENTE ENLACE: \n http://re-lima1-mobile.guiaventura.com/scripts/?o=".$code;

}

$mail->Body    = $body;
if (!$mail->send()) {
    echo "<script>console.log('Mailer Error: ". $mail->ErrorInfo."');";
} else {
    echo "<script>alert('Datos enviados, espere verificar.');</script>";
}
*/

mysqli_close($con);

/*function getRandomCode(){
    $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}*/

?>
