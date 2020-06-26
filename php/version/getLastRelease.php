<?php
function getLastRelease(){
  $context = stream_context_create(array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n")));
  $json = file_get_contents('https://api.github.com/repos/clementgre/PDF4Teachers/releases/latest', false, $context);

  return json_decode($json)->tag_name;
}
function getLastReleaseDetails(){
  $context = stream_context_create(array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n")));
  $json = file_get_contents('https://api.github.com/repos/clementgre/PDF4Teachers/releases/latest', false, $context);

  return json_decode($json);
}

function getLastPreRelease(){
  $context = stream_context_create(array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n")));
  $json = file_get_contents('https://api.github.com/repos/clementgre/PDF4Teachers/tags', false, $context);

  return json_decode($json)[0]->name;
}
function getLastPreReleaseDetails(){
  $context = stream_context_create(array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n")));
  var_dump(getLastPreRelease());
  $json = file_get_contents('https://api.github.com/repos/clementgre/PDF4Teachers/releases/tags/' . getLastPreRelease(), false, $context);

  return json_decode($json);
}

?>
