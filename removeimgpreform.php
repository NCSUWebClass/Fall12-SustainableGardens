<? include('access.php');


$xml = simplexml_load_file("images.xml");

//Form heading
echo('<fieldset>');

//Create Radio button for each image
foreach($xml->children() as $child)
	{
		echo('<input type ="radio" onclick = "loadremoveimageform(this.value)" name="image" value ="');
		echo($child->name);
		echo('" />');
		echo($child->name);
		echo('<br/>');
		

	}

//End fieldset
echo('</fieldset>');
echo('<div name="editimageform" id="form"></div>');



?>