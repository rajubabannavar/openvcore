<?
	
	/*
	 *	And this, ladies and gentlemen...
	 *	le piece de resistance.
	 *
	 *	vCore encoding class
	 *
	 *	Depends on ffmpeg being installed. Set its location in FFMPEG_BIN below.
	 *
	 */

	define('FFMPEG_BIN','/usr/bin/ffmpeg');

	#/usr/local/bin/ffmpeg  -i input.mov -ar 22050 -ab 56 -aspect 4:3 \
#	 -b 200 -r 12 -f flv -s 320x240 -acodec mp3 -ac 1 output.flv

	class VideoEncoder {
		
		private $ffmpeg_exec = '';

		function __construct($input){
			if(!$input){
				throw new Exception("VideoEncoder can't encode nothing!");
			}else{
				$this->ffmpeg_exec = FFMPEG_BIN . ' -i ' . $input;
			}
		}

		//FIXME: make sure user can't call Set* twice!
		//TODO: more complete implementation, but this is all we really need FTTB

		function SetAudioBitrate($abr){
			$this->ffmpeg_exec .= " -ab $abr ";
		}

		function SetAudioChannels($ac){
			$this->ffmpeg_exec .= " -ac $ac ";
		}

		function SetAudioRate($ar){
			$this->ffmpeg_exec .= " -ar $ar ";
		}

		function SetVideoBitrate($vdbr){
			$this->ffmpeg_exec .= " -b $vdbr ";
		}

		function SetAspectRatio($aspect){
			$this->ffmpeg_exec .= " -aspect $aspect ";
		}

		function SetScale($width, $height){
			$this->ffmpeg_exec .= " -s {$width}x{$height} ";
		}

		function Encode($outfile){
		
			if(!$outfile){
				throw new Exception ('You need to supply an output file name.');
			}

			$this->ffmpeg_exec .= ' ' . $outfile;

			set_time_limit(0);	//Well, duh. YOU try encoding avc in under 30s :p
			//CHANGE THIS to read session from the database dep on user
			$user_encsession = 'test';
			$fds = Array (
				0 => Array('pipe','r'),					//No STDIN
				1 => Array('file',"$user_encsession.log",'w'),	//Redirect STDOUT to logfile
						//We need this to report progress
				2 => Array('file',"$user_encsession.error.log",'w+'),	//Log errors
			);

			$ps_enc = proc_open($this->ffmpeg_exec,$fds,$pipes);

			//no deadlocking or SIGPIPE plz
			fclose($pipes[0]);
			return proc_close($ps_enc);

		}
	}

?>
