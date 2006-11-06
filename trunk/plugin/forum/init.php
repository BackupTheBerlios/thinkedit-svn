<?php
$event = $thinkedit->getEvent();

$event->register('page_render_footer', 'forum_render_footer');


function forum_render_footer()
{
		// here we render the forum when the footer of the site is called
		return 'forum content';
}

?>
