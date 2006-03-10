<?php
/*
Thinkedit Install Wizard

This wizard can be called more than once (in case of db schema upgrade for instance)

There are some mandatory actions that are to be done in a certain order. 
Each time a test passes, we go to the next without showin test resutl to user. 


*/
// include thinkedit.init.php
include '../thinkedit.init.php';


// Ask for simple admin password

// check general php and server environment
// if fatal problem, show info screen


// Is there a config file for db ?
// If not, show DB config screen

// Can we connect to DB ?
// If not, show DB config screen + connect error info


// is the DB schema up to date ?
// if not, show info message about what can be done + button to update schema

// Is there a user in the DB ?
// if not, show user add screen + button to add a user


// Is there a root Node ?
// if not, ask for a title for the root node, and add it

// is there something else to do ?
// if yes show it.
// if no : show congratulation screen



?>
