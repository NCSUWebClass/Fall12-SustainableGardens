<?php
echo "<!DOCTYPE html>\n"; 
echo "\n";  
echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">\n"; 
echo "  <title>NCSU Horticulture eCard Demo</title>\n"; 
echo "\n"; 
echo "    <!-- include the Tools -->\n"; 
echo "  <script src=\"http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js\"></script>\n"; 
echo "  \n"; 
echo "  <!-- standalone page styling (can be removed) -->\n"; 
echo "  <link rel=\"stylesheet\" type=\"text/css\" href=\"/main/standalone.css\">\n"; 
echo "<!-- Tab Styling -->\n"; 
echo "  <link rel=\"stylesheet\" href=\"/main/tabs.css\" type=\"text/css\" media=\"screen\">\n"; 
echo "</head>\n"; 
echo "<body><!-- the tabs -->\n"; 
echo "<h2>NCSU Urban Horticulture eCard Site</h2>\n"; 
echo "<br><br><br>\n"; 
echo "<ul class=\"tabs\">\n"; 

$counter = 1;
$xml = simplexml_load_file("cat.xml");
foreach($xml->category as $child)
  {
	if ($counter == 1)
	{
		echo('<li><a href="#" class="current">');
		echo $child->displayname;
		echo ('</a></li>');
	}
	else
	{
		echo('<li><a href="#" class="none">');
		echo $child->displayname;
		echo ('</a></li>');
	}
   $counter++;
  }


echo "\n"; 
echo "</ul>\n"; 
echo "\n"; 
echo "<!-- tab \"panes\" -->\n"; 
echo "<div class=\"panes\">\n"; 

//gets images for each category
$counter = 1;
$xml = simplexml_load_file("cat.xml");
foreach($xml->category as $child)
  {
	$counter=1;
	echo('<div>');
		$images = file(getcwd()."/categories/".$child->name.".dat");
		foreach($images as $values)
		{
			echo ('<a href="test.php"><img src="/media/logo.jpg"</a>');
			
			
		//	echo '<img src="';
		//	echo"http://ecard.comule.com/flowers".$values."image.jpg";
		//echo '"width="100" height="100""'
		//	echo($values);
		//	echo("&greeting=");
		//	echo($child->name);
//		echo('</a>');
			if($counter==10)
			{
				echo'</br>';
				$counter = 1;
			}
			else
			{
				$counter++;
			}
		}
	echo ('</div>');
   $counter++;
  }
echo "		\n"; 
echo "</div>\n"; 
echo "\n"; 
echo "<script>\n"; 
echo "// perform JavaScript after the document is scriptable.\n"; 
echo "$(function() {\n"; 
echo "\n"; 
echo "    $(\"ul.tabs\").tabs(\"div.panes > div\");\n"; 
echo "});\n"; 
echo "</script>\n"; 
echo "\n"; 
echo "\n"; 
echo "</body></html>\n";
?>