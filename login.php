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
$ani = $_GET['ani'];
wLog("login.php attempting login for " . $ani);
db_connect();

$r = (string)rand(1, 65536);
setcookie('groundhog', $ani . "_" . $r);

guery("update patients set cookie='" . $r . "' where phone='" . $ani . "'");
$pin = guery("select pin from patients where phone='" . $ani . "'");

if($pin) print docReplace(file_get_contents('login.vxml'), $pin);
else{
  print file_get_contents('no_user.vxml');
}

db_close();
?>