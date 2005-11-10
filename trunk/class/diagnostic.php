<?php
//todo : secure access to this file

require_once './class/url.class.php';

$url = new url;


// init test number
if ($url->getParam('test'))
{
	$test = $url->getParam('test');
}
else
{
	$test = 0;
}

if ($test < 1)
{
	echo 'check php version';
	$ok = true; // test here
	
	if ($ok)
	{
		$test++;
	}
	else
	{
		echo 'error test';
	}
}

$url->setParam('test', $test);
echo '<a href="' . $url->render() . '">skip this test</a>';
	
	




?>
