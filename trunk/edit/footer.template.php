<div class="tools">

<?php
echo te_admin_toolbox(); // todo
?>

</div>

</div>

<script src="thinkedit.js" type="text/javascript"></script>


<?php
if (function_exists('xdebug_dump_function_profile') && !$thinkedit->isInProduction())
{
		xdebug_dump_function_profile(4);
}
?>
</body>
</html>
