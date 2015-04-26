<?php
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

wLog("fc_submit.php act:" . $act . " title:" . $title . " start:" . $start .  " eventID:" . $id . 
     " patientID:" . $caregiver['patientID']);

switch($act){
  case 'new':
    $db = new PDO('mysql:host=localhost;dbname=groundhog', 'root', 'abc123');
    $db->exec("Insert into events(title, start, patientID) values('" . $title . "','" . $start . "'," . 
              $caregiver['patientID'] . ")");
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
