<html>

<style>
body
{
		font-family: verdana, arial, helvetica, sans-serif;
		font-size : 10px;
		background-color: #F6F6F6; 
}

.content
{
		width: 500px;
		padding: 20px;
		background-color: #E7E7E7;
		
		border-style: solid; 
		border-width: 1px;
		border-color: #FFFFFF #CCCCCC #CCCCCC #E9E9E9;
}

</style>

<body>

<div class="content">

<h1>Thinkedit installation wizard</h1>


<?php if (isset($out['info'])): ?>
<div class="info"><?php echo $out['info']?></div>
<?php endif; ?>


<?php if (isset($out['title'])): ?>
<h2><?php echo $out['title']?></h2>
<?php endif; ?>

<?php if (isset($out['help'])): ?>
<p><?php echo $out['help']?></p>
<?php endif; ?>

<?php if (isset($out['content'])): ?>
<p><?php echo $out['content']?></p>
<?php else: ?>
<a href="">Go to next step</a>
<?php endif; ?>


</div>
</body>

</html>
