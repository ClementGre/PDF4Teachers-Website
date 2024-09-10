<?php
    $acc = false;
    include 'translator.php';
?>
<div class="popup popup-email">
    <h2 class="popup-title" style="text-align: center;">
        <?= t("emailpopup.title"); ?>
    </h2>
    <p class="popup-text">
        <?= t("emailpopup.text"); ?>
    </p>
    <br/>
    <div style="text-align: center;">
        <div style="display: inline-block">
            <a href="https://github.com/ClementGre/PDF4Teachers/issues" target="_blank" class="popup-link">
                <?= t("emailpopup.seeIssues"); ?>
            </a>
        </div>
        &nbsp;&nbsp;&nbsp;
        <div style="display: inline-block">
            <a href="https://github.com/ClementGre/PDF4Teachers/issues/new/choose" target="_blank" class="popup-link">
                <?= t("emailpopup.newIssue"); ?>
            </a>
        </div>
        <br/><br/>
        <p>
            <?= t("emailpopup.emailAnyway"); ?>
        </p>
        <a href="<?= "mai"."lto:clement.grennerat"."@"."clgr.io" ?>" target="_blank">
            <?= "clement.grennerat"."@"."clgr.io" ?>
        </a>
    </div>
</div>
