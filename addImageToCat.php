<?include("access.php");

$imageName = $_REQUEST['image'];
$catName = $_REQUEST['cat'];

if($imageName == '' || $catName == ''){

	die("Parameters are empty.  Quiting.");
	
}

$catName = str_ireplace("\'","",$catName);
$imageName= str_ireplace("\'","/",$imageName);


$catPath = getcwd()."/categories/".$catName.".dat";


file_put_contents($catPath,$imageName."\n", FILE_APPEND ); 




//add Cat from images.xml
	$file = "images.xml";
	$fp = fopen($file, "rb") or die("cannot open file");
	$str = fread($fp, filesize($file));
	fclose($fp);

	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Error");

	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('image');

	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tempp = $child->getElementsByTagName('cat');
		$tname = $tempname->item(0)->nodeValue;



		if(strcmp($tname,$imageName)==0){

			$newCat = $xml->createElement('cat');
			$catText = $xml->createTextNode($catName);
			$newCat->appendChild($catText);
			$child->appendChild($newCat);
			
			break;

		}




	}

file_put_contents("images.xml",$xml->saveXML());






?>