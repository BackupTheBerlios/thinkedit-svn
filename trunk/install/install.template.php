<html>
<head>
<link type="text/css" href="../edit/ressource/css/style.css" rel="stylesheet" media="screen"/>
<link type="text/css" href="install.css" rel="stylesheet" media="screen"/>

</head>
<body>
<div class="thinkedit">

<div class="install_header">
<a href="index.php"><img src="../edit/ressource/image/general/thinkedit_logo.gif" alt="" border="0"/></a>	
</div>

<div class="install_main_title">
Thinkedit installation wizard
</div>


<?php if (isset($out['title'])): ?>
<div class="install_title"><?php echo $out['title']?></div>
<?php endif; ?>


<?php if (isset($out['info'])): ?>
<div class="install_info"><?php echo $out['info']?></div>
<?php endif; ?>

<?php if (isset($out['help'])): ?>
<div class="install_help"><?php echo $out['help']?></div>
<?php endif; ?>

<?php if (isset($out['content'])): ?>
<div class="install_content"><?php echo $out['content']?></div>
<?php else: ?>
<div class="install_next_step_button"><a href="">Go to next step</a></div>
<?php endif; ?>



<div class="install_footer">
<a href="http://www.thinkedit.org">&copy; THINKEDIT.ORG open source CMS</a>
</div>

</div>

</body>

</html>
