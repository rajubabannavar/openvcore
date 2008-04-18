<?

	error_reporting(E_ALL);

	require('encoder.php');

	$ve = new VideoEncoder('../media/uploaded/test.avi');

	

	$ve->SetScale('320','240');
	$ve->SetVideoBitrate('200'); //kbps
	echo $ve->Encode('../media/spark/test.flv') . "\n";

?>
