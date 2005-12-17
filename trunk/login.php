<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/user.class.php';



// simple is good :

// if form sent, try user::login
// if ok, redirect

// display form in all cases


$login_failed = false;




// check if we have authentification header
if (isset($_REQUEST['login']) && isset($_REQUEST['password']))
{
	// if yes : try to authenticate
	
	$user = new user();
	
	if ($user->login($_REQUEST['login'], $_REQUEST['password']))
	{
		// if auth success redirect
		
		$url = new url();
		$url->setFileName('homepage.php');
		
		$url->setParam('message', 'login_successfull');
		//header('location: ' . $url->render());
		$url->redirect();
		
	}
	else
	{
		$login_failed = true;
	}
	
}
// no redirection at this stage, show login screen





$page = new page();


// header
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');


// error if needed : 

if ($login_failed)
{
	$page->startPanel('error', 'error');
	$page->add(translate('login_failed'));
	$page->endPanel('error');
	
}

$page->startPanel('login');
$page->add('<h1>' . translate('login_identification') . '</h1>');
//$page->add($datagrid_tree->render());

$page->add('<p>' . translate('login_intro') . '</p>');

$page->add('<form method="post">');
$page->add('<p>' . translate('login') . '<br/>');
$page->add('<input type="text" name="login"></p>');
$page->add('<p>' . translate('password')  . '<br/>');
$page->add('<input type="password" name="password"></p>');

$page->add('<p><input type="submit" value="' . translate('login_button') . '"></p>');


$page->add('</form>');
$page->add('');



$page->endPanel('login');






echo $page->render();



?>
