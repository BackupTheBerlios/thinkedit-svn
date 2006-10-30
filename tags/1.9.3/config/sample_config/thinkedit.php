<?php
$data['site']['root_url']='/thinkedit/trunk/';
$data['site']['run_mode']='development';
$data['site']['design']='thinkedit';
$data['site']['locale']['en']['help']['fr']='Anglais';
$data['site']['locale']['en']['help']['en']='English';
$data['site']['locale']['fr']['help']['fr']='Français';
$data['site']['locale']['fr']['help']['en']='French';


$data['filesystem']['main']['type']='local';
$data['filesystem']['main']['root_path']['relative']='/files';
$data['filesystem']['main']['root_url']='/thinkedit/trunk/files/';





$data['table']['page']['field']['locale']['type']='locale';

$data['table']['screenshot']['icon']='book.png';
$data['table']['screenshot']['title_field']='title';
$data['table']['screenshot']['field']['id']['type']='id';
$data['table']['screenshot']['field']['title']['title']['en']='Title';
/*$data['table']['screenshot']['field']['title']['help']['']='Un titre court est plus percutant';*/
$data['table']['screenshot']['field']['title']['type']='string';
$data['table']['screenshot']['field']['title']['is_title']='true';
$data['table']['screenshot']['field']['intro']['title']['en']='Introduction';
$data['table']['screenshot']['field']['intro']['type']='text';

$data['table']['screenshot']['field']['cover']['title']['fr']='Screenshot file';
$data['table']['screenshot']['field']['cover']['type']='file';


?>
