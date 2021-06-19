<?php
    $acc = false;
    $tag = $_POST['tag'];
    $assignedButton = true;
    include 'translator.php';
?>
<div <!--is="release-section"--> class="info release-<?= str_replace('.', '-', $tag) ?> <?php if(str_contains($tag, 'pre')){ echo 'pre-release'; }?>">
    <div class="header accept-click">
        <div class="accept-click">
            <i class="fas fa-chevron-down"></i>
            <h2 class="accept-click"><?php

                if(str_contains($tag, 'pre')){
                    if(str_contains($tag, '-pre')){
                        echo 'pre-release ' . str_replace('-pre', '', $tag);
                    }else{
                        echo str_replace('pre-', 'pre-release ', $tag);
                    }

                }else{
                    echo 'v' . $tag;
                }

                ?></h2>
        </div>
        <div>
            <a href="https://github.com/ClementGre/PDF4Teachers/releases/tag/<?= $tag ?>" target="_blank"><i class="fab fa-github"></i></a>
            <div>
                <?php include 'downloadButton.php'; ?>
            </div>
        </div>
    </div>
</div>
<br>