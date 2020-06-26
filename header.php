<div>
  <?php if($acc){ ?>
    <a href=""><img src="data/img/logo.png" /></a>
  <?php }else{ ?>
    <a href="../"><img src="../data/img/logo.png" /></a>
  <?php } ?>
</div>

<div>
  <nav class="global-nav">
    <ul>

      <?php if($acc){ ?>

        <li class="list"><a href=""><?= t("button.home") ?></a></li>
        <li class="list"><a href="Download/"><?= t("button.download") ?></a></li>
        <li class="list"><a href="About/"><?= t("button.about") ?></a></li>


      <?php }else{ ?>

        <li class="list"><a href="../"><?= t("button.home") ?></a></li>
        <li class="list"><a href="../Download/"><?= t("button.download") ?></a></li>
        <li class="list"><a href="../About/"><?= t("button.about") ?></a></li>

      <?php } ?>
    </ul>

  </nav>
</div>

<div class="right menu-div">
    <?php if($acc){ ?>
      <a class="menu-link" href=""><img src="data/img/menu.png" /></a>
    <?php }else{ ?>
      <a class="menu-link" href=""><img src="../data/img/menu.png" /></a>
    <?php } ?>
</div>

<div class="right right-and-left">
  <?php include 'php/languageButton.php'; ?>
</div>

<div class="right">
  <?php include 'php/downloadButton.php'; ?>
</div>
