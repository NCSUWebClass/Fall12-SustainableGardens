<?php


$xml = simplexml_load_file("images.xml");

echo('<fieldset ><form id="newcatform" action="creatcat.php" method="post" enctype="multipart/form-data">');
echo('<br />Category Name: <input type="text" name="catname"><br /><br />');


echo('<fieldset ><legend>Add Images</legend>');
echo'<table id = "imageTable" width="999px" border = "1"><tr>';
$number = 1;
foreach($xml->image as $child)
  {
  echo ('<td class="cell"><div id="images" class="center"><input type = "checkbox" name = "images[]" value="');
  echo $child->name;
  echo ('"> '.$child->name.'<br /> <img src="');
  echo 'http://ecard.comule.com/flowers/'.$child->name.'/image.jpg';
  echo '" ><br/>';
  echo('<br/></div></td>');
  if($number == 5) {
  echo '</tr><tr>';
	$number = 1;
  } else {
	$number++;
  }
  
  }

echo('</tr></table></fieldset>');

echo('<br><br>');

echo('<input type="submit" class="btn btn-primary" value="Create Category"></form></fieldset >');


?>
