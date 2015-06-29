<?php

/*
Copyright (C) 2015,  Andrew McConachie and Renu Bora. All rights reserved.

This file is part of this program.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License Version 2 (GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

 You should have received a copy of the GNU General Public License Version 2 in LICENSE.txt in the root folder.  If not, see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

include 'funk.php';
list($user, $r) = explode("_", $_COOKIE['groundhog']);
db_connect();
$caregiver = guery("select * from caregivers where userName='" . $user . "' and cookie='" . $r . "'");

// Die if cookie doesn't match what's in MySQL
if(! $caregiver){
  wLog("w_t.php Alert, cookie value did not match MySQL, userName:" . $user . " r:" . $r);
  exit(0);
}

$app = isset($_POST['a']) ? $_POST['a'] : 'home';
wLog("w_t.php caregiver:" . $caregiver['userName'] . " app:" . $app);
switch($app){
  case 'home': // This should change once we have a caregiver homepage
    print file_get_contents('fc/events.html');
    break;
  case 'fc':
    print file_get_contents('fc/events.html');
    break;
  default:
    print file_get_contents('fc/events.html');
    break;
}

db_close();
?>
