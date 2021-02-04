<?php $acc=true; $page="Home"; require "php/translator.php"; ?>

<!--          PAGE INFO          -->
<head>
	<?php require 'analytics.php'; ?>

	<meta name="description" content="<?= t("page.description") ?>" />
	<meta name="keywords" content="<?= t("page.keywords") ?>" />
	<link rel="icon" href="data/small-img/logo.png" />
	<title><?= t("page.name") ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300&family=Varela+Round&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/header.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/foot.css" />
	<link rel="stylesheet" type="text/css" href="css/home.css" />


</head>
<body>
	<div class="filter"></div>
<!--          HEADER          -->
	<header>
		<?php include 'header.php'; ?>
	</header>

<!--          MAIN          -->
	<main>

		<center class="title">
			<img src="data/small-img/title.png"/>
			<br/>
			<div class="text">
				<h1><?= t("message.teaser") ?></h1>
			</div>
		</center>

		<div class="features">
			<div class="feature-block feature-block-1 from-left">
				<!-- <img class="shoot-box shoot-box-left"/>
				<img class="shoot-box shoot-box-right"/> -->

				<div class="left image-div">
					<img src="data/small-img/convert.png"/>
				</div>
				<div class="right text">
					<h2><?= t("title.convert") ?></h2>
					<p><?= t("text.convert") ?></p>
				</div>
			</div>
			<div class="feature-block feature-block-2 from-right">
				<!-- <img class="shoot-box shoot-box-left"/>
				<img class="shoot-box shoot-box-right"/> -->

				<div class="left text">
					<h2><?= t("title.edit") ?></h2>
					<p><?= t("text.edit") ?></p>
				</div>
				<div class="right image-div">
					<img src="data/small-img/edit.png"/>
				</div>
			</div>
			<div class="feature-block feature-block-3 from-left">
				<!-- <img class="shoot-box shoot-box-left"/>
				<img class="shoot-box shoot-box-right"/> -->

				<div class="left image-div">
					<img src="data/small-img/export.png"/>
				</div>
				<div class="right text">
					<h2><?= t("title.export") ?></h2>
					<p><?= t("text.export") ?></p>
				</div>
			</div>
		</div><div class="preview-block">
			<img class="preview" src="data/small-img/shots/text-elements.png">
		</div>

		<center>
			<div class="youtube-div">
				<div class="youtube-container">
					<iframe class="youtube-iframe" src="https://www.youtube-nocookie.com/embed/zqEOGA7G5bE" frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</center>

	</main>


<!--          FOOTER          -->
	<footer>
		<?php include 'footer.php'; ?>
	</footer>

	<script type='text/javascript' src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/home.js"></script>

</body>
</html>
