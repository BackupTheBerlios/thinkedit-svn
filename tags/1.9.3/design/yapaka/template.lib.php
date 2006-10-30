<?php

/*
donne le nom de section du $node passé. Utile pour le choix de la bonne CSS. 
Si pas de section trouvée, il renvoit 'accueil'
*/
function te_get_section_name($node)
{
		$section = 'accueil';
		
		//echo $node->debug();
		$my_parents = $node->getParentUntilRoot();
		if ($node->getLevel() == 1)
		{
				$my_content = $node->getContent();
				$my_content->load();
				$section = strtolower($my_content->getTitle());
		}
		elseif (is_array($my_parents))
		{
		
				foreach ($my_parents as $my_parent)
				{
						if ($my_parent->getLevel() == 1)
						{
								$my_content = $my_parent->getContent();
								$my_content->load();
								$section = strtolower($my_content->getTitle());
						}
				}
		}
		
		return $section;
}

?>
