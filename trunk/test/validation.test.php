<?php
require_once '../thinkedit.init.php';
//require_once ROOT . '/class/record.class.php';
echo '<pre>';

$page = $thinkedit->newRecord('page');
//$page->set('title', 'a title');

echo $page->debug();


if ($page->validate())
{
		echo '<li>' . 'valid page';
}
else
{
		echo '<li>' . 'invalid page';
}


if ($page->field['title']->validate())
{
		echo '<li>' . 'valid title';
}
else
{
		echo '<li>' . 'invalid title';
}


print_r ($page);

foreach ($page->field as $field)
{
		if ($field->getErrorMessage())
		{
				echo '<li>' . $field->getErrorMessage();
		}
}


echo '<br/>';

/*
foreach ($page->field as $field)
{
		echo 'id : ' . $field->getId() . ' ';
		if ($field->validate())
		{
				echo 'valid field';
		}
		else
		{
				echo 'invalid field';
		}
		
		echo '<br/>';
		
}


echo '<br/>';
print_r($page);
*/

?>
