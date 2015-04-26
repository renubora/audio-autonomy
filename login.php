<?php
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