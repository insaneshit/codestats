<?php
class translate {
	private $lang;

	public function translate() {
		$this->loadLanguage();
	}

	public function _($text) {
		$row = 1;
		if (($handle = @fopen(system::$root."core/languages/".$this->lang.".csv","r")) !== false) {
		    while (($data = @fgetcsv($handle, 20000, ",")) !== false) {
		        if ($data[0] == $text) {
		        	return $data[1];
		        	exit;
		        }
		    }
		    fclose($handle);
		}
		return $text;
	}

	private function loadLanguage() {
		// Diese Einstellung muss später aus den Benutzereinstellungen ausgelesen werden...
		$this->lang = "en";
	}
}
?>