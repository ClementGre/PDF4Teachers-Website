<div>
  <?php if($acc){ ?>
    <a href=""><img src="data/small-img/logo.png" /></a>
  <?php }else{ ?>
    <a href="/"><img src="/data/small-img/logo.png" /></a>
  <?php } ?>
</div>

<div>
  <nav class="global-nav">
    <ul>
      <?php if($acc){ ?>
        <li class="list active">
          <a href=""><?= t("button.home") ?></a>
        </li><li class="list">
          <a href="Download/"><?= t("button.download") ?></a>
        </li><li class="list">
          <a href="About/"><?= t("button.about") ?></a>
        </li><!-- <li class="list">
          <a href="Contribute/"><?= t("button.contribute") ?></a>
        </li> -->
      <?php }else{ ?>
        <li class="list">
          <a href="/"><?= t("button.home") ?></a>
        </li><li class="list <?php if($page === "Download"){echo "active";}?>">
          <a href="/Download/"><?= t("button.download") ?></a>
        </li><li class="list <?php if($page === "About"){echo "active";}?>">
          <a href="/About/"><?= t("button.about") ?></a>
        </li><!-- <li class="list <?= ($page === "Contribute") ? "active" : "" ?>">
          <a href="../Contribute/"><?= t("button.contribute") ?></a>
        </li> -->
      <?php } ?>
    </ul>
  </nav>
</div>

<div class="right menu-div">
    <?php if($acc){ ?>
      <a class="menu-link" href=""><img src="data/small-img/menu.png" /></a>
    <?php }else{ ?>
      <a class="menu-link" href=""><img src="/data/small-img/menu.png" /></a>
    <?php } ?>
</div>

<div class="right right-and-left">
  <?php include 'php/languageButton.php'; ?>
  <a href="https://github.com/ClementGre/PDF4Teachers" target="_blank"><i class="fab fa-github"></i></a>
</div>

<div class="right">
  <?php $isHeaderButton = true; include 'php/downloadButton.php'; ?>
</div>
