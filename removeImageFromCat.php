<?include("access.php");

$imageName = $_REQUEST['image'];
$catName = $_REQUEST['cat'];


$catName = str_ireplace("\'","",$catName);
$imageName= str_ireplace("\'","/",$imageName);


if($imageName == "" || $catName==""){

	die("Parameters are empty.  Quiting");

}

$catPath = getcwd()."/categories/";
$catPath = $catPath.$catName.".dat";


//Get images from dat file
$catImages = file($catPath);

//Variables for image arrays
$size = count($catImages);
$j=0;


//Loop to find image in array
for($i=0; $i<$size; $i++){

	if(strcmp(trim($catImages[$i]), $imageName)!=0){
	
		$newImageList[$j] = $catImages[$i];
		$j++;
	
	}

}


//update dat file
file_put_contents($catPath, $newImageList);


$catName = str_ireplace("\'","",$catName);
$imageName= str_ireplace("/","",$imageName);



	//Remove Cat from images.xml
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

			foreach($tempp as $t){
				
				$tcat = $t->nodeValue;
				if(strcmp($tcat,$catName)==0){

					$child->removeChild($t);
					break;	
								
				}

			}

			break;

		}

	}

file_put_contents("images.xml",$xml->saveXML());

?>