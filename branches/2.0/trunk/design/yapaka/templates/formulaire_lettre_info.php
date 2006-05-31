<?php include te_design_path() . '/content_header.php'; ?>

<?php if ($content->get('sub_title') <> ''): ?>
<div class="content_title">
<?php echo $content->get('sub_title'); ?>
</div>
<?php else: ?>
<div class="content_title">
<?php echo $content->get('title'); ?>
</div>
<?php endif; ?>

<?php if (!$content->get('body')): ?>
<div class="intro">
<?php echo $content->get('intro'); ?>
</div>
<?php endif; ?>

<div class="content_text">
<?php echo $content->get('body'); ?>
</div>

<hr/>
<br/>

<div class="title_intro">
Abonnez-vous à la newsletter
</div>


<form name="remote" method="post" action = "http://www.lalettre.cfwb.be/multidatabase/arrow/ar_RemoteSave.asp">

<table>
<tr>
<td>Nom:</td>
<td><input type="textbox" name="FirstName" maxlength="50"></td>
</tr>

<tr>
<td>Prénom:</td>
<td><input type="textbox" name="LastName" maxlength="50"></td>
</tr>
<tr>
<td>Courriel:</td>
<td><input type="textbox" name="Email" maxlength="255"></td>
</tr>

</table>


<br/>

<input type="hidden" name="adddel" value="add">
<input type="hidden" name="ListID" value="7">

Format du courriel:<br/>
<input type="radio" name="mailtype" value="0" checked="checked"> HTML (avec images)	<br/>
<input type="radio" name="mailtype" value="1"> Texte (sans images)<br/>

<input type = "hidden" name ="remotepagecolor" value ="#FFFFFF">
<input type = "hidden" name ="remotesize" value ="300">
<input type = "hidden" name ="remotebordercolor" value ="#000000">
<input type = "hidden" name ="remotebgcolor" value ="#FFFFFF">
<input type = "hidden" name ="remotefont" value ="Arial,Helvetica,Sans-Serif">
<input type = "hidden" name ="remotefontsize"  value ="2">

<input type = "hidden" name ="remotefontcolor" value ="#000000">
<input type = "hidden" name ="remotepopup" value ="off">
<input type = "hidden" name ="thankurl" value ="">
<input type = "hidden" name ="errorurl" value ="">
<input type = "hidden" name ="popupwidth"  value ="350">
<input type = "hidden" name ="popupheight" value ="450">
<input type = "hidden" name ="linktext " value ="Click here to sign up">
<input type = "hidden" name ="remotelinkcolor" value ="#330066">
<input type = "hidden" name ="remotetitle" value ="Click+here+to+sign+up">
<input type = "hidden" name ="UserID" value ="8">

<br/>
<input type="submit" name="Submit" value="S'abonner">
</form>




<?php include te_design_path() . '/content_footer.php'; ?>

