<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>List based folder tree</title>
	<link rel="stylesheet" href="css/folder-tree-static.css" type="text/css">
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/folder-tree-static.js"></script>

	<script type="text/javascript" src="js/folder-tree-static.js"></script>

	<script src="../../lib/scriptaculous/lib/prototype.js" type="text/javascript"></script>
  <script src="../../lib/scriptaculous/src/scriptaculous.js" type="text/javascript"></script>
	
	<script type="text/javascript" language="javascript">
  Sortable.create('test')
</script>


</head>
<body>
	<p>Tree where sub nodes are loaded dynamically</p>
	<ul id="dhtmlgoodies_tree" class="dhtmlgoodies_tree">
		<li><a href="#">Root</a>
			<ul id="test">
				<li parentId="1"><a href="#">Loading...</a></li>
			</ul>
		</li>
	<ul>
	<a href="#" onclick="expandAll('dhtmlgoodies_tree');return false">Expand all</a>
	<a href="#" onclick="collapseAll('dhtmlgoodies_tree');return false">Collapse all</a>
	
</body>
</html>
