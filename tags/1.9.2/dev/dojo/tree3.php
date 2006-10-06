<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<script type="text/javascript">
	var djConfig = {isDebug: true, debugAtAllCosts: true };
</script>
<script type="text/javascript" src="../../lib/dojo/dojo.js"></script>
<script type="text/javascript">
	dojo.require("dojo.lang.*");
	dojo.require("dojo.widget.*");
	dojo.require("dojo.widget.Tree");
	dojo.require("dojo.widget.TreeRPCController");
	dojo.require("dojo.widget.TreeContextMenu");
	dojo.hostenv.writeIncludes();
</script>


</head>
<body>

<h4>Every action on node is done with RPCController. ContextMenu, DND on.<br>

strictFolders mode is OFF so you may add new children to ANY node not only folder.</h4>

<div dojoType="TreeContextMenu" toggle="explode" contextMenuForWindow="false" widgetId="treeContextMenu">
	<div dojoType="TreeMenuItem" treeActions="addChild" iconSrc="images/createsmall.gif" widgetId="treeContextMenuCreate" caption="Create"></div>
	<div dojoType="TreeMenuItem" treeActions="remove" iconSrc="images/removesmall.gif" caption="Remove" widgetId="treeContextMenuRemove"></div>
	<div dojoType="TreeMenuItem" treeActions="move" iconSrc="images/downsmall.png" caption="Up" widgetId="treeContextMenuUp"></div>
	<div dojoType="TreeMenuItem" treeActions="move" iconSrc="images/upsmall.png" caption="Down" widgetId="treeContextMenuDown"></div>
</div>

<script>

	dojo.addOnLoad(function() {
		dojo.event.topic.subscribe('treeContextMenuRemove/engage',
			function (menuItem) { dojo.widget.byId('treeController').removeNode(menuItem.getTreeNode()); }
		);


		dojo.event.topic.subscribe('treeContextMenuCreate/engage',
			function (menuItem) {
                            dojo.widget.byId('treeController').createChild(menuItem.getTreeNode(), 0, {title:"New node"});
                        }
		);


		dojo.event.topic.subscribe('treeContextMenuUp/engage',
			function (menuItem) {
                            var node = menuItem.getTreeNode();
                            if (node.isFirstNode()) return;
                            dojo.widget.byId('treeController').move(node, node.parent, node.getParentIndex()-1);
                        }
		);


		dojo.event.topic.subscribe('treeContextMenuDown/engage',
			function (menuItem) {
                            var node = menuItem.getTreeNode();
                            if (node.isLastNode()) return;
                            dojo.widget.byId('treeController').move(node, node.parent, node.getParentIndex()+1);
                        }
		);

	});
</script>

<div dojoType="TreeRPCController" widgetId="treeController" DNDcontroller="create" RPCUrl="rpc.php"></div>


<h4>firstTree</h4>

<div dojoType="Tree" DNDMode="between" expandLevel="2" controller="treeController" strictFolders="false" menu="treeContextMenu" toggle="fade" DNDacceptTypes="firstTree" widgetId="firstTree">
    <div dojoType="TreeNode" title="Item 1" isFolder="true" objectId='1'>
    </div>
</div>



</body>
</html>

