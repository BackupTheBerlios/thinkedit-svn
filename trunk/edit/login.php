<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


User validation

*/

include_once('common.inc.php');
session_start();

// check if we have a login and a password to validate against db

if (isset($_REQUEST['login']) and isset($_REQUEST['password']))
{
  $login = $db->escape($_REQUEST['login']);
  $password = $db->escape($_REQUEST['password']);


  // query the users db using login and password form request
  $query = "select * from users where login = '$login' and password = '$password'";

  $db->query($query);
  //if ($debug) $db->debug();


  // if password is valid (assumptionm ade bellow must be checked for security),
  // register user in session, and redirect to main page or prefered page if defined

  // todo : is this the right way to check if we have a valid user in the db ?
  if ($db->num_rows > 0)
  {
    $_SESSION['user'] = $login;


    // now we redirect to the correct page

    // first case, we know where to send the user
    if (isset ($_REQUEST['original_url']))
    {
      redirect ( urldecode($_REQUEST['original_url']) );
    }

    // second case, we don't, so we redirect to main
    else
    {
      redirect('main.php');
    }
  }


  // if invalid user, reload login page with error message
  else
  {
    redirect('login.php?authentification=failed');
  }


}


if ($_REQUEST['authentification'] == 'failed')
{
  $out['error'] = translate('login_failed');
}


// if an email is found in the request, try to send an email to this user :

if (isset($_REQUEST['email']))
{
  $email = $db->escape($_REQUEST['email']);
  $query = "select * from users where email='$email'";
  $user = $db->get_row($query);
  //$db->debug();
  if ($db->num_rows > 0)
  {
    $msg = translate('forgotten_paswd_email_intro', false);
    $msg.= "\n";
		$msg.= "\n";
		$msg.= "\n";
    $msg.= translate('forgotten_paswd_email_your_login', false);
    $msg.= $user->login;
    $msg.= "\n";
    $msg.= "\n";
		$msg.= translate('forgotten_paswd_email_your_password', false);
    $msg.= $user->password;
    $msg.= "\n";
		$msg.= "\n";
		$msg.= "\n";
    $msg.= translate('forgotten_paswd_email_outro', false);

		//echo $msg;
		
    if ( mail($user->email, translate('forgotten_paswd_email_subject', false) , $msg ) )

    {
      $out['info'] = translate('login_mail_sent');
    }
    else
    {
      $out['error'] = translate('login_mail_not_sent');
    }
		

  }
  else
  {
    $out['error'] = translate('login_mail_not_found');
  }

}



$out['banner_needed'] = false;

// no user or password in the request, we need to display a login page, which is done by default anyway

include('header.template.php');
include('login.template.php');
include('footer.template.php');

?>
