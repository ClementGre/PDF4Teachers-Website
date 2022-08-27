<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=app_start_updates','pdf4teachers', getenv("PDF4TEACHERS_DB_PASS"));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "Erreur de connexion à la base de donnée.<br> Erreur : " . $e;
	}