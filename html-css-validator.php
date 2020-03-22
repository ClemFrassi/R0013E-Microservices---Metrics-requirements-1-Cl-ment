<?php

$url = $_POST['url'];
$html = file_get_contents($url);

$results = shell_exec('curl -H "Content-Type: text/html; charset=utf-8" \ --data-binary @website.html \ https://validator.w3.org/nu/?out=gnu');
$tabresults = explode(":",$results);
$size = count($tabresults);
$finalResult = array();

for ($i=0; $i < $size ; $i++) { 
	if ($tabresults[$i] == " info warning") {
		$finalResult[] = array('type'=>"Line : ".$tabresults[$i-1]." --> ".$tabresults[$i]." --> ".$tabresults[$i+1]);

	} else if ($tabresults[$i] == " error") {
		if ($tabresults[$i+1] == " CSS") {
			if ($tabresults[$i+1] == " Parse Error.") {
				$finalResult[] = array('type'=>"Line : ".$tabresults[$i-1]." --> ".$tabresults[$i]." --> ".$tabresults[$i+1]." : ".$tabresults[$i+2]);

			} else {
				$finalResult[] = array('type'=>"Line : ".$tabresults[$i-1]." --> ".$tabresults[$i]." --> ".$tabresults[$i+1]." : ".$tabresults[$i+2]." : ".$tabresults[$i+3]);
			}
		} else {
			$finalResult[] = array('type'=>"Line : ".$tabresults[$i-1]." --> ".$tabresults[$i]." --> ".$tabresults[$i+1]);
		}
	}
}

echo "<h1>1. HTML / CSS Validator - Number of Error : ".count($finalResult)."</h1>";
echo "<p class='validatorErrors'>";
foreach ($finalResult as $result) {
	echo $result["type"]."<br>";
}
echo "</p>";
?>