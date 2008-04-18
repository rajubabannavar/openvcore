<?php
	
	/*
	 * vCore -- DBAL for extension to other databases
	 */

	interface DBAbstractionLayer {
		
		public $ResultSet;
		public $Result;

		private $db_host;
		private $db_username;
		private $db_password;
		private $db_schema;

		public function Connect($host, $username, $password);
		public function UseSchema($schema);

		public function Query($query);
		public function GetRow();
		public function NumRows();

	}

?>
