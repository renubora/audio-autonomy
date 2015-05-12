<?php
include 'funk.php';

list($ani, $r) = explode("_", $_COOKIE['groundhog']);
db_connect();
$patient = guery("select * from patients where phone='" . $ani . "' and cookie='" . $r . "'");

// Die if cookie doesn't match what's in MySQL
if(! $patient){
  wLog("Alert, cookie value did not match MySQL, ani:" . $ani . " r:" . $r);
  exit(0);
}

if(isset($_GET['a'])){
  $app = $_GET['a'];
  $choice = $_GET['c'];
  wLog("t.php patient:" . $patient['ID'] . " app:" . $app . " choice:" . $choice);
  switch($app){
    case 'home':
      switch($choice){
        case 'help':
          print file_get_contents('help.vxml');
          break;
        case 'favSong':
          print file_get_contents('favSong.vxml');
          break;
        case 'scam':
          print file_get_contents('scam1.vxml');
          break;
        case 'med':
          print docReplace(file_get_contents('passiveAnswer.vxml'),
                           array('passive_answer' => 'It is now 2pm. This is uncle Ray New reminding you to take your Zan axe.'));
          break;
        case 'pqa': // Our passive Q&A
          // Get our allDay event
          $today = date("Y-m-d") . " 00:00:00";
          $p = guery("SELECT title,argList FROM events WHERE allDay='true' AND patientID=" . $patient['ID'] . 
                     " AND start='" . $today . "' limit 1");

          list($junk, $answer) = explode("_", $p['argList']);

          // Remove any nasty punctuation
          foreach($punc as $p){
            $answer = str_replace($p, "", $answer);
          }
          $answer = trim($answer);
          wLog("t.php patientID:" . $patient['ID'] . " Passive QA answer:" . $answer);

          print docReplace(file_get_contents('passiveAnswer.vxml'), array('passive_answer' => $answer));
          break;
     }
     break;
    case 'favSong':
      switch($choice){
        case 'repeat':
          print file_get_contents('favSong.vxml');
          break;
      }
      break;
    case 'help':
      switch($choice){
        case 'dial':
          $p = guery("SELECT helpNumber FROM patients WHERE ID=" . $patient['ID']);
          wLog("t.php patientID:" . $patient['ID'] . " help->dial helpNumber:" . $p['helpNumber']);
          print docReplace(file_get_contents('dialHelp.vxml'), array('help_number' => $p['helpNumber']));
          break;
      }
      break;
  }
}else{
  $now = time();
  $sTime = date("Y-m-d H:i:s", $now - ($timeSlice/2) - $timeSliceDiff);
  $eTime = date("Y-m-d H:i:s", $now + ($timeSlice/2) + $timeSliceDiff);

  $nap = guery("SELECT title FROM events WHERE patientID=" . $patient['ID'] . " AND start BETWEEN '" . 
                  $sTime . "' AND '" . $eTime . "'");
  $nextApp = isset($nap) ? $nap['title'] : None;

  wLog("t.php patientID:" . $patient['ID'] . " nextApp:" . $nextApp . " now:" . $now);
  switch($nextApp){
    case 'Fraud Prevention':
      print file_get_contents('scam1.vxml');
      break;
    case 'Play Favorite Song':
      print file_get_contents('favSong.vxml');
      break;
    case 'Oven Reminder':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is a reminder to turn off the oven"));
      break;
    case 'Pet Feeding Reminder':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is a reminder to feed your pet"));
      break;
    case 'Medication Reminder':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is a reminder to take your medication"));
      break;
    case 'GroomingReminder':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is a reminder to groom yourself"));
      break;
    case 'Prayer Reminder':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is a reminder to pray"));
      break;
    case 'Play Song Playlist':
      print docReplace(file_get_contents('passiveAnswer.vxml'), 
                       array("passive_answer" => "This is not yet implemented"));
      break;
    default:
      wLog("t.php patientID:" . $patient['ID'] . " nextApp:default" );
      $defaultArgs = array("time_slice" => $timeSlice);

      // Get our allDay event
      $today = date("Y-m-d") . " 00:00:00";
      $p = guery("SELECT title,argList FROM events WHERE allDay='true' AND patientID=" . $patient['ID'] . 
                   " AND start='" . $today . "' limit 1");
      if($p){
        list($question, $junk) = explode("_", $p['argList']);

        // Remove any nasty punctuation
        foreach($punc as $p){
          $question = str_replace($p, "", $question);
        }
        $question = trim($question);
        wLog("t.php patientID:" . $patient['ID'] . " Passive QA question:" . $question);

        // Build the VXML Q&A
        $defaultArgs['passive_question_ASR'] = "<item>" . $question . "</item>";
        $defaultArgs['passive_question_if'] = "<elseif cond=\"choice == '" . $question . "'\"/>" .
          "<goto next=\"t.php?a=home&amp;c=pqa\"/>";

      }else{
        $defaultArgs['passive_question_ASR'] = "";
        $defaultArgs['passive_question_if'] = "";
      }
      print docReplace(file_get_contents('home.vxml'), $defaultArgs);
      break;      
  }
}

db_close();
exit(0);

?>
