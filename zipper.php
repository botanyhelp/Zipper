<?php
function createZip($files = array(),$fullPathDestination = '') {
  $valid_files = array();
  if(is_array($files)) {
    foreach($files as $file) {
      if(!file_exists($file)) {
        echo 'FAIL: BAD FILES ARRAY!<br />';
        return false;
      }
    }
  }
  if(count($files)) {
    $zipfile = new ZipArchive();
    if($zipfile->open($fullPathDestination, ZIPARCHIVE::OVERWRITE) !== true) {
      return false;
    }
    foreach($files as $file) {
      //the second arg lets us rename files, but lets not rename:
      $zipfile->addFile($file,$file);
    }
    echo $zipfile->numFiles,' files were added to zip with a status of ',$zipfile->status, '<br />';
    $zipfile->close();
    return file_exists($fullPathDestination);
  }
  else
  {
    return false;
  }
}

echo 'This next bit of test code assumes that these three files exist:<br />';
echo ' /tmp/one.txt<br />';
echo ' /tmp/two.txt<br />';
echo ' /tmp/three.txt<br />';
echo ' go ahead and make those files first before running. <br />';
echo ' Next we create that zip:<br />';

$files = array('/tmp/one.txt', '/tmp/two.txt', '/tmp/three.txt');
$zipFullPath = '/tmp/onetwothree.zip';
$retValue = createZip($files, $zipFullPath);

if($retValue){ 
  echo 'SUCCESS: zipfile got made at ', $zipFullPath, '<br />';
}else{
  echo 'FAIL: Something bad happened <br />';
}
?>
