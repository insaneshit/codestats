<?php
class api {
	private $api_url;

	public function __construct() {
		$this->api_url = "http://codepen-awesomepi.timpietrusky.com/";
	}

	private function apiRequest($url) {
		return file_get_contents($url);
	}

	private function parseRequest($request) {
		return json_decode($request, true);
	}

	public function getAllData($username) {
		$data = array();
		$data['pens'] = 0;
		$data['views'] = 0;
		$data['hearts'] = 0;
		$data['comments'] = 0;
		$page = 1;
		$stop = false;
		while (!$stop) {
			$result = $this->parseRequest($this->apiRequest($this->api_url.$username."/public/".$page));
			if (($result['status']['code'] == 1337) || (count($result['content']['pens']) == 0) || ($oldResult == $result)) {
				$stop = true;
			} else {
				foreach ($result['content']['pens'] As $pen) {
					$data['pens']++;
					$data['views'] += $pen['views'];
					$data['hearts'] += $pen['hearts'];
					$data['comments'] += $pen['comments'];
				}
			}
			$page++;
			$oldResult = $result; // Bugfix (letzte fucking Seite war immer gleich...)
		}
		return $data;
	}

	public function getPenData($username, $hash) {
		return $this->parseRequest($this->apiRequest($this->api_url.$username."/pen/".$hash));
	}

	public function user_exists($username) {
		$request = $this->parseRequest($this->apiRequest($this->api_url.$username));
		if ($request['status']['code'] == 1337) {
			return false;
		} else {
			return true;
		}
	}
}
?>