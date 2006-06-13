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
$participation->setParentNode($node->getId());



// enable publishing "a posteriori"
// else comment / item is published imediately
$participation->enableModeration();


// enable instant publishing if user fills a captcha
// this disables moderation
$participation->enableCaptcha();

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
		function render()
		{
		}
		
}


?>
