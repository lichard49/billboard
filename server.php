<?php

$fileName = "./state.txt";

if (isset($_GET["state"])) {

  // set
  header("Access-Control-Allow-Origin: *");

  $file = fopen($fileName, "w");
  fwrite($file, $_GET["state"] . "\n");
  fclose($file);
  echo 1;

} else {

  // get
  header("Content-Type: text/event-stream");
  header("Cache-Control: no-cache");
  header("Connection: keep-alive");

  $contents = file_get_contents($fileName);
  // set interval of SSE
  echo "retry: 100\n";
  echo "data: " . $contents . "\n\n";
  ob_flush();
  flush();

}
?>
