<?php include 'content_header.php'; ?>

<div class="content_title"><?php echo $content->get('title'); ?></div>

<div class="content_text">
<?php echo $content->get('intro'); ?>
</div>

<div class="content_text">
<?php echo $content->get('body'); ?>
</div>

<?php if ($content->get('video_file')): ?>
Cliquez ci-dessous pour visionner la vidéo :<br/>
<?php $video_file = $content->field['video_file']->getFilesystem(); ?>

<object type="application/x-shockwave-flash" data="<?php echo te_design(); ?>/flvplayer/flvplayer.swf?file=<?php echo $video_file->getUrl(); ?>&autoStart=false" width="320" height="260" wmode="transparent">
  <param name="movie" value="<?php echo te_design(); ?>/flvplayer/flvplayer.swf?file=<?php echo $video_file->getUrl(); ?>&autoStart=false" />
  <param name="wmode" value="transparent" />
</object>


<hr/>
Vous pouvez télécharger le fichier flv pour le regarder 
<a href="<?php echo $video_file->getUrl(); ?>">Cliquez ici</a>
<hr/>
<br/>
<br/>

<?php endif; ?>



<?php if ($content->get('sound_file')): ?>
<?php $sound_file = $content->field['sound_file']->getFilesystem(); ?>

<object type="application/x-shockwave-flash" data="<?php echo te_design(); ?>/mp3player/mp3player.swf?file=<?php echo $sound_file->getUrl(); ?>" width="200" height="20">
<param name="movie" value="<?php echo te_design(); ?>/mp3player/mp3player.swf?file=<?php echo $sound_file->getUrl(); ?>" />
</object>



<hr/>
Vous pouvez télécharger le fichier mp3 pour l'écouter 
<a href="<?php echo $sound_file->getUrl(); ?>">Cliquez ici</a>
<hr/>
<br/>
<br/>

<?php endif; ?>




<?php if ($content->get('image_file')): ?>
<?php $image_file = $content->field['image_file']->getFilesystem(); ?>

<hr/>
Vous pouvez télécharger le fichier image original 
<a href="<?php echo $image_file->getUrl(); ?>">Cliquez ici</a>
<hr/>

<a href="<?php echo $image_file->getUrl(); ?>">
<img src="<?php echo $image_file->getThumbnail(array('w'=>300)); ?>">
</a>

<hr/>
Vous pouvez télécharger le fichier image original 
<a href="<?php echo $image_file->getUrl(); ?>">Cliquez ici</a>
<hr/>

<br/>
<br/>

<?php endif; ?>



<?php include 'content_footer.php'; ?>
