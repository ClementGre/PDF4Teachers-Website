<?php
    $acc = false;
    include 'translator.php';
?>
<div class="popup popup-email">
    <h1 class="popup-title">
        <?= t("emailpopup.title"); ?>
    </h1>
    <p class="popup-text">
        <?= t("emailpopup.text"); ?>
    </p>
    <br/>
    <a class="popup-link">
        <?= t("emailpopup.seeIssues"); ?>
    </a>
    <a class="popup-link">
        <?= t("emailpopup.newIssue"); ?>
    </a>
    <br/>
    <p>
        <?= t("emailpopup.emailAnyway"); ?>
    </p>
    <a href="mailto:clement.grennerat@free.fr">
        clement.grennerat@free.fr
    </a>
</div>