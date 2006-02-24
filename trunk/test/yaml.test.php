<?php

require_once '../thinkedit.init.php';

require_once ROOT . '/class/spyc.php';

$yaml = Spyc::YAMLDump($thinkedit->config, 4, 100);

echo '<pre>A PHP array run through YAMLDump():<br/>';
print_r($yaml);
echo '</pre>';


?>
