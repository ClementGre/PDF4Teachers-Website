<?php $acc=false; $page="Design"; require "../php/translator.php"; ?>

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

</head>
<body>
	<div class="filter"></div>
<!--          HEADER          -->
	<header>
		<?php include '../header.php'; ?>
	</header>


<!--          MAIN          -->
	<main>
		<div class="info">

			<h2><?= t("appDesign.title") ?></h2>
            <p><?= t("appDesign.description") ?></p>

            <br><hr><br>

            <h2><?= t("logo.title") ?></h2>

            <div class="design-images">
                <div><img src="../data/img/logo.png" alt="logo"></div>
                <div><img src="../data/img/logo_backgrounded.png" alt="logo backgrounded"></div>
                <div><img src="../data/img/logo_backgrounded_rounded.png" alt="logo backgrounded rounded"></div>
            </div>

            <br><hr><br>

            <h2><?= t("colors.title") ?></h2>

            <div class="design-colors">
                <?php
                function getColorDiv($name, $color){
                    return "<div style='background-color:$color;' class='design-color'>
                            <p class='color-name'>$name</p>
                            <p class='color-hex'>$color</p>
                        </div>";
                }
                function getGradientDiv($name, $from, $to){
                    return "<div style='background: linear-gradient(0deg, $from, $to)' class='design-color'>
                            <p class='color-name'>$name</p>
                            <p class='color-hex'>$from &rarr; $to</p>
                        </div>";
                }
                ?>
                <?= getGradientDiv("Base Gradient", "#EC247F", "#EE3225") ?>
                <?= getGradientDiv("Dark Gradient", "#7D1343", "#7E1A13") ?>
                <?= getColorDiv("Dark Red", "#840C2C") ?>
                <?= getColorDiv("Dark Blue", "#3C3B4B") ?>
                <?= getColorDiv("Purple", "#8C8AFF") ?>
                <?= getColorDiv("Gray", "#D0D8EB") ?>


            </div>

            <br><hr><br>

            <h2><?= t("images.title") ?></h2>

            <div class="design-images">
                <div><img src="../data/img/banner.png" alt="banner"></div>
                <div><img src="../data/img/banner_thin.png" alt="banner thin"></div>
                <div><img src="../data/img/title.png" alt="title"></div>
                <div><img src="../data/img/shots/grading.png" alt="grading screenshot"></div>
                <div><img src="../data/img/shots/text-elements.png" alt="text elements screenshot"></div>
                <div><img src="../data/img/shots/vector-elements.png" alt="vectors elements screenshot"></div>
            </div>

            <br><hr><br>

            <h2>Figma</h2>
            <p><?= t("figma.description") ?></p>

            <br>
            <div style="text-align: center;">
                <a class="btn btn-primary" role="button" href="https://www.figma.com/file/4ZgV5y21Zt0slp8CtsrrS3/PDF4Teachers-design?node-id=0%3A1">Figma Project</a>
            </div>
            <br>

            <!--<iframe style="border: 1px solid rgba(0, 0, 0, 0.1);" src="https://www.figma.com/embed?embed_host=share&amp;url=https%3A%2F%2Fwww.figma.com%2Ffile%2F4ZgV5y21Zt0slp8CtsrrS3%2FPDF4Teachers-design%3Fnode-id%3D0%253A1"
                    allowfullscreen="" width="100%" height="450"></iframe>-->


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

</body>
</html>
