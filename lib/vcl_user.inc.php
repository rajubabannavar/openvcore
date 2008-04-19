<?

	/*
	*
	* v|Core user module
	*
	*/

	require_once('../config/config.php');

	require_once('vcl_' . $config['db_type'] . '.inc.php');

	class User {

		public $UserData = Array();
		private $dbo = null;

		function __construct($username = ''){
			global $config;
			if(!empty($username)){
				//get user data
				$dyn_classname = $config['db_type'] . 'DB';
				$this->dbo = new $dyn_classname();
				$this->dbo->Connect(
					$config['db_host'],
					$config['db_user'],
					$config['db_password'],
					$config['db_schema']
				);
				$this->dbo->Query('SELECT * FROM vc_users WHERE user_name = "' .
					mysql_escape_string($username) . '"');
				$this->UserData = $this->dbo->ResultSet[0];
			}
		}
		
	}

?>
