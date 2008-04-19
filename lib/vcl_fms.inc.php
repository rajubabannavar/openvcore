<?


	/*
	 *	vCore Flash Media Server VOD Layer
	 */

	class FMS_VODSource {
		
		private $fms_schema = 'rtmp://';
		private $fms_server = '';
		private $fms_source = '';

		private $as = '';		//Actionscript

		function __construct(){
			define('CRLF',"\r\n");
		}

		private function generate_fms_source(){
		/*	if(!$fms_schema 
				or !$fms_server 
				or !$fms_source) return false;*/
			return $this->fms_schema . $this->fms_server . '/vod/' . $this->fms_source;
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
			return $this->generate_fms_source();
		}

		public function GenerateSWF($width, $height, $backcolor){
			ming_useswfversion(7);

			$fm = new SWFMovie(7);

			$fm->nextFrame();
			$fm->nextFrame();

			$fm->setDimension($width,$height);
			$fm->setBackground($backcolor['r'],$backcolor['g'],$backcolor['b']);
			
			$vds = new SWFVideoStream();
			$vds->setDimension($width,$height);

			$sfo_FLVContainer0 = $fm->add($vds);
			$sfo_FLVContainer0->moveTo(0,0);
			$sfo_FLVContainer0->setname('FLVContainer0');

			$this->as .= 'nc = new NetConnection();' . CRLF;
			$this->as .= 'nc.connect(null);' . CRLF;
			$this->as .= 'stream = new NetStream("rtmp://localhost/vod");' . CRLF;
			$this->as .= 'FLVContainer0.attachVideo(stream);' . CRLF;
			$this->as .= 'stream.setBufferTime(10);' . CRLF;
			$this->as .= 'stream.play("sample");';

			$aso = new SWFAction($this->as);
			$fm->add($aso);

			header('Content-type: application/x-shockwave-flash');
			$fm->nextFrame();
			$fm->output();
		}
	}

?>
