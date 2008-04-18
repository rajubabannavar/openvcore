<?php
	
	/*
	 * vCore -- PostgreSQL layer
	 */

	 class PgDB implements DBAbstractionLayer {
		
		public $ResultSet = array();
		public $Result = null;

		private $connection = null;

		public function Connect($host, $username, $password, $schema){
			$host_pair = explode(':',$host);
			$port_str = 'port=' . $host_pair[1];
			$build_connstr =  "host={$host_pair[0]} $port_str ";
			$build_connstr .= "dbname=$schema user=$username ";
			$build_connstr .= "password=$password";

			$connection = pg_connect($build_connstr);
		}

		public function Query($query){
			if(!pg_connection_busy($this->connection)){
				pg_send_query($query);
				$this->Result = pg_get_result($this->connection);
				if(preg_match('/^SELECT/i',$query)){
					//get rows from query if it's a SELECT
					if(pg_num_rows($this->Result)){
						while($this->ResultSet[] = 
							pg_fetch_assoc($this->Result));
					}
				}
			}
		}

		public function NumRows(){
			return pg_num_rows($this->Result);
		}
	}

?>
