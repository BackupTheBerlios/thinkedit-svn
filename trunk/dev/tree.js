$('document').ready(function()
{
	$("#loader").hide();
	
	$("#loader").ajaxStart(function(){
		$(this).show();
	});
	
	$("#loader").ajaxStop(function(){
		$(this).hide();
	});
	
	bind_click();
}
);


function load_node(id)
{
	$('#node_' + id + ' .child').load('get_tree.php?node_id=' + id, bind_click);
}

function bind_click()
{
	// remove all click handlers
	$('.node').unclick();
	
	$('.node').click(function()
	{
		node_id = $(this).id()
		id = node_id.substring(5, node_id.length)
		/*alert ('clicked on ' + id );*/
		load_node(id);
		return false;
	});
}

