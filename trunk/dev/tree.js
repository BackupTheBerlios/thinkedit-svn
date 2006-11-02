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
	//alert ($('#node_' + id).attr('loaded'));
	
	if ($('#node_' + id).attr('loaded'))
	{
		/*
		if ($('#node_' + id).attr('opened') == 1)
		{
			$('#node_' + id + ' ul').hide();
			$('#node_' + id).attr('opened', 1);
		}
		else
		{
			$('#node_' + id + ' ul').show();
			$('#node_' + id).attr('opened', 0);
		}
		*/
		
		$('#node_' + id + ' ul').toggle();
	}
	else
	{
		//$('#node_' + id).prepend('<img src="minus.gif"/>');
		$('#node_' + id).append('<ul></ul>');
		$('#node_' + id + ' ul').load('get_tree.php?node_id=' + id, init_nodes);
		$('#node_' + id).attr('loaded', true);
		/*$('#node_' + id).attr('opened', true);*/
	}
	
	
}

function init_nodes()
{
	
	// remove all click handlers
	$('.node').unclick();
	
	
	// add open close click handler
	$('.node').click(function()
	{
		node_id = $(this).id()
		id = node_id.substring(5, node_id.length)
		/*alert ('clicked on ' + id );*/
		load_node(id);
		return false;
	});
	
	
	/*
	$('ul').Sortable(
	{
		accept : 'node',
		activeclass : 'sortableactive',
		hoverclass : 'sortablehover',
		helperclass : 'sorthelper',
		containment: 'ul',
		opacity: 	0.5,
		fit :	true
	}
	);
	*/
	
	
	/*
	// bind context menu event
	$('.node').bind( "contextmenu", function() {
		alert( 'context clicked' );
		return false;
	});
	*/
	
	
}

