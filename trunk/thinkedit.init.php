<?php
/*
Thinkedit, Web based Content and Data Management System
Copyright (C) 2000-2006  Philippe Jadin 
philippe@123piano.com (preferred)
philippe@thinkedit.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/


// should we keep root ? Maybe te_root (te for thinkedit) would be better

require_once dirname(__FILE__) . '/lib/thinkedit/tools.inc.php';
require_once dirname(__FILE__) . '/class/thinkedit.class.php';
require_once dirname(__FILE__) . '/class/user.class.php';
require_once dirname(__FILE__) . '/class/config.class.php';


// this simple thing will check two parents levels to find a config folder. 
// This way you can store it outside the webserver doc root
if (is_dir(dirname(__FILE__) . '/config/'))
{
		$thinkedit = new thinkedit(dirname(__FILE__) . '/config/');
		if ($thinkedit->isInProduction())
		{
				// todo security : check if the config folder is really out of the server doc root
				trigger_error('config folder is still within the doc root, move it outside docroot', E_USER_WARNING);
		}
}
elseif (is_dir(dirname(__FILE__) . '/../config/'))
{
		$thinkedit = new thinkedit(realpath(dirname(__FILE__) . '/../config/'));
}
elseif (is_dir(dirname(__FILE__) . '/../../config/'))
{
		$thinkedit = new thinkedit(realpath(dirname(__FILE__) . '/../../config/'));
}
else
{
		die('config folder not found');
}

$config = $thinkedit->newConfig();

define ('ROOT', $config->getRootPath(dirname(__FILE__)));
define ('ROOT_PATH', $config->getRootPath(dirname(__FILE__)));
define ('ROOT_URL', $config->getRootUrl());
define ('TMP_PATH', $config->getTmpPath());

$user = new user();


// turn on error reporting
if ($thinkedit->isInProduction())
{
		error_reporting(0);
		ini_set('display_errors', false);
}
else
{
		error_reporting(E_ALL);
		ini_set('display_errors', true);
}


?>
