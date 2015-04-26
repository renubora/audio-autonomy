<?php
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
