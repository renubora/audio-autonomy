<?php
// Development
error_reporting(E_ALL);

// An event scheduled for 0 will fire between (-1 * $timeSlice)/2 - $timeSliceDiff AND $timeSlice/2 + $timeSliceDiff
$timeSlice = 15; // Time in seconds between each HTTP GET from the VoiceXML browser
$timeSliceDiff = 5; // Our before and after tolerance in seconds

// Array of punctuation we want to remove from ASR or TTS
$punc = array(".", "!", "?", ",", "&", "\"", "'");

// Connect to mySQL database
function db_connect(){
  $mysqlhost = "localhost";
  $username = "root";
  $password = "abc123";

  $connection = mysql_connect($mysqlhost, $username, $password);
  if ($connection == false) echo mysql_errno().": ".mysql_error(); 
  mysql_select_db("groundhog") 
    or die("Could not select database");
}

// Closes the connection to the mySQL database
function db_close(){
  mysql_close(); 
}

// Executes a query in SQL
// Cleans up return value from MySQL
function guery($str){
  $res = mysql_query($str)
    or die("Query failed: " . mysql_error());

  if(is_bool($res)) return $res;
  elseif(mysql_num_rows($res) == 0){
    return False;
  }elseif(mysql_num_rows($res) == 1){
    return mysql_fetch_assoc($res);
  }else{
    $rv = array();
    for($ii=0; $ii < mysql_num_rows($res); $ii++){
      array_push($rv, mysql_fetch_assoc($res));
    }
    return $rv;
  }
}

// Simple one-liner for MySQL queries
function fullGuery($str){
  //  wLog("\nfullGuery str:" . $str);
  db_connect();
  $rv = guery($str);
  db_close();
  return $rv;
}

// Logs a string to our logfile
function wLog($str){
  $str = trim($str);
  $fp = fopen('t.log', 'a');
  fwrite($fp, "\n" . date("d/m/Y G:i:s") . " " . $str);
  fclose($fp);
  return True;
}

// Takes a doc as string and array of vals to replace in it
// Replaces all instances of vals found in doc buffered by $delim
// Returns doc with vals replaced
function docReplace($doc, $vals, $delim = '%%'){
  foreach($vals as $k => $v){
    $doc = str_replace($delim . $k . $delim, $v, $doc);
  }
  return $doc;
}

// Returns false if nothing scheduled for next 30 seconds
// Otherwise returns app that is scheduled
function nextApp(){
  return "scam1";
  //  return false;
}





?>
