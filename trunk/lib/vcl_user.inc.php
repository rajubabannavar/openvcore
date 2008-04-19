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
		protected $dbo = null;

		function __construct($username = ''){
			global $config;
			$dyn_classname = $config['db_type'] . 'DB';
			$this->dbo = new $dyn_classname();
			$this->dbo->Connect(
				$config['db_host'],
				$config['db_user'],
				$config['db_password'],
				$config['db_schema']
			);

			if(!empty($username)){
				//get user data
				$this->dbo->Query('SELECT * FROM vc_users WHERE user_name = "' .
					mysql_escape_string($username) . '"');
				$this->UserData = $this->dbo->ResultSet[0];
			}
		}

		function Create(){
			global $config;
			$required_fields = Array(
				'user_name',
				'user_password',
				'user_first_name',
				'user_last_name'
			);

			foreach($required_fields as $field){
				if(!$this->UserData[$field]){
					throw new Exception('Required userdata field ' . $field . ' missing');
				}else{
					$this->UserData[$field] = mysql_escape_string($this->UserData[$field]);
					if(is_string($this->UserData[$field])){
						$this->UserData[$field] = "'{$this->UserData[$field]}'";
					}
				}
			}

			$this->dbo->Query('INSERT INTO vc_users (' . implode(',',array_keys($this->UserData)) . ')
				VALUES (' . implode(',',$this->UserData) . ')');
		}
	}

?>
