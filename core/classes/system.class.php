<?php
class system {
	// Attributes
	public static $db;
	public static $cfg;
	public static $currentPage;
	public static $root;
	public static $trans;
	public static $api;

	public static function init() {
		session_start();

		system::$root = $_SERVER['DOCUMENT_ROOT'];
		system::setCurrentPage();
		system::loadConfig();
		system::loadDatabase();
		system::loadTranslation();
		system::loadApi();
	}

	public static function loadConfig() {
		require_once(system::$root."core/config/config.cfg.php");
		system::$cfg = $config;
	}

	public static function loadDatabase() {
		require_once(system::$root."core/classes/database.class.php");
		system::$db = new database();
	}

	public static function loadTranslation() {
		require_once(system::$root."core/classes/translate.class.php");
		system::$trans = new translate();
	}

	public static function loadApi() {
		require_once(system::$root."core/classes/api.class.php");
		system::$api = new api();
	}

	private static function setCurrentPage() {
		if (isset($_GET['p']) && !empty($_GET['p'])) {
			system::$currentPage = $_GET['p'];
		} else {
			system::$currentPage = "home";
		}
	}

	public static function loadContent() {
		$contentFile = system::$root."content/".system::$currentPage.".php";
		if (file_exists($contentFile)) {
			include_once($contentFile);
		} else {
			if (system::$api->user_exists(system::$currentPage)) {
				include_once(system::$root."content/stats.php");
			} else {
				include_once(system::$root."content/error404.php");
			}
		}
	}
}
?>