<?php
require_once '../../thinkedit.init.php';
include_once('ecard_functions.php');


// check mail
function checkmail($mail)
{
		if (eregi("^[0-9a-z]([-_.~]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,4}$",$mail))
		{
				return true;
		}
		else
		{
				return false;
		}
} 

// clean les infos http://www.phpsecure.info/v2/article/MailHeadersInject.php
function clean($value)
{
		if (eregi("\r",$value) || eregi("\n",$value))
		{
				die("Why ?? :(");
		}
		$value = preg_replace("/\r/", "", $value);
		$value = preg_replace("/\n/", "", $value);
		return $value;
}


// génération support captcha

require_once ROOT . '/class/captcha.class.php';
$captcha = new captcha();

// vérif captcha

if ($captcha->get() <> $_REQUEST['captcha'])
{
		die('code invalide, utilisez le bouton "précédent" de votre navigateur pour corriger le code');
}
else
{
		$captcha->reset();
		$from_email = $_SESSION['ecard']['from_email'];
		$from_name = $_SESSION['ecard']['from_name'];
		$to_email = $_SESSION['ecard']['to_email'];
		$subject = 'Voici une carte postale';
		$message = $_SESSION['ecard']['message'] . ' - '  . $_SESSION['ecard']['from_name'] . ' (' . $_SESSION['ecard']['from_email'] . ') ';
		$image = $thinkedit->newFilesystem();
		$image->setPath($_SESSION['ecard']['image']);
		$template = $thinkedit->newFilesystem();
		$template->setPath($_SESSION['ecard']['template']);
		
		$ecard_attachement = draw_card($message, $template->getRealPath(), $image->getRealPath(), true);
		
		
		// fabrique le mail
		require_once ('class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->isHtml(true);
		$mail->CharSet = 'utf-8';
		
		
		clean($from_email);
		clean($from_name);
		clean($to_email);
		clean($subject);
		
		
		
		
		
		if (!empty($from_name))
		{
				$subject .= ' de ' . substr($from_name, 0, 50);
		}
		
		
		
		$text_message = '';
		
		$text_message .= '<center>';
		$text_message .= " Pour envoyer une carte, il suffit d'aller sur ";
		$text_message .= '<a href="http://www.yapaka.be/">www.yapaka.be</a> !';
		$text_message .= '</center>';
		
		
		// attache toutes les infos à la classe mailer
		$mail->AddStringAttachment($ecard_attachement, 'carte.jpg', "base64", 'image/jpeg');
		$mail->From = $from_email;
		$mail->FromName = $from_name;
		$mail->addAddress($to_email);
		$mail->Subject = $subject; 
		$mail->Body = $text_message;
		
		// envoit le mail
		
		
		if ($mail->Send())
		{
				// affichage template
				include 'step3.template.php';
		}
		else
		{
				echo 'Problème technique de plomberie (probablement la résistance de chauffage), envois moi un ptit mail pour me prévenir que le système de carte ne marche plus bien';
		}

}

?>
