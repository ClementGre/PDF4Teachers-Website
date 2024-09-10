<div class="links">
  <div>
    <h3><?= t("title.pages") ?></h3>
    <?php if($acc){ ?>
      <a href="Documentation"><i class="fas fa-book"></i>&nbsp;&nbsp;<?= t("linkname.github.documentation") ?></i></a>
      <a href="Statistics"><i class="far fa-chart-bar"></i>&nbsp;&nbsp;<?= t("linkname.statistics") ?></a>
      <a href="Design"><i class="far fa-image"></i>&nbsp;&nbsp;<?= t("linkname.design") ?></a>
      <a href="License"><i class="fas fa-file-signature"></i>&nbsp;<?= t("linkname.github.liscence") ?></a>
      <a href="Contribute"><i class="fas fa-hands-helping"></i><?= t("button.contribute") ?></a>
    <?php }else{ ?>
      <a href="/Documentation"><i class="fas fa-book"></i>&nbsp;&nbsp;<?= t("linkname.github.documentation") ?></a>
      <a href="/Statistics"><i class="far fa-chart-bar"></i>&nbsp;&nbsp;<?= t("linkname.statistics") ?></a>
      <a href="/Design"><i class="far fa-image"></i>&nbsp;&nbsp;<?= t("linkname.design") ?></a>
      <a href="/License"><i class="fas fa-file-signature"></i>&nbsp;<?= t("linkname.github.liscence") ?></a>
      <a href="/Contribute"><i class="fas fa-hands-helping"></i><?= t("button.contribute") ?></a>
    <?php } ?>
  </div>
  <div>
    <h3><?= t("title.contacts") ?></h3>
    <a href="https://github.com/ClementGre/PDF4Teachers/issues/new" target="_blank"><i class="fab fa-github"></i>&nbsp;<?= t("linkname.github.issues") ?></a>
    <a href="https://x.com/Pdf4Teachers" target="_blank"><i class="fa-brands fa-x-twitter"></i>&nbsp;X</a>
    <a href="#" onclick="openEmailPopup(event)"><i class="fas fa-envelope"></i>&nbsp;Email</a>
  </div>
  <div>
    <h3><?= t("title.links") ?></h3>
    <a href="https://github.com/ClementGre/PDF4Teachers" target="_blank"><i class="fab fa-github"></i>&nbsp;<?= t("linkname.github.project") ?></a>
    <a href="https://github.com/ClementGre/PDF4Teachers-Website" target="_blank"><i class="fab fa-github"></i>&nbsp;<?= t("linkname.github.website-project") ?></a>
    <a href="https://github.com/sponsors/ClementGre" target="_blank">&nbsp;<i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= t("linkname.github.sponsors") ?></a>
    <a href="https://paypal.me/themsou" target="_blank">&nbsp;<i class="fab fa-paypal"></i>&nbsp;<?= t("linkname.github.donate") ?></a>
  </div>
</div>
<hr/>
<div class="bottom">
  <h3 class="left">Copyright &copy; PDF4Teachers - 2020 - <?= date("Y") ?></h3>
  <h3 class="right"><?= t("message.developper") ?><?php if(strcmp(t("message.translator"), "traduit par xxx") !== 0){ echo ', ' . t("message.translator"); } ?></h3>
</div>

<?php

?>
