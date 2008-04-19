<?php
	
	/*
	 * vCore -- PostgreSQL layer
	 */

	require('vcl_db.inc.php');

	 class MySQLDB implements DBAbstractionLayer {
		
		public $ResultSet = array();
		public $Result = null;

		private $connection = null;

		public function Connect($host, $username, $password, $schema){
			if(!$host){
				throw new Exception('Database host not specified');
			}else if(!$username){
				throw new Exception('Database user not specified');
			}else if(!$schema){
				throw new Exception('Database schema not specified');
			}else{
				mysql_connect($host,$username,$password);
				mysql_select_db($schema);
				if(mysql_errno()){
					throw new Exception('DB connection error: ' . mysql_error());
				}
			}
		}

		public function Query($query){
			$query_result_rsrc = mysql_query($query);
			$this->Result = &$query_result_rsrc;
			if(mysql_errno()){
				throw new Exception('DB error: ' . mysql_error());
			}
			if(preg_match_all('/^SELECT/i',$query){
				while(
					$this->ResultSet[] = mysql_fetch_assoc($query_result_rsrc)
				);
				return mysql_num_rows($query_result_rsrc);
			}else{
				return mysql_affected_rows($query_result_rsrc);
			}
		}

		public function NumRows(){
			return mysql_num_rows($this->Result);
		}
	}

?>
