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
		//alert('node ' + $(this).id() + ' cliqued');
		//$(this).append(("main.php"))
		//content = $.get("main.php");
		
		var test;
		
		//$(test).load("tree.php");
		
		//$(this).html( $(this).html() + $.get("tree.php"));
		
		//test = $.get("tree.php");
		
		//$(this).load("tree.php").$(this).html();
		
		node = $(this);
		
		$(node).load("tree.php");
		
		//$(this).append("test").load("tree.php");
	});
	
}








