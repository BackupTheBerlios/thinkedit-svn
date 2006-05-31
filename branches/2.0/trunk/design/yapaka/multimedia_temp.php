Cliquez ci-dessous pour écouter
<br/>
<br/>
<?php $sound_file = $content->field['sound_file']->getFilesystem(); ?>


<object type="application/x-shockwave-flash" data="<?php echo te_design(); ?>/dewplayer/dewplayer.swf?son=<?php echo $sound_file->getUrl(); ?>" width="200" height="20">
<param name="movie" value="<?php echo te_design(); ?>/dewplayer/dewplayer.swf?son=<?php echo $sound_file->getUrl(); ?>" />
</object>
<br/><br/><br/>
Vous pouvez également télécharger le fichier mp3 pour l'écouter hors connection. 
<a href="<?php echo $sound_file->getUrl(); ?>">Cliquez ici</a>



autre solution : 
<object type="application/x-shockwave-flash" data="<?php echo te_design(); ?>/mp3player/mp3player.swf?file=<?php echo $sound_file->getUrl(); ?>" width="200" height="20">
<param name="movie" value="<?php echo te_design(); ?>/mp3player/mp3player.swf?file=<?php echo $sound_file->getUrl(); ?>" />
</object>

