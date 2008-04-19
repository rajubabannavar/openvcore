<?

	/*

		v|core open HD video sharing platform

		Program Code (c) 2008 Chris Northcott
		
		Projects used in the making of this bad boy:

		Smarty Template system					MPEG4 AVC aka H.264 Codec
			http://smarty.php.net/					http://en.wikipedia.org/wiki/H.264

		Shockwave Flash Technology				Ming Project
			http://www.adobe.com/products/flash			http://www.libming.org/

		Sorenson H.263 (Spark) Codec
			http://sorensonmedia.com

		Some media from Wikimedia Commons

		This project is licensed under the Mozilla Public License 1.1.
		See COPYING for further information.

	*/

	//Initial Setup
	//NOTE TO OTHER PROJECT DEVS:
	//	This is the ONLY part of the codebase that should be procedural.
	//	The rest should be encapsulated within objects, as much as possible.

	define('SMARTY_DIR','frontend/');
	define('SMARTY_LIB_DIR','lib/smarty/');

	require_once(SMARTY_LIB_DIR . 'Smarty.class.php');
	
	//Global template object. Don't forget to 'global $tpl' :p
	$tpl = new Smarty();
	
	// Hmm, what do we do?

	switch($_GET['a']){
		case 'video':
			require_once('frontend/VideoPage.inc.php');
			$p = new VideoPage($_GET['v']);
			$p->Display();
		break;
		default:
			require_once('frontend/IndexPage.inc.php');
			$p = new IndexPage();
			$p->Display();
		break;
	}

?>
