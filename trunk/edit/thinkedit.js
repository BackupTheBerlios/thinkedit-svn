/*
function popup(url, title)
{
		window.open(url, title,'width=400,height=500')
}
*/


/* from http://www.quirksmode.org/js/croswin.html */

function popup(url, name)
{
		var newwindow = window.open(url,name,'height=400,width=500,scrollbars=yes,resizable=yes,modal=yes');
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


function custompopup(url, name, size)
{
		//alert(window.title);
		
		if(!size)
		{
				size = 50;
		}
		w = screen.width * size / 100;
		
		
		h = screen.height * size / 100;
		var winl = (screen.width-w)/2;
		var wint = (screen.height-h)/2;
		var settings ='height='+h+',';
		settings +='width='+w+',';
		settings +='top='+wint+',';
		settings +='left='+winl+',';
		settings +='scrollbars=yes,';
		settings +='resizable=yes';
		var newwindow=window.open(url,'name',settings);
		//window.open(url,name,settings);
		
		if (!newwindow.opener)
		{
				newwindow.opener = self;
		}
		
		if (window.focus) 
		{
				newwindow.focus()
		}
		
		return false;
}


function toggle(targetId)
{
		if (document.getElementById)
		{
				target = document.getElementById( targetId );
				if (target.style.display == "none")
				{
						target.style.display = "block";
				}
				else 
				{
						target.style.display = "none";
				}
		}
}

function hide_menus(id)
{
		menus = document.getElementsByClassName('context_menu');
		menus.each(function(menu)
		{
				if (id && menu.id == id)
				{
				}
				else
				{
						Element.hide(menu);
				}
				
		});
}

function toggle_and_move(id, e)
{
		moveObject(id, e);
		hide_menus(id);
}


function moveObject( obj, e ) 
{
		// step 1
		var tempX = 0;
		var tempY = 0;
		var offset = 5;
		var objHolder = obj;
		
		// step 2
		obj = document.getElementById( obj )
		if (obj==null) return;
		
		// step 3
		if (document.all) 
		{
				tempX = event.clientX + document.body.scrollLeft;
				tempY = event.clientY + document.body.scrollTop;
		} 
		else 
		{
				tempX = e.pageX;
				tempY = e.pageY;
		}
		
		// step 4
		if (tempX < 0)
		{
				tempX = 0
		}
		
		if (tempY < 0)
		{
				tempY = 0
		}
		
		// step 5
		obj.style.top  = (tempY + offset) + 'px';
		obj.style.left = (tempX + offset) + 'px';
		
		// step 6
		toggle(objHolder);
}





function to_opener(url)
{
		opener.location.href = url;
}

function reload_opener()
{
		opener.location.reload();
}

function self_close()
{
		self.close();
}

function popup_save()
{
		reload_opener();
		self_close();
}

function popup_cancel()
{
		self_close();
}


function edit_save()
{
		self.close();
}


function to_opener_field(field, value)
{
		window.opener.document.edit_form[field].value = value;
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


function ask_title(targ,selObj,restore,text)
{ //v3.0
		title =  prompt(text);
		if (title)
		{
				eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"&title=" + title +"'");
		}
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
				iframeElement.style.height = iframeWindow.document.height + 50 + 'px';
    }
		else if (document.all) {
				var iframeElement = parent.document.all[iframeWindow.name];
				if (iframeWindow.document.compatMode && iframeWindow.document.compatMode != 'BackCompat') 
				{
						iframeElement.style.height = iframeWindow.document.documentElement.scrollHeight +  50 +  'px';
						
				}
				else {
						iframeElement.style.height = iframeWindow.document.body.scrollHeight  + 50 +  'px';
				}
		}
}
