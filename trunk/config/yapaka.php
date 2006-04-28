<?php


$data['table']['page']['allowed_items']['record']['publication']='true';
$data['table']['page']['allowed_items']['record']['news']='true';
$data['table']['page']['allowed_items']['record']['forum']='true';
$data['table']['page']['allowed_items']['record']['question_parent']='true';
$data['table']['page']['allowed_items']['record']['multimedia']='true';
$data['table']['page']['allowed_items']['record']['adresse']='true';
$data['table']['page']['allowed_items']['filesystem']['main']='true';


// tables sépcifiques à yapaka

$data['table']['publication']['title']['fr']='Publication';
$data['table']['publication']['icon']='book.png';
$data['table']['publication']['title_field']='title';
$data['table']['publication']['use']['navigation']='true';
$data['table']['publication']['field']['id']['type']='id';
$data['table']['publication']['field']['title']['title']['fr']='Titre';
$data['table']['publication']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['table']['publication']['field']['title']['type']='string';
$data['table']['publication']['field']['title']['is_title']='true';
$data['table']['publication']['field']['intro']['title']['fr']='Introduction';
$data['table']['publication']['field']['intro']['help']['fr']='Introduction courteà la publication';
$data['table']['publication']['field']['intro']['type']='richtext';
$data['table']['publication']['field']['authors']['title']['fr']='Auteurs';
$data['table']['publication']['field']['authors']['type']='text';
$data['table']['publication']['field']['body']['title']['fr']='Corps du texte';
$data['table']['publication']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['table']['publication']['field']['body']['type']='richtext';
$data['table']['publication']['field']['cover']['title']['fr']='Couverture';
$data['table']['publication']['field']['cover']['type']='file';
$data['table']['publication']['field']['pdf']['title']['fr']='Fichier pdf';
$data['table']['publication']['field']['pdf']['type']='file';
$data['table']['publication']['field']['publication']['title']['fr']='Date de publication';
$data['table']['publication']['field']['publication']['help']['fr']='Il faut pour le moment mettre aaaa-mm-jj (année, mois, jour)';
$data['table']['publication']['field']['publication']['type']='date';


$data['table']['multimedia']['title']['fr']='Elément multimédia';
$data['table']['multimedia']['help']['fr']='Unélément multimédia peut être un film, un son, une musique, etc... Attachez un fichier à cet élément pour qu\'il soit disponible en téléchargement';
$data['table']['multimedia']['icon']='video-x-generic.png';
$data['table']['multimedia']['title_field']='title';
$data['table']['multimedia']['use']['navigation']='true';
$data['table']['multimedia']['field']['id']['type']='id';
$data['table']['multimedia']['field']['title']['title']['fr']='Titre';
$data['table']['multimedia']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['table']['multimedia']['field']['title']['type']='string';
$data['table']['multimedia']['field']['title']['is_title']='true';
$data['table']['multimedia']['field']['intro']['title']['fr']='Introduction';
$data['table']['multimedia']['field']['intro']['help']['fr']='Introduction courte';
$data['table']['multimedia']['field']['intro']['type']='text';
$data['table']['multimedia']['field']['body']['title']['fr']='Corps du texte';
$data['table']['multimedia']['field']['body']['help']['fr']='Regardez dans l\'aide pour ajouter des images';
$data['table']['multimedia']['field']['body']['type']='richtext';
$data['table']['multimedia']['field']['cover']['title']['fr']='Image de prévisualisation';
$data['table']['multimedia']['field']['cover']['type']='file';
$data['table']['multimedia']['field']['sound_file']['title']['fr']='Fichier son (mp3)';
$data['table']['multimedia']['field']['sound_file']['type']='file';
$data['table']['multimedia']['field']['video_file']['title']['fr']='Fichier vidéo (flv)';
$data['table']['multimedia']['field']['video_file']['type']='file';


$data['table']['news']['title']['fr'] = 'actualité';
$data['table']['news']['icon'] = 'calendar.png';
$data['table']['news']['use']['navigation']='false';
$data['table']['news']['field']['id']['type'] = 'id';
$data['table']['news']['field']['title']['type'] = 'string';
$data['table']['news']['field']['title']['is_title'] = 'true';
$data['table']['news']['field']['intro']['type'] = 'richtext';
$data['table']['news']['field']['body']['type'] = 'richtext';
$data['table']['news']['field']['image']['type'] = 'file';


