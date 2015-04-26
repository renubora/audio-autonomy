<?php
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