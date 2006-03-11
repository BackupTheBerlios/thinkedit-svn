<?php
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
philippe.jadin@gmail.com
philippe@thinkedit.org

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

// needed for ms iexplorer
header ("Content-Type: text/html; charset=utf-8");

//error_reporting(E_ALL);
//ini_set('display_errors', true);

if (function_exists('xdebug_start_profiling'))
{
		xdebug_start_profiling();
}


/******************* Define root constant ***************/
define ('ROOT', dirname(__FILE__));


/*********************** Required includes ******************/
require_once dirname(__FILE__) . '/class/thinkedit.class.php';


$thinkedit = new thinkedit();
$thinkedit->configuration = $thinkedit->newConfig();


require_once dirname(__FILE__) . '/lib/thinkedit/tools.inc.php';

/*********************** Timer ******************/

$thinkedit->timer = $thinkedit->getTimer();
$thinkedit->timer->marker('start init');


// no more global $thinkedit->config
// $thinkedit->config = $thinkedit->newConfig();
/*********************** Configuration object ******************/



/*********************** ROOT, PATH, URL constants ******************/
// define ('ROOT', $thinkedit->configuration->getRootPath(dirname(__FILE__)));
define ('ROOT_PATH', $thinkedit->configuration->getRootPath(dirname(__FILE__)));
define ('ROOT_URL', $thinkedit->configuration->getRootUrl());
define ('TMP_PATH', $thinkedit->configuration->getTmpPath());


/*********************** Thinkedit USER ******************/
$thinkedit->user = $thinkedit->getUser();


/*********************** Thinkedit DB ******************/
$thinkedit->db = $thinkedit->getDb();


/*********************** Cache *************************/
$thinkedit->outputcache = $thinkedit->getOutputCache();
$thinkedit->cache = $thinkedit->getCache();
$thinkedit->functioncache = $thinkedit->getFunctionCache();

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
