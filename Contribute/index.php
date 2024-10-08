<?php $acc=false; $page="Contribute"; require "../php/translator.php"; ?>

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
			<h2><?= t("title.translate-weblate") ?></h2><br/>
			<p>
				<?= t("text.translate-weblate.preambule") ?><br/><br/>
			</p>
			<div style="text-align: center;">
				<a class="btn btn-primary" href="https://weblate.clgr.io/projects/" target="_blank" role="button">Weblate</a><br/><br/>
			</div>
			<p>
				<?= t("text.translate-weblate.details") ?><br/><br/><br/>
				<?= t("text.translate-weblate.parameters") ?>
			</p>

			<br><hr><br>

			<h2><?= t("title.translate-app") ?></h2><br/>
			<p>
                <?= t("text.translate-app.preambule") ?><br/><br/>

                <?= t("text.translate-app.files") ?>
            </p>
            <ul>
                <li><p><?= t("text.translate-app.files.properties") ?></p></li>
                <li><p><?= t("text.translate-app.files.png") ?></p></li>
                <li><p><?= t("text.translate-app.files.odt") ?></p></li>
                <li><p><?= t("text.translate-app.files.pdf") ?></p></li>
            </ul>
            <p>
                <br/><br/>
                <?= t("text.translate-app.deploy") ?>
            </p>

            <br><hr><br>

            <h2><?= t("title.translate-site") ?></h2><br/>
			<p>
                <?= t("text.translate-site.preambule") ?><br/><br/>
                <?= t("text.translate-site.files") ?><br/><br/>
                <?= t("text.translate-site.test") ?>
            </p>
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
