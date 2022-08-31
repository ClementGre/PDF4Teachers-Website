<?php
function getOS() {

    /*$os_array = array(
                      '/windows me/i'         =>  'Windows ME',
                      '/win98/i'              =>  'Windows 98',
                      '/win95/i'              =>  'Windows 95',
                      '/win16/i'              =>  'Windows 3.11',
                      '/macintosh|mac os x/i' =>  'Mac OS X',
                      '/mac_powerpc/i'        =>  'Mac OS 9',
                      '/linux/i'              =>  'Linux',
                      '/ubuntu/i'             =>  'Ubuntu',
                      '/iphone/i'             =>  'iPhone',
                      '/ipod/i'               =>  'iPod',
                      '/ipad/i'               =>  'iPad',
                      '/android/i'            =>  'Android',
                      '/blackberry/i'         =>  'BlackBerry',
                      '/webos/i'              =>  'Mobile');*/
    $os_array = array('/windows nt/i'     =>  'windows',
                      '/macintosh|mac os x|mac_powerpc/i' =>  'macosx',
                      '/linux/i'              =>  'linux',
                      '/ubuntu/i'             =>  'linux');

    $os_platform = "unknown";
    foreach($os_array as $regex => $value){
        if(preg_match($regex, $_SERVER["HTTP_USER_AGENT"])){
            $os_platform = $value;
        }
    }
    return $os_platform;
}

function getOSs() {

  $platform = getOS();
  switch ($platform){
    case "windows":
      return ["windows", "macosxsilicon", "macosx", "linux", "linuxrpm"];
    case "macosx":
      return ["macosxsilicon", "macosx", "windows", "linux", "linuxrpm"];
    case "linux":
      return ["linux", "linuxrpm", "windows", "macosxsilicon", "macosx"];
  }
  return $platform;
}
