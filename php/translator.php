<?php
// SETUP ALL THESE THINGS FOR THE PAGES :

global $rootPath;
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/web/PDF4Teachers-Website')) {
	$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/web/PDF4Teachers-Website';
}else{
	$rootPath = $_SERVER['DOCUMENT_ROOT'];
}

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
	$languages = ['fr', 'en', 'it'];

	// Detect language with url, cookie 🍪 or navigator language
	$urlLang = explode(".", $_SERVER["SERVER_NAME"])[0];
	if(in_array($urlLang, $languages)){
		setcookie('language', $urlLang, array('samesite' => 'strict', 'path' => '/'));
		$language = $urlLang;
	}else if(isset($_COOKIE['language'])){
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
			$value = explode('=', $line, 2)[1];
			$translations = array_merge($translations, array(explode('=', $line, 2)[0] => ((ord(substr($value, -1)) == 10 || ord(substr($value, -1)) == 13) ? substr($value, 0, -1) : $value)));
		}
	}

	foreach(file($rootPath .'/commonTranslations/' . $language . '.properties', true) as $line){
		$value = explode('=', $line, 2)[1];
		$translations = array_merge($translations, array(explode('=', $line, 2)[0] => ((ord(substr($value, -1)) == 10 || ord(substr($value, -1)) == 13) ? substr($value, 0, -1) : $value)));
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
