<?php
$data['table']['page']['title']['fr']='Page';
$data['table']['page']['help']['fr']='Une page du sites';
$data['table']['page']['title_field']='title';
$data['table']['page']['allowed_items']['record']['page']='true';
$data['table']['page']['allowed_items']['record']['publication']='true';
$data['table']['page']['allowed_items']['filesystem']['main']='true';
$data['table']['page']['field']['id']['type']='id';
$data['table']['page']['field']['title']['title']['fr']='Titre du dossier';
$data['table']['page']['field']['title']['help']['fr']='Un titre court est plus percutant';
$data['table']['page']['field']['title']['type']='string';
$data['table']['page']['field']['title']['is_title']='true';
$data['table']['page']['field']['intro']['title']['fr']='Introduction du dossier';
$data['table']['page']['field']['intro']['type']='richtext';
$data['table']['page']['field']['body']['title']['fr']='Corps du texte';
$data['table']['page']['field']['body']['help']['fr']='Regardez dans l\'aide pour ajouter des images';
$data['table']['page']['field']['body']['type']='richtext';
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
$data['table']['multimedia']['field']['cover']['title']['fr']='Image de couverture';
$data['table']['multimedia']['field']['cover']['type']='file';
$data['table']['user']['title']['fr']='Utilisateurs';
$data['table']['user']['help']['fr']='Liste des personnes pouvant utiliser le site et modifier son contenu';
$data['table']['user']['use']['main']='true';
$data['table']['user']['field']['id']['type']='id';
$data['table']['user']['field']['id']['primary']='true';
$data['table']['user']['field']['login']['is_title']='true';
$data['table']['user']['field']['login']['type']='login';
$data['table']['user']['field']['password']['type']='password';
$data['table']['node']['field']['id']['type']='id';
$data['table']['node']['field']['id']['primary']='true';
$data['table']['node']['field']['id']['is_title']='true';
$data['table']['node']['field']['parent_id']['type']='int';
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
$data['table']['node']['field']['template']['title']['fr']='Modèle de page (pas encore fonctionnel)';
$data['table']['node']['field']['template']['type']='template';
$data['table']['node']['field']['publish']['title']['fr']='Statut de publication';
$data['table']['node']['field']['publish']['type']='publish';
$data['site']['help']['fr']='Bienvenue sur Thinkedit, le système de gestion de données et de contenu facile à utiliser';
$data['site']['root_url']='/thinkedit/trunk/';
$data['site']['run_mode']='development';
$data['site']['design']='yapaka';
$data['site']['locale']['fr']['help']['fr']='Français';
$data['site']['locale']['fr']['help']['en']='French';
$data['site']['locale']['en']['help']['fr']='Anglais';
$data['site']['locale']['en']['help']['en']='English';
$data['site']['database']['main']['host']='localhost';
$data['site']['database']['main']['database']='thinkedit';
$data['site']['database']['main']['login']='thinkedit';
$data['site']['database']['main']['password']='thinkedit';
$data['filesystem']['main']['type']='local';
$data['filesystem']['main']['root_path']['relative']='/files';
$data['filesystem']['main']['root_url']='/thinkedit/trunk/files';

?>
