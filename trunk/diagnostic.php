<?php
//todo : secure access to this file

require_once './class/url.class.php';

$url = new url;


echo '<h2>Thinkedit Diagnostic script</h2>';


function p($data)
{
	echo '<p>' . $data . '</p>';
}


function title($data)
{
	echo '<h2>' . $data . '</h2>';
}

function ok()
{
	echo '[OK]';
}


function error()
{
	echo '[ERROR]';
}



// init test number
if ($url->getParam('test'))
{
	$test = $url->getParam('test');
}
else
{
	$test = 0;
}


// php version
$test_id = 0;
if ($test == $test_id)
{
	title ('PHP version');
	p('Version found : ' . phpversion());
	
	if (strstr(phpversion(), '4.'))
	{
		$test ++;
		ok();
	}
	else
	{
		p('Maybe this php version won\'t work with Thinkedit');
		$test ++;
		error();
	}
}
$test_id++;

/*
if ($test == $test_id)
{
	title ('check DB version');
	//$ok = true; // test here
	
	if ($ok)
	{
		$test++;
	}
	else
	{
		p('error test');
	}
}
$test_id++;
*/


// magic quotes
if ($test == $test_id)
{
	title ('Magic quotes');
	//$ok = true; // test here
	
	if (get_magic_quotes_gpc())
	{
		p('magic quotes are on, security issue');
		error();
		$test++;
	}
	else
	{
		p('Magic quotes disabled');
		ok();
		$test++;
		
	}
}
$test_id++;




// include init.inc
// using >= gives a test that allways runs
if ($test >= $test_id)
{
	title ('Importing init.inc.php');
	//$ok = true; // test here
	
	if (require_once 'init.inc.php')
	{
		p('Init.inc.php successfully imported');
		ok();
		$test++;
	}
	else
	{
		p('Init.inc not imported');
		error();
		
	}
}
$test_id++;


// test DB connection
if ($test = $test_id)
{
	title ('Testing DB connection');
	//$ok = true; // test here
	$db = $thinkedit->getDb();
	
	
	if (!$db->isError())
	{
		p('DB connection ok');
		ok();
		$test++;
	}
	else
	{
		p('DB connection error');
		error();
		
	}
}
$test_id++;



if ($test == $test_id)
{
	title ('All done');
	//$ok = true; // test here
	$done = true;
}
$test_id++;


if (!$done)
{
	$url->setParam('test', $test+1);
	echo '<a href="' . $url->render() . '">skip this test</a>';
}







?>
