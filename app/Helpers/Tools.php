<?php namespace Helpers;

class Tools {
	
	private static $posts = array();
	
	// --- XSS free
	public static function getPost($name, $default = "") {
		if (array_key_exists($name, $_POST))
			return self::_sanitize($_POST[$name]);
		return $default;
	}

	public static function getGet($name, $default = "") {
		if (array_key_exists($name, $_GET))
			return self::_sanitize($_GET[$name]);
		return $default;
	}
	
	public static function getRequest($name, $default = "") {
		if (array_key_exists($name, $_REQUEST))
			return self::_sanitize($_REQUEST[$name]);
		return $default;
	}
	
	// --- Raw 
	public static function getRawPost($name, $default = "") {
		if (array_key_exists($name, $_POST))
			return $_POST[$name];
		return $default;
	}
	
	public static function getRawGet($name, $default = "") {
		if (array_key_exists($name, $_GET))
			return $_GET[$name];
		return $default;
	}
	
	public static function getRawRequest($name, $default = "") {
		if (array_key_exists($name, $_REQUEST))
			return $_REQUEST[$name];
		return $default;
	}
	
	// --- Private functions
	// Prevent XSS injection
	private static function _sanitize($value) {
		return strip_tags( trim($value) );
	}
		
}