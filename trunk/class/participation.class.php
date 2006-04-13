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
Example implementation (will be commented out later) :
*/


// Simple use : render a comment post form
$participation = new participation('discussion');
$participation->render();


// where is this stuff being put ?
$participation->setParentNode($node->getId());



// enable publishing "a posteriori"
$participation->enableModeration();


// enable instant publishing if user fills a captcha
$participation->enableCaptcha();

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
