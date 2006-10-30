<?php

/*
Thinkedit plugin example

Idea 1 : wordpress style plugin system :

*/



function mail_me_on_article_add($record)
{
		// code that sends an email
}


// plugin->on($action, $callback)
$thinkedit->plugin->on('create_record',  'mailMeOnArticleAdd');

?>
