<?php

function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}

if (isset($_GET["key"]) && isset($_GET["index"])) {
  $index = $_GET["index"];
  $directory = "../images/gallery";
  $files = scan_dir($directory);
  $result = array();

  for ($i = $index; $i < $index + 30; $i++) {
    if (!is_dir($directory."/".$files[$i])) {
      $result[] = $files[$i];
    }
  }

  echo json_encode($result);
}
?>