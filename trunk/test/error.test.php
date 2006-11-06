<?php
// error handlers test

require_once('../thinkedit.init.php');

if ($thinkedit->isInProduction())
{
	echo 'thinkedit is in production';
}
else
{
		echo 'thinkedit is in development mode';
}


trigger_error('test');

/*
echo '<pre>';
print_r($thinkedit->errors);
*/

echo te_admin_toolbox();

?>
