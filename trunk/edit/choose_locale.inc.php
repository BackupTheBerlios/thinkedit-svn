<?php if (isset($edit_mode)): ?>
<?php else: ?>

<form name="preferred_locale">
<select name="locale" onChange="location=document.preferred_locale.locale.options[document.preferred_locale.locale.selectedIndex].value;" value="GO">

<?php foreach (get_all_locales() as $locale): ?>



<option value="change_setting.php?setting=preferred_locale&value=<?php echo $locale ?>" <?php if ($locale == $_SESSION['preferred_locale']) echo 'SELECTED' ?>>
<?php echo $config['config']['site']['locale'][$locale]['help'][$locale] ?>
</option>
<?php endforeach; ?>


</select>
</form>
<?php endif; ?>