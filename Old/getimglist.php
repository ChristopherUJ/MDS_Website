<?php


function readFiles($aPath, &$aFiles)
{
  $dir_handle = @opendir($aPath) or die("");

  while($file = readdir($dir_handle)) {
    $fullpath = $aPath.$file;

    if(is_dir($fullpath) == false) {
      $ext = substr($file, -4);
      if($file[0] != '.' && (strtolower($ext) == '.jpg')) {
        $aFiles[] = $fullpath;
      }
    }
  }

  closedir($dir_handle);

}

function files2str($aFiles)
{
  $cnt = count($aFiles);
  $ret = "files=";

  for($i=0; $i<$cnt; $i++) {
    $ret = $ret.urlencode($aFiles[$i]);
    if($i<$cnt-1)
      $ret = $ret."|";
  }
  return $ret;
}

$files = array();
$img_path = $_GET['img_path'];
$l = strlen($img_path);
if($l <= 0) {
  $img_path = "./";
} else {
  if($img_path[$l - 1] != '/')
    $img_path = $img_path."/";
}
@readFiles($img_path, $files);

echo files2str($files);

?>
