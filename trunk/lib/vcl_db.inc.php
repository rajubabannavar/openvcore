<?php
	
	/*
	 * vCore -- DBAL for extension to other databases
	 */

	interface DBAbstractionLayer {
		
		public function Connect($host, $username, $password,$schema);
		public function UseSchema($schema);

		public function Query($query);
		public function GetRow();
		public function NumRows();

	}

?>
