<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require 'libraries/PHPMailer.php';

	$message = '';

	if ($_POST)
	{

		if( !isset($_POST['Nombre']) || !isset($_POST['Apellido']) || !isset($_POST['Telefono']) || !isset($_POST['Email']) || !isset($_POST['Servicio']) || !isset($_POST['Mensaje']) )
		{
			echo '<span class="sendmessage"> Complete la información para poder enviar su mensaje. </span>';
			exit();
		}

		$name     = removerHTML($_POST['Nombre']);
		$lastname = removerHTML($_POST['Apellido']);
		$phone    = removerHTML($_POST['Telefono']);
		$email    = removerHTML($_POST['Email']);
		$service  = removerHTML($_POST['Servicio']);
		$message  = removerHTML($_POST['Mensaje']);

		$mail = new PHPMailer;

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->SMTPDebug = 0;                                 // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		#$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
		$mail->Host = 'vipcapital.mx';                   // Specify main and backup server
		$mail->Port = 587;                                    // Set the SMTP port
		$mail->IsHTML(true);

		$mail->Username = 'contactoweb';            // SMTP username
		$mail->Password = 'c0ntact2022#';                         // SMTP password

		$mail->From = $email;
		$mail->FromName = "$name $lastname";
		$mail->AddAddress('contacto@vipcapital.mx', $name);

		$mail->Subject = "Informacion de $service";
		$mail->Body    = "
							<b>Nombre:   </b>$name $lastname<br/>
							<b>Teléfono: </b>$phone<br/>
							<b>Correo:   </b>$email<br/>
							<b>Asunto:   </b>$service<br/>
							<b>Mensaje:  </b>$message<br/>
						";
		$mail->AltBody = "Notificación de mensaje";

		if(!$mail->Send())
		{
			echo '<span class="sendmessage"> No se puede enviar el mensaje, favor de intentar mas tarde</span>';
		}
		else
		{
			echo '<span class="sendmessage"> Gracias por tus comentarios, fueron enviados exitosamente </span>';
		}

	}

	function removerHTML($texttovalid)
	{
		$texttovalid = trim($texttovalid);
		if(strlen($texttovalid)>0)
		{
			$texttovalid = htmlspecialchars(stripslashes($texttovalid));
		}
		return $texttovalid;
	}