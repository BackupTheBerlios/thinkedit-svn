// init of the drop down menu hover effet

previous_menu = false;

$(document).ready(function()
{
	$(".menu").click(function(event)
	{
		//$(this).next('.menu').slideDown('fast');
		if (previous_menu)
		{
			previous_menu.hide();
		}
		previous_menu = $('.menu_items', this).show();
		event.stopPropagation();
	});
	
	$(document).click(function()
	{
		if (previous_menu)
		{
			previous_menu.hide();
		}
	});
	
	
	/*
	$(".menu").hover(function (){}, function()
	{
		//$(this).next('.menu').slideDown('fast');
		alert('out of menu');
		setTimeout(function()
		{
			$('.menu_items', this).hide();
		}, 1000);
	});
	*/
	
});


