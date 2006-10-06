<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>formulaire</title>
</head>
<body>
<?php
    set_include_path(get_include_path() . ";c:\php\pear");
    require_once "HTML/QuickForm.php";

    $form = new HTML_QuickForm('frmTest', 'post');
    $form->addElement('text', 'Pseudo', 'Votre pseudo : ');
    $form->addElement('text', 'Nom', 'Votre nom : ');    
    $form->addElement('text', 'Email', 'Votre adresse email : ');    
    $options = array(
        'language'  => 'fr',
        'format'    => 'dMY',
        'minYear'   => 2001,
        'maxYear'   => 2005
    );
    $form->addElement('date', 'date', 'votre date de naissance : ', $options);
    $form->addRule('Pseudo', 'Vous devez saisir un pseudo', 'required', '', 'client');
    $form->addRule('Nom', 'Vous devez saisir un nom', 'required', '', 'client');
    $form->addRule('Email', 'Vous devez saisir une adresse Email', 'required', '', 'client');
    $form->addRule('Pseudo', 'Votre pseudo doit avoir entre 6 caractères et 10 caractères', 'rangelength', array(6,10), 'client');
    $form->addRule('Email', 'Vous devez saisir une adresse email valide', 'email', '', 'client');
    $form->applyFilter('Nom','trim') ;
    $form->applyFilter('Pseudo','trim') ;
    $form->setRequiredNote('<span style="color: #ff0000">*</span> = champs obligatoires');
    $form->setJsWarnings('Erreur de saisie','Veuillez corriger');
    $form->addElement('reset', 'bouton_clear', 'Effacer');
    $form->addElement('submit', 'bouton_effacer', 'Envoyer');
     if ($form->validate()) {
     	echo "Toutes les règles sont respectées<br>";
	}
     else {
    	$form->display();
	}
?>
</body>
</html>
