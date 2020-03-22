<?php

libxml_use_internal_errors(true);
$url = $_POST['url'];
$html = file_get_contents($url);
$doc = new DOMDocument();
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);
$nbrOfJSLib = 0;
$JSlib = array();

$nodes = $xpath->query('//script');

foreach($nodes as $node) {

	if ($url.$node->getAttribute('src'));
	{
		if ($url.$node->getAttribute('src') != $url) {
			$nbrOfJSLib++;
			$JSlib[] = array('link'=>$url.$node->getAttribute('src'));
		}
	}
}

echo '<h1>3. Javascript Library used : '.count($JSlib).'</h1>';
echo "<p class='jslib'>";
foreach ($JSlib as $link) {
	echo 'Javascript Library used link : '.$link["link"]."<br>";
}
echo '</p>';


libxml_use_internal_errors(false);


?>