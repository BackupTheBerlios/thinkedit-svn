<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo te_title()?></title>
    
    <style type="text/css" media="screen">
        @import url("<?php echo te_design() ?>/css/tools.css");
        @import url("<?php echo te_design() ?>/css/typo.css");
        @import url("<?php echo te_design() ?>/css/forms.css");
        /* swap layout stylesheet: 
        layout-navtop-localleft.css
		layout-navtop-subright.css
		layout-navtop-3col.css
		layout-navtop-1col.css
		layout-navleft-1col.css
		layout-navleft-2col.css*/
        @import url("<?php echo te_design() ?>/css/layout-navtop-localleft.css");
        @import url("<?php echo te_design() ?>/css/layout.css");
    </style>
</head>

<body>
    
    <div id="page">
    
        <div id="header" class="clearfix">
        
            <div id="branding">
               Logo
            </div><!-- end branding -->
            
            <div id="search">
                <form method="post" action="">
					<div><label for="search-site">Search</label>
					<input type="text" name="search" id="search-site" />
                    <input type="submit" value="go" name="search" id="search" /></div>
				</form>
            </div><!-- end search -->
            	
            <hr />
        </div><!-- end header -->
        
        
        <div id="content" class="clearfix">
        
            <div id="main">
