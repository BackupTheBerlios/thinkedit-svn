<?php

require_once '../thinkedit.init.php';

die();

//check_user();


require_once ROOT . '/class/spyc.php';

$yaml = Spyc::YAMLDump($thinkedit->config, 4, 100);

echo '<pre>A PHP array run through YAMLDump():<br/>';
print_r($yaml);
echo '<hr>';



$array = Spyc::YAMLLoad($yaml);
print_r($array);


echo '<hr>';

$test['test'] = 5;
$test['i'][] = 'bonjour';
$test['i'][] = 4;
$test['i'][] = 'hop';
$test['i']['er']['fsdf'] = 'hop';
$test['i']['en']['fsdf'] = 'hop';
$test['i']['fr'][] = 'hop';
$test['i']['fr'][] = 'hops';
$test['i']['fr'][] = 'hopz';

$yaml = Spyc::YAMLDump($test, 4, 100);
print_r($yaml);

echo '<hr>';

$array = Spyc::YAMLLoad($yaml);
print_r($array);

echo '</pre>';

xdebug_dump_function_profile(4);

?>
