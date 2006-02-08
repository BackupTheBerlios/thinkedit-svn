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
