<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Yahoo tree</title>

<script src="../../lib/yui/build/yahoo/yahoo.js"></script>
<script src="../../lib/yui/build/treeview/treeview.js"></script>
<script src="../../lib/yui/build/event/event.js"></script>


<link rel="stylesheet" type="text/css" href="../../lib/yui/build/treeview/assets/tree.css">

<script>
var tree;
function treeInit() 
{
		tree = new YAHOO.widget.TreeView("tree");
		tree.setDynamicLoad(loadNodeData);
		var root = tree.getRoot();
		var tmpNode1 = new YAHOO.widget.TextNode("Mon site web", root, false);
		/*
		var tmpNode2 = new YAHOO.widget.TextNode("Second Node", root, false);
		var tmpNode3 = new YAHOO.widget.TextNode("Third Node", root, false);
		var tmpNode4 = new YAHOO.widget.TextNode("Fourth Node", root, false);
		var tmpNode5 = new YAHOO.widget.TextNode("Fifth Node", root, false);
		*/
		tree.draw();
}

YAHOO.util.Event.addListener(window, "load", treeInit);


function loadNodeData(node, fnLoadComplete) 
{
		if (Math.random(10) > 0.5)
		{
		var newNode = new YAHOO.widget.TextNode('test', node, false);
		var newNode2 = new YAHOO.widget.TextNode('test2', node, false);
		var newNode3 = new YAHOO.widget.TextNode('test3', node, false);
		}
		else
		{
				var newNode = new YAHOO.widget.TextNode('hop', node, false);
		var newNode2 = new YAHOO.widget.TextNode('blam', node, false);
		var newNode3 = new YAHOO.widget.TextNode('plop', node, false);
		}
		
		fnLoadComplete();
}

</script>


<style>
body
{
		font-family: sans-serif;
		font-size: 12px;
		
}
</style>

</head>
<body>


<div id="tree">
</div>

</body>
</html>
