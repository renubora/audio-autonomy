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

require_once '../funk.php';
list($user, $r) = explode("_", $_COOKIE['groundhog']);
$caregiver = fullGuery("select * from caregivers where userName='" . $user . "' and cookie='" . $r . "'");

// Die if cookie doesn't match what's in MySQL
if(! $caregiver){
  wLog("fc_submit.php Alert, cookie value did not match MySQL, userName:" . $user . " r:" . $r);
  exit(0);
}

// Values received via ajax
$act = trim($_POST['act']);
$title = trim($_POST['title']);
$start = trim(str_replace('T', ' ', $_POST['start']));
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$allDay = $_POST['allDay'];
$question = trim($_POST['question']);
$response = trim($_POST['response']);

$argList = "";
$className = "fc-event";

if($allDay == 'true') {
$argList = $question . '_' . $response;
$className = 'fc-event-question';
}


wLog("fc_submit.php act:" . $act . " title:" . $title . " start:" . $start .  " eventID:" . $id . 
     " patientID:" . $caregiver['patientID']);

switch($act){
  case 'new':
    $db = new PDO('mysql:host=localhost;dbname=groundhog', 'root', 'abc123');
    $db->exec("Insert into events(title, className, allDay, argList, start, patientID) values('" . $title . "','" . $className . "','". $allDay . "','" 
        . $argList . "','" . $start . "'," . $caregiver['patientID'] . ")");
    /*$db->exec("Insert into events(title, start, patientID, allDay) values('". $title . "','" . $start . "','" . 
              $caregiver['patientID'] . "','" . 'yay' . "','" . ")" );*/
    echo json_encode($db->lastInsertId(), JSON_NUMERIC_CHECK);
    break;

  case 'mod':
    fullGuery("Update events set start='" . $start . "' where id=" . $id);
    break;

  case 'del':
    fullGuery("Delete from events where id=" . $id);
    break;
}

?>
