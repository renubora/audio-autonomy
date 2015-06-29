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
$user = $_POST['user'];
$pass = $_POST['pass'];

wLog("w_login.php attempting web login for " . $user);
db_connect();

$r = (string)rand(1, 65536);
setcookie('groundhog', $user . "_" . $r);

guery("update caregivers set cookie='" . $r . "' where userName='" . $user . "'");
$pin = guery("select password from caregivers where userName='" . $user . "'");

if($pin){
  // print redirect
  print "<html>";
  print "  <head>";
  print "    <title>Groundhog Redirect</title>";
  print "    <meta http-equiv='refresh' content='2; URL=w_t.php'>";
  print "  </head>";
  print "  <body>";
  print "    If not redirected click <a href='w_t.php'>here</a>";
  print "  </body>";
  print "</html>";
}
else{
  print "Unknown User";
}

db_close();
?>