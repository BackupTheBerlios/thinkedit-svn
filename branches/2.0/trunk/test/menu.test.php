<style>
div
{
		margin: 3px;
		margin-left: 10px;
		
		border: 1px solid red;
		
}

div > div > div > div
{
			border: 5px solid blue;
}

.current
{
		background-color: gray; 
}

</style>
<?php

require_once '../thinkedit.init.php';
require_once ROOT . '/class/menu.class.php';

$menu = new menu();

$menu->setCurrentNode(14);

//echo '<pre>';

echo $menu->displayChildren(0);

echo '<hr>';

echo $menu->displayChildren(7);

echo '<hr>';

$db = $thinkedit->getDb();

echo 'total queries : ' . $db->getTotalQueries();

?>
