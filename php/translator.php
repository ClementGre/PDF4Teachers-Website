<?php
if(isset($_POST['language'])){
	setcookie('language', $_POST['language'], array('samesite' => 'strict', 'path' => '/'));
}else{
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

	if(file_exists(realpath('translations/'))){
		foreach(file($translationsFile, true) as $line){
			$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
		}
	}

	if($acc){
		foreach(file(realpath('commonTranslations/' . $language . '.properties'), true) as $line){
			$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
		}
	}else{
		foreach(file(realpath('../commonTranslations/' . $language . '.properties'), true) as $line){
			$translations = array_merge($translations, array(explode('=', $line, 2)[0] => explode('=', $line, 2)[1]));
		}
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
}
?>
