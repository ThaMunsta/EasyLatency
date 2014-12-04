<?php

/* Port Checking PHP Script
   Created by Jonesy44
   Released: 30 November, 2008  */

echo '<title>Port Availability Checker';
//Please leave the next line :)
echo ', Writen by Jonesy44';
echo '</title>';

$addr = $_SERVER["REMOTE_ADDR"];
$port = "80";
if ($_GET["addr"]) {
  $addr = $_GET["addr"];
}
if ($_GET["port"]) {
  $port = $_GET["port"];
}
if ($_GET["port2"]) {
  $port2 = $_GET["port2"];
}
if ($_GET["pretext"]) {
  $pretext = $_GET["pretext"];
}
if ($_GET["posttext"]) {
  $posttext = $_GET["posttext"];
}

if ($_GET["addr"]) {
  if ($_GET["port"] && !$_GET["port2"]) {
    $start = microtime(true);
	$fp = @fsockopen($addr, $port, $errno, $errstr, 2);
	$finish = microtime(true);
	$time = round((($finish - $start) * 1000), 0)." ms";
    $success = "#FF0000";
    $success_msg = "can't be reached in >". $time;
    if ($fp) {
      $finish = microtime(true);
	  $time = round((($finish - $start) * 1000), 0)." ms";
	  $success = "#00FF00";
	  if ($time > 10) $success = "#99FF66";
	  if ($time > 40) $success = "#CCFF11";
	  if ($time > 100) $success = "#FFFF33";
	  if ($time > 200) $success = "#FF9933";
      $success_msg = "can be reached in ". $time;
    }
    @fclose($fp);
	echo '<div style="width:300px;background:' .$success. ';padding:10px;font-family:arial;font-size:12px;">
    <b>'.$pretext.'</b> The address <b>"' .$addr. ':' .$port. '"</b> ' .$success_msg.' <b>'.$posttext.'</b>
  </div>';
  }
  else if ($_GET["port"] && $_GET["port2"]) {
    $p1 = $_GET["port"];
    $p2 = $_GET["port2"];
    if ($p1 == $p2) {
      $fp = @fsockopen($addr, $port, $errno, $errstr, 2);
      $success = "#FF0000";
      $success_msg = "is closed";
      if ($fp) {
        $success = "#99FF66";
        $success_msg = "is open";
      }
      @fclose($fp);
      echo '<div style="width:300px;background:' .$success. ';padding:10px;font-family:arial;font-size:12px;">
      The address <b>"' .$addr. ':' .$port. '"</b> ' .$success_msg. '
      </div>';
    }
    else {
      if ($p1 < $p2) {
        $s = $p1;
        $st = $p1;
        $e = $p2;
      }
      else if ($p2 < $p1) {
        $s = $p2;
        $st = $p2;
        $e = $p1;
      }
      while ($s <= $e) {
        $fp = @fsockopen($addr, $s, $errno, $errstr, 1);
        if ($fp) {
          $p_open = $p_open. " " .$s;
          $p_1 = 1;
        }
        @fclose($fp);
        $s++;
      }
      if ($p_1) {
        $c = "#99FF66";
        $m = "On the address <b>" .$addr. "</b> and port range <b>" .$st. "-" .$e. "</b> the following ports were open: " .$p_open;
      }
      else {
        $c = "#FF0000";
        $m = "No ports on the address <b>" .$addr. "</b> and port range <b>" .$st. "-" .$e. "</b> were open";
      }
      echo '<div style="width:300px;background:' .$c. ';padding:10px;font-family:arial;font-size:12px;">' .$m. '</div>';
    }
  }
}
?>