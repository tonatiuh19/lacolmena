<?php
//Load Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('admin/mailer/vendor/autoload.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name     	= test_input($_POST['name']);
	$email    	= test_input($_POST['email']);
	$subject  	= test_input($_POST['subject']);
	$comments 	= test_input($_POST['comments']);

	$mail = new PHPMailer();

	try {
	
		$mail->SMTPDebug = false;                              //Send using SMTP
		$mail->Host       = 'mail.tonatiuhgomez.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'lacolmena@tonatiuhgomez.com';                     //SMTP username
		$mail->Password   = 'Lacolmena123';                               //SMTP password
		$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 469;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		$mail->CharSet = 'UTF-8';                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	

		//Recipients
		$mail->setFrom('lacolmena@tonatiuhgomez.com', 'Robot La Colmena');
		$mail->addAddress('ceraslacolmena@gmail.com', 'Ceras la colmena');     //Add a recipient
		//$mail->setLanguage('es', '../admin/mailer/vendor/phpmailer/phpmailer/language');
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = 'Hola admin! <br> <p>Tienes un mensaje nuevo con los siguientes parametros: </p> Nombre de usuario: '.$name.' <br> Correo: '.$email.'<br> Asunto: '.$subject.' <br> Comentarios: '.$comments.' <p>Sauludos. <br>Robot La colmena.</p>';
		$mail->AltBody = 'Hola admin! <br> <p>Tienes un mensaje nuevo con los siguientes parametros: </p> Nombre de usuario: '.$name.' <br> Correo: '.$email.'<br> Asunto: '.$subject.' <br> Comentarios: '.$comments.' <p>Sauludos. <br>Robot La colmena.</p>';
	
		$mail->send();     
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		$('#exampleModalCenter').modal('show');
		</SCRIPT>");
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<style>
	body {
		color: blue;
	}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
     
        <h5 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-glass-cheers fa-2x"></i><br>Tu mensaje ha sido enviado</h5>
        <p>El equipo de La Colmena se pondra en contacto contigo a la brevedad.</p>
        <a href="http://lacolmena.com.mx/" class="btn btn-success">Regresar</a>
      
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>