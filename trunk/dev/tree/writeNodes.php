<?php
include '../../thinkedit.init.php';


if(isset($_GET['parentId']))
{

		$node = $thinkedit->newNode();
		$node->setId($_GET['parentId']);
		$children = $node->getChildren();
		
		if ($children)
		{
				foreach ($children as $child)
				{
						echo '<li><a href="#">' . $child->getTitle() . '</a>';
						echo '<input type="checkbox"> ';
						if ($child->hasChildren())
						{
								echo '<ul>';
								echo '<li parentId="'. $child->getId() .'"><a href="#">Loading</li>';
								echo '</ul>';
						}
						echo '</li>';
				}
		}
		
		die();
	switch($_GET['parentId']){

		case "1":
			?>
			<li><a href="#">Denmark</a>
				<ul>
					<li parentId="11"><a href="#">Loading</li>
				</ul>			
			</li>
			<li><a href="#">Norway</a>
				<ul>
					<li parentId="12"><a href="#">Loading</li>
				</ul>
			</li>
			<li><a href="#">Sweden</a></li>						
			<?
			break;
		case "11":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Bergen</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Stavanger</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Trondheim</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Oslo</a></li>					
			<?
			break;
	}
}

?>