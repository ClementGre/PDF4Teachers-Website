<?php
if(!isset($acc)) $acc = false;
include_once 'translator.php';

include 'getOs.php';
$oss = getOss();


if(gettype($oss) === "array"){
  $fileName = "";
  switch($oss[0]){
    case "windows":
      $fileName = "PDF4Teachers-Windows-<lastRelease>.msi";
      break;
    case "macosxsilicon":
      $fileName = "PDF4Teachers-MacOSX-<lastRelease>-Aarch64.dmg";
      break;
    case "macosx":
      $fileName = "PDF4Teachers-MacOSX-<lastRelease>.dmg";
      break;
    case "linux":
      $fileName = "PDF4Teachers-Linux-<lastRelease>.deb";
      break;
    case "linuxrpm":
      $fileName = "PDF4Teachers-Linux-<lastRelease>-BIN.tar.gz";
      break;
}

  $link = "https://github.com/ClementGre/PDF4Teachers/releases/download/<lastRelease>/";
  ?>

  <div class="btn-group dropdown-div download-div">
    <button type="button" class="btn btn-success base-button"><a class="replace-lastrelease" href="<?= $link . $fileName ?>"><?= t("button.download." . $oss[0]) ?></a></button>
    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
    <div class="dropdown-menu">

      <?php
      for($i = 0; $i < 5; $i++){
        $fileName;
        switch($oss[$i]){
          case "windows":
            $fileName = "PDF4Teachers-Windows-<lastRelease>.msi";
            break;
          case "macosxsilicon":
            $fileName = "PDF4Teachers-MacOSX-<lastRelease>-Silicon.dmg";
            break;
          case "macosx":
            $fileName = "PDF4Teachers-MacOSX-<lastRelease>.dmg";
            break;
          case "linux":
            $fileName = "PDF4Teachers-Linux-<lastRelease>.deb";
            break;
          case "linuxrpm":
            $fileName = "PDF4Teachers-Linux-<lastRelease>-BIN.tar.gz";
            break;
        }
        echo '<a class="dropdown-item replace-lastrelease" href="' . $link . $fileName . '">' . t("button.download." . $oss[$i]) . '</a>';
      }
      ?>

      <?php 
        if(isset($isHeaderButton) && $isHeaderButton){
          if($acc){
            echo '<a class="dropdown-item replace-lastrelease" href="Download?v=<lastRelease>">' . t("button.download.openpage") . '</a>';
          }else{
            echo '<a class="dropdown-item replace-lastrelease" href="../Download?v=<lastRelease>">' . t("button.download.openpage") . '</a>';
          }
        ?>
        <a class="dropdown-item replace-lastrelease" href="https://github.com/ClementGre/PDF4Teachers/releases/tag/<lastRelease>" target="_blank"><?= t("button.download.opengithub") ?></a>
        <?php
        } 
      ?>
    </div>
  </div>
<?php }else{ ?>

<?php }