$data['table']['forum']['title']['fr']='Forum';
$data['table']['forum']['help']['fr']='Boite qui contient les messages postés par les utilisateurs du site';
$data['table']['forum']['icon']='comments.png';
$data['table']['forum']['title_field']='title';
$data['table']['forum']['use']['navigation']='false';
$data['table']['forum']['use']['main']='false';
$data['table']['forum']['allowed_items']['record']['discussion']='true';
$data['table']['forum']['field']['id']['type']='id';
$data['table']['forum']['field']['title']['title']['fr']='Sujet';
$data['table']['forum']['field']['title']['type']='string';
$data['table']['forum']['field']['title']['is_title']='true';
$data['table']['forum']['field']['intro']['title']['fr']='Introduction';
$data['table']['forum']['field']['intro']['type']='text';




$data['table']['discussion']['title']['fr']='Discussion';
$data['table']['discussion']['help']['fr']='Message posté par les utilisateurs du site en rapport avec une page du site';
$data['table']['discussion']['icon']='comment.png';
$data['table']['discussion']['title_field']='title';
$data['table']['discussion']['use']['navigation']='false';
$data['table']['discussion']['use']['main']='true';
$data['table']['discussion']['field']['id']['type']='id';
$data['table']['discussion']['field']['title']['title']['fr']='Sujet';
$data['table']['discussion']['field']['title']['type']='string';
$data['table']['discussion']['field']['title']['is_title']='true';
$data['table']['discussion']['field']['email']['title']['fr']='Adresse email';
$data['table']['discussion']['field']['email']['type']='string';
$data['table']['discussion']['field']['name']['title']['fr']='Nom ou pseudo';
$data['table']['discussion']['field']['name']['type']='string';
$data['table']['discussion']['field']['body']['title']['fr']='Message';
$data['table']['discussion']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['table']['discussion']['field']['body']['type']='text';
$data['table']['discussion']['field']['posted']['type']='created';
$data['table']['discussion']['field']['posted']['title']['fr']='Date de création';
$data['table']['discussion']['field']['posted']['use']['public']='false';



$data['table']['question_parent']['title']['fr']='Question parent';
$data['table']['question_parent']['icon']='book_open.png';
$data['table']['question_parent']['title_field']='title';
$data['table']['question_parent']['use']['navigation']='true';
$data['table']['question_parent']['field']['id']['type']='id';
$data['table']['question_parent']['field']['title']['title']['fr']='Titre';
$data['table']['question_parent']['field']['title']['type']='string';
$data['table']['question_parent']['field']['title']['is_title']='true';
$data['table']['question_parent']['field']['cover']['title']['fr']='Image de présentation';
$data['table']['question_parent']['field']['cover']['type']='file';
$data['table']['question_parent']['field']['intro']['title']['fr']='Chapo';
$data['table']['question_parent']['field']['intro']['type']='richtext';
$data['table']['question_parent']['field']['body']['title']['fr']='Corps du texte';
$data['table']['question_parent']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['table']['question_parent']['field']['body']['type']='richtext';


$data['table']['adresse']['title']['fr']='Adresse utile';
$data['table']['adresse']['icon']='email.png';
$data['table']['adresse']['title_field']='title';
//$data['table']['adresse']['use']['navigation']='true';
$data['table']['adresse']['field']['id']['type']='id';
$data['table']['adresse']['field']['title']['title']['fr']='Titre';
$data['table']['adresse']['field']['title']['help']['fr']='Nom de la personne ou de l\'organisme';
$data['table']['adresse']['field']['title']['type']='string';
$data['table']['adresse']['field']['title']['is_title']='true';
$data['table']['adresse']['field']['intro']['title']['fr']='Description';
$data['table']['adresse']['field']['intro']['type']='richtext';

$data['table']['adresse']['field']['adresse']['title']['fr']='Adresse';
$data['table']['adresse']['field']['adresse']['type']='text';

$data['table']['adresse']['field']['telephone']['title']['fr']='Numéro de téléphone';
$data['table']['adresse']['field']['telephone']['type']='string';

$data['table']['adresse']['field']['url']['title']['fr']='Site internet';
$data['table']['adresse']['field']['url']['type']='string';

$data['table']['adresse']['field']['email']['title']['fr']='Adresse email';
$data['table']['adresse']['field']['email']['type']='string';




?>
