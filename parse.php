<?php

$path = 'live_data.json';
$cpuTarget = $argv[1];
$result = '../'.$cpuTarget.'.json';
$lowest = 0;

$file = file_get_contents($path, true);
$decoded = json_decode($file,true);
foreach ($decoded['server'] as $server) {
  if ($server['cpu'] == $cpuTarget || strpos($server['cpu'], $cpuTarget) !== false) {
    if ($lowest == 0) { $lowest = $server['price']; } elseif ($server['price'] < $lowest) { $lowest = $server['price']; }
  }
}

//$timestamp = strtotime(date ("F d Y H:i:s.", filemtime($path)));
$payload[] = array('lowest' => $lowest);

if (file_exists($result)) { $tmp = file_get_contents($result); $tempArray = json_decode($tmp); } else { $tempArray = array($cpuTarget); }

array_push($tempArray, $payload);
$jsonData = json_encode($tempArray);
file_put_contents($result, $jsonData);

?>
