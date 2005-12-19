<?php
// Db syncer, will create database tables and field corresponding to the xml config files

// init
require_once ('../thinkedit.init.php');

// loop each config table
require_once ROOT . '/class/schema.class.php';

$config = new $config();

$table_list = $config->getTableList();

foreach ($table as $table)

// if table not there, create it with simple id field

// if table exists, 
// loop over fields
// if field not there, create it with right type

// handle field change type ?
// this may be a risky job

// end





?>
