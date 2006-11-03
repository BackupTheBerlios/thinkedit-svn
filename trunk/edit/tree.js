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



$(document).ready(function()
{
	handle_node_publish();
});


function get_node_id(node_id)
{
	id = node_id.substring(5, node_id.length);
	return id;
}


function handle_node_publish()
{
	$('a.published').unclick();
	$('a.published').click(function()
	{
		button = this;
		node_id = get_node_id($(this).parents('.node').id());
		
		//alert('publish ' + node_id);
		$.ajax({
			type: "POST",
			url: "api.php",
			data: "action=node_unpublish&node_id=" + node_id,
			success: function(data){
				/*alert( "Data Saved: " + msg );*/
				message =  $('message', data).text();
				result = $('result', data).text();
				
				if (result == 1)
				{
					//alert (message);
					$('img', button).src('ressource/image/icon/small/lightbulb_off.png');
					$(button).addClass("unpublished");
					$(button).removeClass("published");
					handle_node_publish()
				}
				else
				{
					alert (message);
				}
			}
		});
		
		return false;
	});
	
	$('a.unpublished').unclick();
	$('a.unpublished').click(function()
	{
		button = this;
		node_id = get_node_id($(this).parents('.node').id());
		
		//alert('publish ' + node_id);
		$.ajax({
			type: "POST",
			url: "api.php",
			data: "action=node_publish&node_id=" + node_id,
			success: function(data){
				/*alert( "Data Saved: " + msg );*/
				message =  $('message', data).text();
				result = $('result', data).text();
				if (result == 1)
				{
					//alert (message);
					$('img', button).src('ressource/image/icon/small/lightbulb.png');
					$(button).addClass("published");
					$(button).removeClass("unpublished");
					handle_node_publish()
				}
				else
				{
					alert (message);
				}
			}
		});
		
		return false;
	});
	
}



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
		$('#node_' + id + ' ul').load('node.php?node_id=' + id, init_nodes);
		$('#node_' + id).attr('loaded', true);
	}
	
	
}

function init_nodes()
{
	
	// remove all click handlers
	$('.node .icon').unclick();
	
	
	// add open close click handler
	$('.node .icon').click(function()
	{
		node_id = $(this).parent().id();
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
	
	handle_node_publish();
	
}

