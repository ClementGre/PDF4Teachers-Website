<?php
	try{
		$db = new PDO('mysql:host=' . getenv("PDF4TEACHERS_DB_HOST") . ';dbname=pdf4teachers','pdf4teachers', getenv("PDF4TEACHERS_DB_PWD"));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "Erreur de connexion à la base de donnée.<br> Erreur : " . $e;
	}
