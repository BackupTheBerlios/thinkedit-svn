<?php
require_once '../thinkedit.init.php';

/*
How it works ?
In your plugin code, register for an event you know could happen :

'sample_event' is the event we are listening for
'my_test_plugin' is the name of your function you'd like to be called when something happens

*/
$thinkedit->event->bind('sample_event', 'my_test_plugin');

// of course, define your function somewhere in your plugin init.php
function my_test_plugin($data)
{
	echo 'a sample event hapened and said : ' . $data;
}



// somewhere in the code, thinkedit (or someone else) will trigger the event :
$thinkedit->event->trigger('sample_event', 'yes, it happened right now');


// ouput : 
// a sample event hapened and said : yes, it happened right now

echo '<pre>';
print_r ($thinkedit->config);

?>
