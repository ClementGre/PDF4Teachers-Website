<?php $acc=false; $page="Statistics"; require "../php/translator.php"; ?>

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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            <h2><?= t('title.statistics') ?></h2>
            <p><?= t('description.statistics') ?></p>

            <br><hr><br>

			<iframe class="seek-table-frame" src="https://www.seektable.com/public/report/3f3b30e387ff46209d874f88923ed39a"></iframe>
            <iframe class="seek-table-frame" src="https://www.seektable.com/public/report/94d847625bfb4869a6da42a3b752f3c5"></iframe>
            <iframe class="seek-table-frame" src="https://www.seektable.com/public/report/d6902bad2cdd41918aa3df8111f74c3e"></iframe>
            <iframe class="seek-table-frame" src="https://www.seektable.com/public/report/8e0315a054414dcdae92b3d5564ac4b1"></iframe>
            <iframe class="seek-table-frame" src="https://www.seektable.com/public/report/385d32ddf963479ebb6ab8b5f54fe4f5"></iframe>
            <br>

            <br><hr><br>

            <h2><?= t('title.downloadStats') ?></h2>
            <br>
            <form action="downloadStats.php" style="text-align: center;">
                <button type="submit" class="btn btn-primary">
                    <?= t('button.download') ?>
                </button>
            </form>


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
