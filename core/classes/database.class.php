<?php
class database {

	private $connected = false;
	private $verbindung;
	private $sql_query;
	private $all_queries;
	private $query_counter = 0;
	
	public function database() {
		$this->verbindung = @mysql_connect(system::$cfg['db_host'], system::$cfg['db_username'], system::$cfg['db_password']);
		if ($this->verbindung) {
			if (mysql_select_db(system::$cfg['db_name'], $this->verbindung)) {
				$this->connected = true;
				mysql_query("SET NAMES 'utf8'", $this->verbindung);
				mysql_query("SET CHARACTER SET 'utf8'", $this->verbindung);
			}
		}
	}
	
	public function __destruct() {
		if ($this->connected) {
			mysql_close($this->verbindung);
		}
	}
	
	public function getLastQuery() {
		return $this->sql_query;
	}
	
	public function query($query) {
		if ($this->connected) {
			$this->sql_query = $query;
			$this->all_queries[] = $query;
			$this->query_counter++;
			$result = mysql_query($this->sql_query, $this->verbindung);
			return $result;
		}
	}
	
	public function getAllQueries() {
		echo "<pre>";
		print_r($this->all_queries);
		echo "</pre>";
	}
	
	public function getTableRows($result) {
		return mysql_num_rows($result);
	}
	
	public function fetch($result) {
		if ($this->connected) {
			return mysql_fetch_assoc($result);
		}
	}
	
	public function getQueryCount() {
		if ($this->connected) {
			return $this->query_counter;
		}
	}
	
}
?>