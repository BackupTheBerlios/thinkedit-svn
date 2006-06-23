<?php
$data['site']['design']='yapaka';

$data['table']['page']['allowed_items']['record']['publication']='true';
$data['table']['page']['allowed_items']['record']['news']='true';
$data['table']['page']['allowed_items']['record']['forum']='true';
$data['table']['page']['allowed_items']['record']['question_parent']='true';
$data['table']['page']['allowed_items']['record']['multimedia']='true';
$data['table']['page']['allowed_items']['record']['adresse']='true';
$data['table']['page']['allowed_items']['record']['texte']='true';



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



$data['table']['texte']['title']['fr']='Texte à lire';
$data['table']['texte']['icon']='book.png';
$data['table']['texte']['title_field']='title';
$data['table']['texte']['use']['navigation']='true';
$data['table']['texte']['field']['id']['type']='id';
$data['table']['texte']['field']['title']['title']['fr']='Titre';
$data['table']['texte']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['table']['texte']['field']['title']['type']='string';
$data['table']['texte']['field']['title']['is_title']='true';
$data['table']['texte']['field']['intro']['title']['fr']='Introduction';
$data['table']['texte']['field']['intro']['help']['fr']='Introduction courte au texte';
$data['table']['texte']['field']['intro']['type']='richtext';
$data['table']['texte']['field']['authors']['title']['fr']='Auteurs';
$data['table']['texte']['field']['authors']['type']='text';
$data['table']['texte']['field']['body']['title']['fr']='Corps du texte';
$data['table']['texte']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['table']['texte']['field']['body']['type']='richtext';
$data['table']['texte']['field']['pages']['title']['fr']='Nombre de pages';
$data['table']['texte']['field']['pages']['type']='int';
$data['table']['texte']['field']['cover']['title']['fr']='Couverture';
$data['table']['texte']['field']['cover']['type']='file';
$data['table']['texte']['field']['pdf']['title']['fr']='Fichier pdf';
$data['table']['texte']['field']['pdf']['type']='file';
$data['table']['texte']['field']['publication']['title']['fr']='Date de publication';
$data['table']['texte']['field']['publication']['help']['fr']='Il faut pour le moment mettre aaaa-mm-jj (année, mois, jour)';
$data['table']['texte']['field']['publication']['type']='date';



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
$data['table']['news']['field']['intro']['type'] = 'text';
$data['table']['news']['field']['body']['type'] = 'text';
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
$data['table']['discussion']['field']['name']['validation']['is_required']=1;
$data['table']['discussion']['field']['body']['title']['fr']='Message';
$data['table']['discussion']['field']['body']['help']['fr']='Texte plus long (si nécessaire)';
$data['table']['discussion']['field']['body']['type']='text';
$data['table']['discussion']['field']['body']['validation']['is_required']=1;
$data['table']['discussion']['field']['posted']['type']='created';
$data['table']['discussion']['field']['posted']['title']['fr']='Date de création';
$data['table']['discussion']['field']['posted']['use']['participation']='false';



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
$data['table']['adresse']['field']['intro']['type']='text';

$data['table']['adresse']['field']['adresse']['title']['fr']='Adresse';
$data['table']['adresse']['field']['adresse']['type']='text';

$data['table']['adresse']['field']['telephone']['title']['fr']='Numéro de téléphone';
$data['table']['adresse']['field']['telephone']['type']='string';

$data['table']['adresse']['field']['url']['title']['fr']='Site internet';
$data['table']['adresse']['field']['url']['type']='string';

$data['table']['adresse']['field']['email']['title']['fr']='Adresse email';
$data['table']['adresse']['field']['email']['type']='string';




$data['table']['annonce']['title']['fr']='Annonces en ligne';
$data['table']['annonce']['help']['fr']='Annonces proposées par les utilisateurs professionnels du site';
$data['table']['annonce']['icon']='bell.png';
$data['table']['annonce']['title_field']='title';
$data['table']['annonce']['use']['navigation']='true';
$data['table']['annonce']['use']['main']='true';
$data['table']['annonce']['field']['id']['type']='id';

$data['table']['annonce']['field']['title']['title']['fr']='Titre';
$data['table']['annonce']['field']['title']['type']='string';
$data['table']['annonce']['field']['title']['is_title']='true';

$data['table']['annonce']['field']['date_start']['title']['fr']='Date';
$data['table']['annonce']['field']['date_start']['help']['fr']='Si il y a plusieurs dates, entrez la permière et précisez ci-dessous';
$data['table']['annonce']['field']['date_start']['type']='date';

$data['table']['annonce']['field']['horaire']['title']['fr']='Horaire';
$data['table']['annonce']['field']['horaire']['type']='text';

$data['table']['annonce']['field']['intervenants']['title']['fr']='Intervenant(s)';
$data['table']['annonce']['field']['intervenants']['help']['fr']='Veuillez préciser le nom, prénom, ainsi que la fonction de chaque intervenant';
$data['table']['annonce']['field']['intervenants']['type']='text';

$data['table']['annonce']['field']['lieu']['title']['fr']='Lieu';
$data['table']['annonce']['field']['lieu']['type']='text';


$data['table']['annonce']['field']['cout']['title']['fr']='Coût';
$data['table']['annonce']['field']['cout']['type']='text';

$data['table']['annonce']['field']['organisateur']['title']['fr']='Organisateur';
$data['table']['annonce']['field']['organisateur']['help']['fr']='Indiquez un maximum d\'informations';
$data['table']['annonce']['field']['organisateur']['type']='text';



$data['table']['annonce']['field']['site']['title']['fr']='Site web';
$data['table']['annonce']['field']['site']['type']='string';

$data['table']['annonce']['field']['email']['title']['fr']='Adresse email';
$data['table']['annonce']['field']['email']['type']='string';


$data['table']['annonce']['field']['descriptif']['title']['fr']='Bref descriptif';
$data['table']['annonce']['field']['descriptif']['help']['fr']='Cette information ne sera pas publiée';
$data['table']['annonce']['field']['descriptif']['type']='text';

$data['table']['annonce']['field']['public_cible']['title']['fr']='Public visé';
$data['table']['annonce']['field']['public_cible']['help']['fr']='Cette information ne sera pas publiée';
$data['table']['annonce']['field']['public_cible']['type']='text';


$data['table']['annonce']['field']['posted']['type']='created';
$data['table']['annonce']['field']['posted']['title']['fr']='Date de création de l\'annonce';
$data['table']['annonce']['field']['posted']['help']['fr']='Information ajoutée automatiquement';
$data['table']['annonce']['field']['posted']['use']['participation']='false';



?>
