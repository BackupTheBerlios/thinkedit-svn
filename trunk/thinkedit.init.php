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
define ('ROOT', dirname(__FILE__));

/*
// from http://codingforums.com/archive/index.php?t-3169.html :
$fullpath = 'http://'.$HTTP_SERVER_VARS[HTTP_HOST].$HTTP_SERVER_VARS[REQUEST_URI];
$thisfile = basename($fullpath);
$cutoffpos = strpos($fullpath,$thisfile);
$thisdir = substr($fullpath, 0, $cutoffpos);

if (isset($thisdir))
{
		define ('ROOT_URL', $thisdir);
}
else
{
		define ('ROOT_URL', '/thinkedit/trunk/'); //todo : find a way to compute this reliably
}

----------------
from http://be.php.net/reserved.variables :

Since $_SERVER['DOCUMENT_ROOT'] is not always present, the following will provide it where $_SERVER dosen't.

function resolveDocumentRoot() {
   $current_script = dirname($_SERVER['SCRIPT_NAME']);
   $current_path  = dirname($_SERVER['SCRIPT_FILENAME']);
  
    //work out how many folders we are away from document_root
    //   by working out how many folders deep we are from the url.
    //  this isn't fool proof 
   $adjust = explode("/", $current_script);
   $adjust = count($adjust)-1;
  
   //move up the path with ../ 
   $traverse = str_repeat("../", $adjust);
   $adjusted_path = sprintf("%s/%s", $current_path, $traverse);

   // real path expands the ../'s to the correct folder names 
   return realpath($adjusted_path);   
}



It counts the number of folders down the path we are in the URL, then moves that number of folders up the current path... end result should be the document root :)

It wont work with virtual folders or in any situation where the folder in the URL dosen't map to a real folder on the disk (like when using rewrites).

*/

define ('ROOT_URL', '/thinkedit/trunk'); //todo : find a way to compute this reliably


require_once ROOT . '/lib/thinkedit/tools.inc.php';
require_once ROOT . '/class/thinkedit.class.php';
require_once ROOT . '/class/user.class.php';
require_once ROOT . '/class/config.class.php';

$thinkedit = new thinkedit(ROOT . '/config/');
$user = new user();


// turn on error reporting
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);
ini_set('display_errors', true);


?>
