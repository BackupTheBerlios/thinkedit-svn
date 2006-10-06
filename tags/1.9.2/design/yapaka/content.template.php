<h1><?php echo $content->getTitle() ?></h1>

<p>
Il n'y a pas encore de modèle pour afficher cette page. Voici le contenu "brut" de celle-ci.
</p>


<?php foreach ($content->field as $field): ?>
<p>
<strong><?php echo $field->getTitle() ?> :</strong>
<br/>
<?php echo $field->get() ?>
</p>
<?php endforeach; ?>
