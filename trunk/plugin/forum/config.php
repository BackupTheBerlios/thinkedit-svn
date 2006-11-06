<?php
$data['content']['forum']['title']['fr']='Forum';
$data['content']['forum']['help']['fr']='Forum qui contient les messages postés par les utilisateurs du site';
$data['content']['forum']['icon']='comments.png';
$data['content']['forum']['title_field']='title';

// true / false are replaced by 0 and 1
$data['content']['forum']['use']['navigation']=0;
$data['content']['forum']['use']['main']=0;
// new use : rss
$data['content']['forum']['use']['rss']=1;

// new format for allowed
$data['content']['forum']['allowed_items'][] = 'discussion';

// Storage : is it needed ?
$data['content']['forum']['storage'] = 'db'; 

$data['content']['forum']['field']['id']['type']='id';
$data['content']['forum']['field']['title']['title']['fr']='Sujet';
$data['content']['forum']['field']['title']['type']='string';
$data['content']['forum']['field']['title']['is_title']='true';
$data['content']['forum']['field']['intro']['title']['fr']='Introduction';
$data['content']['forum']['field']['intro']['type']='text';
$data['content']['forum']['field']['enable_moderation']['title']['fr']='Moderation';
$data['content']['forum']['field']['enable_moderation']['type']='boolean';
$data['content']['forum']['field']['enable_captcha']['title']['fr']='Moderation';
$data['content']['forum']['field']['enable_captcha']['type']='boolean';
$data['content']['forum']['field']['notification_email']['title']['fr']='Email pour les alertes';
$data['content']['forum']['field']['notification_email']['type']='email';




$data['content']['discussion']['title']['fr']='Discussion';
$data['content']['discussion']['help']['fr']='Message posté par les utilisateurs du site en rapport avec une page du site';
$data['content']['discussion']['icon']='comment.png';
$data['content']['discussion']['title_field']='title';
$data['content']['discussion']['use']['navigation']='false';
$data['content']['discussion']['use']['main']='true';
$data['content']['discussion']['field']['id']['type']='id';
$data['content']['discussion']['field']['title']['title']['fr']='Sujet';
$data['content']['discussion']['field']['title']['type']='string';
$data['content']['discussion']['field']['title']['is_title']='true';
$data['content']['discussion']['field']['email']['title']['fr']='Adresse email';
$data['content']['discussion']['field']['email']['type']='string';
$data['content']['discussion']['field']['name']['title']['fr']='Nom ou pseudo';
$data['content']['discussion']['field']['name']['type']='string';
$data['content']['discussion']['field']['name']['validation']['is_required']=1;
$data['content']['discussion']['field']['body']['title']['fr']='Message';
$data['content']['discussion']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['content']['discussion']['field']['body']['type']='text';
$data['content']['discussion']['field']['body']['validation']['is_required']=1;
$data['content']['discussion']['field']['posted']['type']='created';
$data['content']['discussion']['field']['posted']['title']['fr']='Date de création';
$data['content']['discussion']['field']['posted']['use']['participation']='false';

?>
