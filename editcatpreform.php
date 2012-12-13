<? include('access.php');


$xml = simplexml_load_file("cat.xml");

//Form heading
echo('<fieldset>');

//Create Radio button for each category
foreach($xml->children() as $child)
	{
		echo('<input type ="radio" onclick = "loadeditcatform(this.value)" name="image" value ="');
		echo($child->name);
		echo('" />');
		echo($child->name);
		echo('<br/>');
		

	}

//End fieldset
echo('</fieldset>');
echo('<div name="editimageform" id="form"></div>');



?>