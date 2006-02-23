<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

//xdebug_dump_function_profile();

/*
Thinkedit INITIALIZATION file

This file must be included on every page.

It will only define one global var called $thinkedit. 
This is the single starting point of your application, because with this $thinkedit-> object, 
you have everything you need.

*/


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


/*********************** Required includes ******************/


require_once dirname(__FILE__) . '/class/thinkedit.class.php';
require_once dirname(__FILE__) . '/class/user.class.php';
require_once dirname(__FILE__) . '/class/config.class.php';
require_once dirname(__FILE__) . '/class/timer.class.php';





/*********************** Find config file ******************/
// this simple thing will check two parents levels deep to find a config folder. 
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


require_once dirname(__FILE__) . '/lib/thinkedit/tools.inc.php';

/*********************** Timer ******************/
$thinkedit->timer = new timer();
$thinkedit->timer->marker('start init');

// no more global $thinkedit->config
// $thinkedit->config = $thinkedit->newConfig();
/*********************** Configuration object ******************/
$thinkedit->configuration = $thinkedit->newConfig();




/*********************** ROOT, PATH, URL constants ******************/
define ('ROOT', $thinkedit->configuration->getRootPath(dirname(__FILE__)));
define ('ROOT_PATH', $thinkedit->configuration->getRootPath(dirname(__FILE__)));
define ('ROOT_URL', $thinkedit->configuration->getRootUrl());
define ('TMP_PATH', $thinkedit->configuration->getTmpPath());


/*********************** Thinkedit USER ******************/
$thinkedit->user = new user();


/*********************** Thinkedit DB ******************/
$thinkedit->db = $thinkedit->getDb();


/*********************** Output Cache ******************/

// I hate pear global include system, so I have this "solution" :-/
require_once ROOT . '/lib/pear/cache/Lite/Output.php';
$options = array(
'cacheDir' => TMP_PATH,
'lifeTime' => 7200,
'pearErrorMode' => CACHE_LITE_ERROR_DIE
);
$thinkedit->outputcache = new Cache_Lite_Output($options);


/*********************** Function Cache ******************/

// I hate pear global include system, so I have this "solution" :-/
require_once ROOT . '/lib/pear/cache/Lite/Function.php';
$options = array(
'cacheDir' => TMP_PATH,
'lifeTime' => 7200,
'pearErrorMode' => CACHE_LITE_ERROR_DIE
);
$thinkedit->functioncache = new Cache_Lite_Function($options);


/*********************** Cache ******************/
// I hate pear global include system, so I have this "solution" :-/
require_once ROOT . '/lib/pear/cache/Lite.php';
$options = array(
'cacheDir' => TMP_PATH,
'lifeTime' => 7200,
'pearErrorMode' => CACHE_LITE_ERROR_DIE,
'automaticSerialization' => true
);
$thinkedit->cache = new Cache_Lite($options);



/*********************** Error Reporting ******************/
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

$thinkedit->timer->marker('end init');

?>
