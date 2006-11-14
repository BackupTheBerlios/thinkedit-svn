<?php

require_once '../thinkedit.init.php';
require_once '../class/content_form.class.php';


$form = new content_form('page');

echo $form->render();


if ($form->isValid())
{
	echo '<h1>form is valid</h1>'; 
}
else
{
		echo '<h1>form is NOT valid</h1>';
}

echo '<pre>';
print_r ($form->getContentAsArray());

?>
