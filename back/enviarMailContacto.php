<?php

$sName  = $_POST['nombre'];
$sEmail = $_POST['email'];
$sTel = $_POST['telefono'];
$sMensaje = $_POST['mensaje'];

enviarMail($sName,$sEmail,$sTel,$sMensaje);
//header("location: msj_contacto_enviado.php");

function enviarMail($name,$email,$sTel,$mensaje){
	require_once "Mail.php";
	global $IPSERVER;
	global $HOST_SMTP;
	global $PORT_SMTP;
	global $USER_SMTP;
	global $PASS_SMTP;
	global $ADMIN_EMAIL;
	include 'config/variables.php';
	$to = $ADMIN_EMAIL;
	$headers = array (
		'MIME-Version' => '1.0rn',
		'Content-type' => 'text/html; charset=utf-8',
		'From' => 'Pagina la colmena <pagina@colmena.com.mx>',
		'To' => $ADMIN_EMAIL,
		'Cc' => '',
		'Subject' => 'La colmena - Tienes un nuevo mensaje');
		
		$body = "<html> <head>
				<style type='text/css'>
					p{
						font-family: arial, sans-serif;
						font-size: 16px;
					}
					img{
						width:150px;
						height:110px;
						}
					#tituloLogin{
						margin-top:5px;
						margin-bottom:5px;
						font-family: arial, sans-serif;
						color: #36C;
						font-size: 17px;
						font-weight: bold;
					}
				</style>
			</head>
			<body>
				<div id='tituloLogin'>Mensaje de contacto La colmena</div>
				<p>Tienes un mensaje de  " . htmlspecialchars($name). " con email " . htmlentities($email). " y con teléfono " .htmlentities($sTel).". </p>
				<p>Mensaje: <br /> <div style='font-style:italic;'>" . htmlspecialchars($mensaje). "</div></p>
			</body>
			</html>";
	
	$smtp = Mail::factory('smtp',
		array ('host' => $HOST_SMTP,
		'port' => $PORT_SMTP,
		'auth' => true,
		'username' => $USER_SMTP,
		'password' => $PASS_SMTP));
	
	$mail = $smtp->send($to, $headers, $body);
	
	if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
          echo("<p>Message successfully sent!</p>");
         }
}
?>
