<?php
$data['table']['page']['title']['fr']='Page';
$data['table']['page']['help']['fr']='Une page du sites';
$data['table']['page']['title_field']='title';
$data['table']['page']['allowed_items']['record']['page']='true';
$data['table']['page']['use']['navigation']='true';


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


/*
$data['table']['translation']['title']['fr']='Traduction';
$data['table']['translation']['help']['fr']='Les traductions peuvent être utilisées dans l\'interface et dans la partie publique du site. C\'est très utile dans le cas d\'un site multilingue';
$data['table']['translation']['use']['navigation']='false';
$data['table']['translation']['field']['translation_id']['type']='stringid';
$data['table']['translation']['field']['translation_id']['is_title']='true';
$data['table']['translation']['field']['translation']['type']='text';
$data['table']['translation']['field']['translation']['is_title']='true';
$data['table']['translation']['field']['locale']['type']='locale';
$data['table']['translation']['field']['locale']['is_title']='true';
*/

/*
$data['table']['author']['title']['fr']='Auteur';
$data['table']['author']['field']['id']['type']='id';
$data['table']['author']['field']['id']['primary']='true';
$data['table']['author']['field']['firstname']['type']='string';
$data['table']['author']['field']['firstname']['is_title']='true';
$data['table']['author']['field']['lastname']['type']='string';
$data['table']['author']['field']['lastname']['is_title']='true';
$data['table']['author']['allowed_items']='none';
$data['table']['author']['use']['navigation']='false';
*/


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




$data['table']['user']['title']['fr']='Utilisateurs';
$data['table']['user']['help']['fr']='Liste des personnes pouvant utiliser le site et modifier son contenu';
$data['table']['user']['use']['main']='true';
$data['table']['user']['use']['navigation']='false';
$data['table']['user']['field']['id']['type']='id';
$data['table']['user']['field']['id']['primary']='true';
$data['table']['user']['field']['login']['is_title']='true';
$data['table']['user']['field']['login']['type']='login';
$data['table']['user']['field']['password']['type']='password';
$data['table']['user']['field']['password']['use']['list']='false';
$data['table']['user']['field']['interface_locale']['type']='string';
$data['table']['user']['field']['interface_locale']['title']['fr']='Langue de l\'interface';
$data['table']['user']['field']['interface_locale']['title']['en']='Interface locale';


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
