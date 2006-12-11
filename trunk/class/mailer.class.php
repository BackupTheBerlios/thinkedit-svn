<?php


/**
* Very thin wrapper around phpmailer http://phpmailer.sourceforge.net/extending.html
* This way, the programing style is respected.
* todo : add email validation
* todo : add throttling ?
*/
class mailer
{
	function mailer()
	{
		require_once ROOT . '/lib/phpmailer/class.phpmailer.php';
		$this->mailer = new phpmailer();
	}
	
		
		function setFrom($email, $name = false)
		{
				$this->mailer->From = $email;
				if ($name)
				{
					$this->mailer->FromName = $name;
				}
			
		}
		
		
		function setTo($to)
		{
			trigger_error('deprecated');	
			$this->mailer->AddAddress($to);
		}
		
		function addAddress($email, $name = false)
		{
			$this->mailer->AddAddress($email, $name);
		}
		
		function setSubject($subject)
		{
				$this->mailer->Subject = $subject;
		}
		
		function setBody($body)
		{
				$this->mailer->Body = $body;
		}
		
		function isHtml($value)
		{
				return $this->mailer->IsHTML($value);
		}
		
		function send()
		{
				$this->mailer->CharSet = 'utf-8';
				return $this->mailer->Send();
		}
}

?>
