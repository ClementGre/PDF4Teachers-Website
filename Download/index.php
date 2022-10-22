<?php $acc=false; $page="Download"; require "../php/translator.php"; ?>

<!DOCTYPE html>
<html lang="<?= $language ?>">
<!--          PAGE INFO          -->
<head>
	<?php require '../analytics.php'; ?>

	<meta name="description" content="<?= t("page.description") ?>" />
	<meta name="keywords" content="<?= t("page.keywords") ?>" />
	<link rel="icon" href="../data/small-img/logo.png" />
	<title><?= t("page.name") ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300&family=Varela+Round&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="../css/header.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/foot.css" />
	<link rel="stylesheet" type="text/css" href="../css/download.css" />

	<variable class="language"><?= $language ?></variable>
	<variable class="tr-mb"><?= t("suffix.mega-Byte") ?></variable>
	<variable class="tr-files"><?= t("title.files") ?></variable>
	<variable class="tr-downloads"><?= t("suffix.downloads") ?></variable>
	<variable class="tr-english-date"><?= t("var.english-date") ?></variable>
	<variable class="tr-source-code"><?= t("file-name.source-code") ?></variable>

</head>

<body>
	<div class="filter"></div>
<!--          HEADER          -->
	<header>
		<?php include '../header.php'; ?>
	</header>

<!--          MAIN          -->
	<main class="download-page">
	    <br>
	    <div class="info download-panel">
            <?php
                $link = "https://github.com/ClementGre/PDF4Teachers/releases/download/<lastRelease>/PDF4Teachers-";
                $versions = ['linux' =>
                        ['deb' => 'Linux-<lastRelease>.deb',
                            'tar.gz' => 'Linux-<lastRelease>.tar.gz'],
                    'windows' =>
                        ['msi' => 'Windows-<lastRelease>.msi',
                            'zip' => 'Windows-<lastRelease>.zip',
                            'zip <span style="font-size: 13px">(32 bits)</span>' => 'Windows32-<lastRelease>.zip'],
                    'macos' =>
                        ['dmg <span style="font-size: 13px">(Apple Silicon)</span>' => 'MacOSX-AArch64-<lastRelease>.dmg',
                            'dmg <span style="font-size: 13px">(Intel)</span>' => 'MacOSX-<lastRelease>.dmg']];

                foreach($versions as $os => $files){
                    echo '<div class="os-pane">';
                    $i = 0;
                    foreach($files as $ext => $name){
                        $class = $i == 0 ? 'dl-default' : (count($files) == $i + 1 ? 'dl-last' : 'dl-middle');
                        if($i == 0 && count($files) !== 1) $class .= ' dl-first';
                        echo '<a href="' . $link . $name .'" class="replace-lastrelease '.$class.'">
                                '. ($i == 0 ? '<img src="../data/small-img/os/'.$os.'.png" alt="Linux">' : '') . '
                                <p>.'.$ext.'</p>
                            </a>';
                        $i++;
                    }
                    echo '</div>';
                }
            ?>
	    </div>
	</main>

<!--          FOOTER          -->
	<footer>
		<?php include '../footer.php'; ?>
	</footer>

	
	<script type='text/javascript' src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/download.js" defer></script>

</body>

</html>
