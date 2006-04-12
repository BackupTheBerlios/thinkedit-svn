<?php
$data['table']['page']['title']['fr']='Page';
$data['table']['page']['help']['fr']='Une page du sites';
$data['table']['page']['title_field']='title';
$data['table']['page']['allowed_items']['record']['page']='true';
$data['table']['page']['allowed_items']['record']['publication']='true';
$data['table']['page']['allowed_items']['record']['news']='true';
$data['table']['page']['allowed_items']['record']['discussion']='true';
$data['table']['page']['allowed_items']['record']['question_parent']='true';
$data['table']['page']['allowed_items']['filesystem']['main']='true';
$data['table']['page']['use_in_navigation']='true';


$data['table']['page']['field']['id']['type']='id';
$data['table']['page']['field']['title']['title']['fr']='Titre';
$data['table']['page']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['table']['page']['field']['title']['type']='string';
$data['table']['page']['field']['title']['is_title']='true';

$data['table']['page']['field']['sub_title']['title']['fr']='Sous titre';
$data['table']['page']['field']['sub_title']['help']['fr']='Utilisé dans la page si vous en proposez un';
$data['table']['page']['field']['sub_title']['type']='string';


$data['table']['page']['field']['intro']['title']['fr']='Introduction';
$data['table']['page']['field']['intro']['type']='richtext';
$data['table']['page']['field']['body']['title']['fr']='Corps du texte';
$data['table']['page']['field']['body']['help']['fr']='Regardez dans l\'aide pour ajouter des images';
$data['table']['page']['field']['body']['type']='richtext';
$data['table']['page']['field']['cover']['title']['fr']='Image de présentation';
$data['table']['page']['field']['cover']['help']['fr']='Facultative. Si vous en ajoutez une, elle apparaitra dans le site, dans chaque page de listing des sous pages';
$data['table']['page']['field']['cover']['type']='file';



$data['table']['translation']['title']['fr']='Traduction';
$data['table']['translation']['help']['fr']='Les traductions peuventêtre utilisées dans l\'interface et dans la partie publique du site. C\'est très utile dans le cas d\'un site multilingue';
$data['table']['translation']['field']['translation_id']['type']='stringid';
$data['table']['translation']['field']['translation_id']['is_title']='true';
$data['table']['translation']['field']['translation']['type']='text';
$data['table']['translation']['field']['translation']['is_title']='true';
$data['table']['translation']['field']['locale']['type']='locale';
$data['table']['translation']['field']['locale']['is_title']='true';

$data['table']['author']['title']['fr']='Auteur';
$data['table']['author']['field']['id']['type']='id';
$data['table']['author']['field']['id']['primary']='true';
$data['table']['author']['field']['firstname']['type']='string';
$data['table']['author']['field']['firstname']['is_title']='true';
$data['table']['author']['field']['lastname']['type']='string';
$data['table']['author']['field']['lastname']['is_title']='true';
$data['table']['author']['allowed_items']='none';

$data['table']['publication']['title']['fr']='Publication';
$data['table']['publication']['icon']='book.png';
$data['table']['publication']['title_field']='title';
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

$data['table']['relation']['title_field']='title';
$data['table']['relation']['field']['id']['type']='id';
$data['table']['relation']['field']['id']['primary']='false';
$data['table']['relation']['field']['source_class']['type']='string';
$data['table']['relation']['field']['source_class']['primary']='true';
$data['table']['relation']['field']['source_class']['use']['list']='true';
$data['table']['relation']['field']['source_type']['type']='string';
$data['table']['relation']['field']['source_type']['primary']='true';
$data['table']['relation']['field']['source_type']['use']['list']='true';
$data['table']['relation']['field']['source_id']['type']='text';
$data['table']['relation']['field']['source_id']['primary']='true';
$data['table']['relation']['field']['source_id']['use']['list']='true';
$data['table']['relation']['field']['target_class']['type']='string';
$data['table']['relation']['field']['target_class']['primary']='true';
$data['table']['relation']['field']['target_class']['use']['list']='true';
$data['table']['relation']['field']['target_type']['type']='string';
$data['table']['relation']['field']['target_type']['primary']='true';
$data['table']['relation']['field']['target_type']['use']['list']='true';
$data['table']['relation']['field']['target_id']['type']='text';
$data['table']['relation']['field']['target_id']['primary']='true';
$data['table']['relation']['field']['target_id']['use']['list']='true';
$data['table']['relation']['field']['sort_order']['type']='order';
$data['table']['relation']['field']['sort_order']['use']['list']='true';

$data['table']['multimedia']['title']['fr']='Elément multimédia';
$data['table']['multimedia']['help']['fr']='Unélément multimédia peut être un film, un son, une musique, etc... Attachez un fichier à cet élément pour qu\'il soit disponible en téléchargement';
$data['table']['multimedia']['icon']='video-x-generic.png';
$data['table']['multimedia']['title_field']='title';
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

