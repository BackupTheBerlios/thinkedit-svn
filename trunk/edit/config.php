<?php
// common include file for thinkedit
require_once('xml_parser.inc.php');
require_once('debuglib.inc.php');
require_once('common.inc.php');


check_user();

// read config and parse
$xml_parser = &new xml_parser;
$config = $xml_parser->parse_file('config.xml');

print_a($config);



print_a($_SESSION);


$my_tables = $db->get_results("SHOW TABLES",ARRAY_N);
$db->debug();

foreach ( $my_tables as $table )
{
$db->get_results("DESC $table[0]");
$db->debug();
}
?>
