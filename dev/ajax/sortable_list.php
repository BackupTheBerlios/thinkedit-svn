<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html>
<head>
<title>phpRiot Sortable Lists</title>
<link rel="stylesheet" type="text/css" href="styles.css" />

<script type="text/javascript" src="scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="scriptaculous/src/scriptaculous.js"></script>

<style>
.sortable-list {
    list-style-type : none;
    margin : 0;
}
.sortable-list li {
    border : 1px solid #000;
    cursor : move;
    margin : 2px 0 2px 0;
    padding : 3px;
    background : #f7f7f7;
    border : #ccc;
    width : 400px;
}
</style>

</head>
<body>
<h1>Sortable Lists</h1>

<ul id="movies_list" class="sortable-list">
<?php for ($i=0; $i< 10; $i++): ?>
<li id="movie_<?php echo $i ?>">List nr. <?php echo $i ?></li>
<?php endfor; ?>
</ul>

<script type="text/javascript">
Sortable.create('movies_list');
</script>



</body>
</html>