$data['table']['user']['title']['fr']='Utilisateurs';
$data['table']['user']['help']['fr']='Liste des personnes pouvant utiliser le site et modifier son contenu';
$data['table']['user']['use']['main']='true';
$data['table']['user']['field']['id']['type']='id';
$data['table']['user']['field']['id']['primary']='true';
$data['table']['user']['field']['login']['is_title']='true';
$data['table']['user']['field']['login']['type']='login';
$data['table']['user']['field']['password']['type']='password';
$data['table']['user']['field']['password']['use']['list']='false';


$data['table']['node']['field']['id']['type']='id';
$data['table']['node']['field']['id']['primary']='true';
$data['table']['node']['field']['id']['is_title']='true';
$data['table']['node']['field']['parent_id']['type']='int';
$data['table']['node']['field']['parent_id']['use']['edit']='false';
$data['table']['node']['field']['object_class']['type']='string';
$data['table']['node']['field']['object_class']['use']['list']='false';
$data['table']['node']['field']['object_class']['use']['edit']='false';
$data['table']['node']['field']['object_type']['type']='string';
$data['table']['node']['field']['object_type']['use']['list']='false';
$data['table']['node']['field']['object_type']['use']['edit']='false';
$data['table']['node']['field']['object_id']['type']='text';
$data['table']['node']['field']['object_id']['use']['list']='false';
$data['table']['node']['field']['object_id']['use']['edit']='false';
$data['table']['node']['field']['sort_order']['type']='order';
$data['table']['node']['field']['sort_order']['use']['list']='false';
$data['table']['node']['field']['sort_order']['use']['edit']='false';
$data['table']['node']['field']['level']['type']='int';
$data['table']['node']['field']['level']['use']['list']='false';
$data['table']['node']['field']['level']['use']['edit']='false';
$data['table']['node']['field']['path']['type']='string';
$data['table']['node']['field']['path']['use']['list']='false';
$data['table']['node']['field']['path']['use']['edit']='false';
$data['table']['node']['field']['cache']['type']='text';
$data['table']['node']['field']['cache']['use']['list']='false';
$data['table']['node']['field']['cache']['use']['edit']='false';
$data['table']['node']['field']['template']['title']['fr']='Modèle de page';
$data['table']['node']['field']['template']['type']='template';
$data['table']['node']['field']['publish']['title']['fr']='Statut de publication';
$data['table']['node']['field']['publish']['type']='publish';
$data['table']['node']['field']['left_id']['type']='int';
$data['table']['node']['field']['left_id']['use']['list']='false';
$data['table']['node']['field']['left_id']['use']['edit']='false';
$data['table']['node']['field']['right_id']['type']='int';
$data['table']['node']['field']['right_id']['use']['list']='false';
$data['table']['node']['field']['right_id']['use']['edit']='false';


$data['table']['news']['title']['fr'] = 'actualité';
$data['table']['news']['icon'] = 'calendar.png';
$data['table']['news']['field']['id']['type'] = 'id';
$data['table']['news']['field']['title']['type'] = 'string';
$data['table']['news']['field']['title']['is_title'] = 'true';
$data['table']['news']['field']['intro']['type'] = 'richtext';
$data['table']['news']['field']['body']['type'] = 'richtext';
$data['table']['news']['field']['image']['type'] = 'file';


$data['table']['discussion']['title']['fr']='Discussion';
$data['table']['discussion']['icon']='comment.png';
$data['table']['discussion']['title_field']='title';
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
$data['table']['question_parent']['use_in_navigation']='true';

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




/*
$data['table']['role']['title']['fr']='Roles';
$data['table']['role']['help']['fr']='Roles des différentes personnes qui utilisent l\'interface';
$data['table']['role']['use']['main']='true';
$data['table']['role']['field']['id']['type']='id';
$data['table']['role']['field']['title']['type'] = 'string';
$data['table']['role']['field']['title']['is_title']='true';

$data['table']['permission']['title']['fr'] = 'Permissions';
$data['table']['permission']['help']['fr'] = 'Permissions assignables à un rôle';
$data['table']['permission']['use']['main']='true';
$data['table']['permission']['field']['id']['type'] = 'id';
$data['table']['permission']['field']['title']['type'] = 'string';
$data['table']['permission']['field']['title']['is_title'] = 'true';
$data['table']['permission']['field']['action']['type'] = 'string';
$data['table']['permission']['field']['object_class']['type']='string';
$data['table']['permission']['field']['object_type']['type']='string';
$data['table']['permission']['field']['object_id']['type']='text';
*/


?>
