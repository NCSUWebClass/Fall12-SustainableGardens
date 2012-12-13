<?

$catName = "birthday";


//Remove Cat from images.xml
$file = "cat.xml";
$fp = fopen($file, "rb") or die("cannot open file");
$str = fread($fp, filesize($file));
fclose($fp);

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Error");



	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('category');


	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tname = $tempname->item(0)->nodeValue;


		foreach($tempname as $t){
		if(strcmp($tname,$catName)==0){
	
			$root->removeChild($child);
			echo('<li>Removed node from category.xml</li>');
			break;

		}

		}
	}

//file_put_contents("cat.xml",$xml->saveXML());
echo('<br>');
echo $xml->saveXML();


?>