function popup(url, title)
{
		window.open(url, title,'width=400,height=500')
}


function confirm_link(message, url)
{
		input_box=confirm(message);
		if (input_box==true)
		{ 
				// Output when OK is clicked
				window.location.href=url; 
		}
		else
		{
				return false;
		}
}

function confirm_link(message, url)
{
		input_box=confirm(message);
		if (input_box==true)
		
		{ 
				// Output when OK is clicked
				window.location.href=url; 
		}
		
		else
		{
				return false;
		}
		
}

function jump(targ,selObj,restore)
{ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
}


function page_loaded() 
{
		document.getElementById('loading').style.display='none';
}


function protect_links()
{
		var links = document.getElementsByTagName("a");
		for (i = 0; i < links.length; i++) 
		{
				//links[i].style.display = "none";
				links[i].setAttribute('onclick', "return is_page_saved();");
		} 
}

function is_page_saved()
{
		if (user_changed == 1)
		{
				if (window.confirm('Cliquez sur OK pour quitter cette page sans sauver votre travail'))
				{
						// alert('ok');
						return true;
				}
				else
				{
						//alert('Cancel');
						return false;
				}
		}
		else
		{
				return true;
		}
}

// use this to request a save confirm dialog on change of content on the poweredit
function set_user_changed()
{
		user_changed = 1;
}


function adjustIFrameSize (iframeWindow) 
{
  if (iframeWindow.document.height) {
    var iframeElement = parent.document.getElementById(iframeWindow.name);
    iframeElement.style.height = iframeWindow.document.height +  'px';
    }
  else if (document.all) {
    var iframeElement = parent.document.all[iframeWindow.name];
    if (iframeWindow.document.compatMode && iframeWindow.document.compatMode != 'BackCompat') 
    {
      iframeElement.style.height = iframeWindow.document.documentElement.scrollHeight +  5 +  'px';

    }
    else {
      iframeElement.style.height = iframeWindow.document.body.scrollHeight  + 5 +  'px';
    }
  }
}
