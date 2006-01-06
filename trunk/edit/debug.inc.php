<?php

function debug($data)
{
global $debug;
//global $debug_output;

if ($debug)
{
$debug_output.='<div>';
$debug_output.= $data;
$debug_output.= '<hr/>';
$debug_output.='</div>';

echo $debug_output;
}
}



function debug2($data, $title)
{
global $debug;
//global $debug_output;

if ($debug)
{
$debug_output.='<h1>';
$debug_output.=$title;
$debug_output.='</h1>';
$debug_output.='<div>';
$debug_output.= $data;
$debug_output.= '<hr/>';
$debug_output.='</div>';

echo $debug_output;
}
}

?>