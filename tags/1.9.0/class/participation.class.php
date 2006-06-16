<?php

/*
This is a concept that must be extended.
Work in progress, only interface is defined here


Participation is a tool to let the public of a website participate actively.

This means : 

- adding comments
- respond to polls
- adding any kind of (allowed) content

This is translated to : render a public friendly form to add content to a website.

*/

/*
Example implementation can be found in /doc/participation.txt
*/


// Simple use : render a comment post form
$participation = new participation('discussion');
$participation->render();
$participation->renderForm(); // ?


// where is this stuff being put ?
// default to the curent node (global $node)
$participation->setParentNode($node);



// enable publishing "a posteriori"
// else comment / item is published imediately
$participation->enableModeration();


// enable instant publishing if user fills a captcha
// this disables moderation
$participation->enableCaptcha();

// Will add a preview button to let visitors preview their participation before submiting
// need mor thinking on this one as well
$participation->enablePreview();

// enable akismet.com spam check
// this disables moderation
$participation->enableAkismet();


// will send an email to $email when something is posted
$participation->notifyByEmail($email);

// Various strings
$participation->setTitle('Please submit your comment bellow');
$participation->setSucces('Good!, your comment has been posted');
$participation->setFailure('Too bad, it didn\'t work');



class participation
{
		var $title = 'Participate!';
		var $success_message = 'Your participation has been added';
		var $failure_message = 'System failure : your participation has not been added';
		var $enable_moderation = true;
		var $enable_askimet = false;
		var $parent_node;
		
		function participation($content_type)
		{
				$this->content_type = $content_type;
				global $node;
				$this->parent_node = $node;
		}
		
		function setParentNode($node)
		{
				$this->parent_node = $node;
		}
		
		
		
		function render()
		{
				// init form
				require_once ROOT . '/class/html_form.class.php';
				$form = new html_form();
				
				// add content
				$form->add('<h1>');
				$form->add($this->title);
				$form->add('</h1>');
				
				// if sent :
				// check spam
				// add item to node
				// publish if needed
				
				
		}
		
}


?>
