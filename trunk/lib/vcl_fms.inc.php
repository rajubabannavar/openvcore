<?

	/*
	 *	vCore Flash Media Server VOD Layer
	 */

	class FMS_VODSource {
		
		private $fms_schema = 'rtmp://';
		private $fms_server = '';
		private $fms_source = '';

		private function generate_fms_source(){
			if(!$fms_schema 
				or !$fms_server 
				or !$fms_source) return false;
			return $fms_schema . $fms_server . '/vod/' . $fms_source;
		}

		public function SetSchema($schema){
			$this->fms_schema = $schema . '://';
		}

		public function SetServer($server){
			$this->fms_server = $server;
		}

		public function SetVODSource($source){
			$this->fms_source = $source;
		}

		public function ToString(){
			return generate_fms_source();
		}
	}

?>
