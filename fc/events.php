<?php
require_once dirname(__FILE__) . '/../funk.php';
list($user, $r) = explode("_", $_COOKIE['groundhog']);
$caregiver = fullGuery("select * from caregivers where userName='" . $user . "' and cookie='" . $r . "'");

// Die if cookie doesn't match what's in MySQL
if(! $caregiver){
  wLog("fc_events.php Alert, cookie value did not match MySQL, userName:" . $user . " r:" . $r);
  exit(0);
}else{
  wLog("fc_events.php caregiverID:" . $caregiver['ID'] . " patientID:" . $caregiver['patientID']);
}

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
  $timezone = new DateTimeZone($_GET['timezone']);
}

// List of events
$json = array();

wLog("SELECT ID, title, start FROM events WHERE patientID=" . $caregiver['patientID'] . 
     " AND start BETWEEN '" . $range_start->format("Y-m-d H:i:s") . "' AND '" . $range_end->format("Y-m-d H:i:s") . 
     "' ORDER BY ID");

// Query that retrieves events
$request = "SELECT id, title, start FROM events WHERE patientID=" . $caregiver['patientID'] . 
  " AND start BETWEEN '" . $range_start->format("Y-m-d H:i:s") . "' AND '" . $range_end->format("Y-m-d H:i:s") . 
  "' ORDER BY id";

// connection to the database
try {
$bdd = new PDO('mysql:host=localhost;dbname=groundhog', 'root', 'abc123');
} catch(Exception $e) {
 exit('Unable to connect to database.');
}

// Execute the query
$result = $bdd->query($request) or die(print_r($bdd->errorInfo()));

// sending the encoded result to success page
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
?>
