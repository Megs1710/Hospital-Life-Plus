<?php	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

	function sendDetails($email,$app_date,$slot,$docfn,$docln) 
	{
		$message_body = "Greetings from Life Plus,<br/><b>Your Scheduled Appointment is on: ". $app_date ."<br/><br/>Slot No: " . $slot . "</b><br/><br/>Doctor: " . $docfn ." ". $docln . "</b>";
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
		$mail->Port       = 465;
		$mail->Username   = 'lifeplus.goa@gmail.com';   //SMTP username
		$mail->Password   = 'lifeplus101';                
		$mail->Host       = 'smtp.gmail.com';

		$mail->SetFrom('lifeplus.goa@gmail.com', 'Life Plus');
		$mail->AddAddress($email);
		$mail->Subject = "Appointment Details";
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		
		return $result;
	}
?>