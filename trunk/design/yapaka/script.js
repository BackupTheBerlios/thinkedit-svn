function jump(targ,selObj,restore)
{ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
}


function popup(url, name)
{
		var newwindow = window.open(url,name,'height=550,width=650,scrollbars=yes,resizable=yes,modal=yes,toolbar=yes');
		//window.open(url,'name','height=400,width=500,scrollbars=yes,resizable=yes,modal=yes');
		
		
		if (!newwindow.opener)
		{
				newwindow.opener = self;
		}
		
		if (window.focus) 
		{
				newwindow.focus();
		}
		
		return false;
}

