<?php
/*
See licence.txt for licence

Content type editor lets you manage your content types

INPUT :
- action : list, new, edit, save

*/


/************************* INIT ****************************/

include_once('common.inc.php');

//check_user
check_user();


/**************************** ACTIONS ****************/
// list, new, edit, save


// List content types

// Add new content type

// Edit a content type

// Save a content type



/**************************** TEMPLATES ****************/
include('header.template.php');
include('content_type_edit.template.php');
include('footer.template.php');

?>
