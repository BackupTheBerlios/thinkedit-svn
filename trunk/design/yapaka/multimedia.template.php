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

<?php endif; ?>



<?php include 'content_footer.php'; ?>
