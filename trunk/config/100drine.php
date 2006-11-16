<?php
$data['content']['participation']['title']['fr']='Page';
$data['content']['participation']['title']['en']='Page';
$data['content']['participation']['help']['fr']='Une page du sites';
$data['content']['participation']['help']['en']='A page of the site';
$data['content']['participation']['title_field']='title';
$data['content']['participation']['allowed_items']['record']['page']='true';
$data['content']['participation']['use']['navigation']='true';


$data['content']['participation']['field']['id']['type']='id';
$data['content']['participation']['field']['title']['title']['fr']='Titre';
$data['content']['participation']['field']['title']['title']['en']='Title';
$data['content']['participation']['field']['title']['validation']['is_required']=1;
/*
$data['content']['participation']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['content']['participation']['field']['title']['help']['en']='A short title is often better';
*/
$data['content']['participation']['field']['title']['type']='string';
$data['content']['participation']['field']['title']['is_title']='true';


/*
$data['content']['participation']['field']['sub_title']['title']['fr']='Sous titre';
$data['content']['participation']['field']['sub_title']['help']['fr']='Utilisé dans la page si vous en proposez un';
$data['content']['participation']['field']['sub_title']['title']['en']='Sub title';
$data['content']['participation']['field']['sub_title']['help']['en']='May be used by the page template if you provide one';
$data['content']['participation']['field']['sub_title']['type']='string';
*/


/*
$data['content']['participation']['field']['intro']['title']['fr']='Introduction';
$data['content']['participation']['field']['intro']['title']['en']='Introduction';
$data['content']['participation']['field']['intro']['type']='richtext';
*/

$data['content']['participation']['field']['body']['title']['fr']='Corps du texte';
$data['content']['participation']['field']['body']['title']['en']='Body';
$data['content']['participation']['field']['body']['type']='text';

// we could use fck instead :  
//$data['content']['page']['field']['body']['engine']='fck';

// a css could be provided to tinymce :
//$data['content']['page']['field']['body']['css']='content.css';

// bbcode could be used as an output filter
//$data['content']['page']['field']['body']['outputfilter']='bbcode';

// we could trim before saving
//$data['content']['page']['field']['body']['inputfilter']='trim';

//$data['content']['page']['field']['body']['validation']['is_required']=1;
$data['content']['participation']['field']['attachment']['title']['fr']='Fichier joint';
$data['content']['participation']['field']['attachment']['help']['fr']='Facultatif';
$data['content']['participation']['field']['attachment']['type']='publicfile';
?>
