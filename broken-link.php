<?php


libxml_use_internal_errors(true);
$url = $_POST['url'];
$html = file_get_contents($url);
$doc = new DOMDocument();
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);
$nbrOfGoodLinks = 0;
$goodStatusCodes = array('200','201','202','203','204','205','206','207','208','226');
$badLinks = array();

$nodes = $xpath->query('//a');


foreach($nodes as $node) {
	$header = get_headers($url.$node->getAttribute('href'));
	$output = substr($header[0], 9, 3);

	if (in_array($output, $goodStatusCodes)) {
		$nbrOfGoodLinks++;
	} else {
		$badLinks[]  = array('link'=>$url.$node->getAttribute('href'), 'error'=>$header[0]);
	}

}

echo '<h1>2. Number of Broken Links : '.count($badLinks).'</h1>';
echo "<p class='linksList'>";
foreach ($badLinks as $link) {
	echo '<p>Broken link : '.$link["link"].' --> Error : '.$link["error"].'</p>';
}
echo '</p>';
libxml_use_internal_errors(false);

?>