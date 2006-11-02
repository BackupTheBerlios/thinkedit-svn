$('document').ready(function()
{
	$("#loader").hide();
	
	$("#loader").ajaxStart(function(){
		$(this).show();
	});
	
	$("#loader").ajaxStop(function(){
		$(this).hide();
	});
	
	init_nodes();
}
);


function reload_node(id)
{
	$('#node_' + id).attr('loaded', false);
	load_node(id);
}

function load_node(id)
{
	if ($('#node_' + id).attr('loaded'))
	{
		$('#node_' + id + ' ul').toggle();
	}
	else
	{
		$('#node_' + id).append('<ul></ul>');
		$('#node_' + id + ' ul').load('get_tree.php?node_id=' + id, init_nodes);
		$('#node_' + id).attr('loaded', true);
	}
	
	
}

function init_nodes()
{
	
	// remove all click handlers
	$('.node').unclick();
	
	
	// add open close click handler
	$('.node').click(function()
	{
		node_id = $(this).id();
		id = node_id.substring(5, node_id.length);
		/*alert ('clicked on ' + id );*/
		load_node(id);
		return false;
	});
	
	
	
	// bind context menu event
	$('.node').bind( "contextmenu", function() 
	{
		node_id = $(this).id();
		id = node_id.substring(5, node_id.length);
		showContextMenu('context_menu_node_' + id, this);
		//alert( 'context clicked' );
		return false;
	});
	
	
	
}

