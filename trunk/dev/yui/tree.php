<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Yahoo tree</title>

<script src="../../lib/yui/build/yahoo/yahoo.js"></script>
<script src="../../lib/yui/build/treeview/treeview.js"></script>
<script src="../../lib/yui/build/event/event.js"></script>
<script src="../../lib/yui/build/connection/connection.js"></script>
<script src="json.js"></script>


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
	/*
	* This is an example callback object with success
	* and failure members defined inline.  The argument
	* property demonstrates how to pass multiple values
	* to the callback as an array.
	*/
	
	var responseSuccess = function(o)
	{
		/* Please see the Success Case section for more
		* details on the response object's properties.
		* o.tId
		* o.status
		* o.statusText
		* o.getResponseHeader[ ]
		* o.getAllResponseHeaders
		* o.responseText
		* o.responseXML
		* o.argument
		*/
		results = o.responseText.parseJSON();
		//result = eval(o.responseText);
		//alert(results.nodes[0].title);
		
		
		
		//alert(results["nodes"].toString());
		
		//var mynode = new YAHOO.widget.TextNode(results.nodes[0].title, node, false);
		//fnLoadComplete();
		if (results.results)
		{
			for (var i = 0; i < results["nodes"].length; i++) 
			{
				// Do something with a[i]
				//alert (results["nodes"][i].title);
				var myobj = { label: results["nodes"][i].title, id:results["nodes"][i].id };
				var mynode = new YAHOO.widget.TextNode(myobj, node, false);
			}
		}
		fnLoadComplete();
		
	};
	
	var responseFailure = function(o)
	{
		// Access the response object's properties in the
		// same manner as listed in responseSuccess( ).
		// Please see the Failure Case section and
		// Communication Error sub-section for more details on the
		// response object's properties.
		alert('failed connecting to backend');
	}
	
	var callback =
	{
		success:responseSuccess,
		failure:responseFailure,
	}
	
	
	
	
	// entryPoint is the base URL
	var entryPoint = 'nodelist.php';
	
	var queryString = encodeURI('?parent_id=' + node.data.id);
	var url = entryPoint + queryString;
	
	
	var transaction = YAHOO.util.Connect.asyncRequest('GET', url, callback, null);
	//Abort the transaction if it isn't completed in ten seconds. 
	//setTimeout("YAHOO.util.Connect.abort(transaction)",1000); 
	
	
	
	
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
