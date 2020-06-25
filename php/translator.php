<?php
function getBrowserLanguage( $available = [], $default = 'en' ) {
	if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){

		$langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    if(empty($available)){
      return $langs[0];
    }
		foreach($langs as $lang){
			$lang = substr($lang, 0, 2);
			if(in_array($lang, $available)){
				return $lang;
			}
		}
	}
	return $default;
}
$languages = ['fr', 'en'];

// Detect language with cookie or navigator language
if(isset($_COOKIE['language'])){
	if(in_array($_COOKIE['language'], $languages)){
		$language = $_COOKIE['language'];
	}else{
		$language = getBrowserLanguage($languages);
	}
}else{
		$language = getBrowserLanguage($languages);
}

// Load translation file
$translations = array();
$translationsFile = realpath('translations/' . $language . '.properties');

foreach(file($translationsFile, true) as $line){
	$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
}

if(realpath('commonTranslations/' . $language . '.properties') != false){
	foreach(file(realpath('commonTranslations/' . $language . '.properties'), true) as $line){
		$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
	}
}else if(realpath('../commonTranslations/' . $language . '.properties') != false){
	foreach(file(realpath('../commonTranslations/' . $language . '.properties'), true) as $line){
		$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
	}
}else{
	echo "Erreur : Impossible de trouver le dossier commonTranslations";
}


// Translate a sentence
function t($key){
	global $translations;

  if(isset($translations[$key])){
    return $translations[$key];
  }else{
		return $key;
	}
}

?>
