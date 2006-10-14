/*
$(document).ready(function()
{
	// $(".node").hide("slow");
	
	//$(".node").click(;
	
});
*/

$(document).ready(init_nodes);

function init_nodes()
{
	//$(".node").hide("slow");
	
	$("#loader").hide();
	
	$("#loader").ajaxStart(function(){
		$(this).show();
	});
	
	$("#loader").ajaxStop(function(){
		$(this).hide();
	});
	
	
	$(".node").click(function()
	{
		$(this).append("<div class=\"temp\"></div>");
		$(".temp", this).load("tree.php?id=" + $(this).id());
		init_nodes();
		//$(this).append("test").load("tree.php");
	});
	
	
	//node_click_handler();
	//load_node(1)
	
}

function load_node(node_id)
{
	$('#' + node_id).append("<div class=\"temp\"></div>");
	$('#' + node_id + ".temp").load("tree.php?id=" + node_id);
	//node_click_handler();
}


function node_click_handler()
{
	$(".node").unclick();
	$(".node").click(function()
	{
		load_node($(this).id());
	});
}







