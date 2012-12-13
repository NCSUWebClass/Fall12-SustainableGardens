<?php
$type = $_REQUEST['type'].".dat";

//get content of textfile
$filename = $type;
$images = file(getcwd()."/categories/".$filename);
$discript1 = getcwd();

echo'<table border = "10" bordercolor = BLACK>';
foreach($images as $values){
	echo '<tr border = "10"><td><table border = "2" bordercolor=RED>';

	$path = rtrim($values);

	$discript = $discript1."/flowers/".$path."discription.txt";
	
	$discriptionarray= file($discript );
	
	$discription = implode("<br>", $discriptionarray);
	echo'<tr><td>Image: ';
	echo'<img src="';
        echo "http://ecard.comule.com/flowers".$values."image.jpg";
	echo '" width="50" height="50"><br>';
		echo'</td></tr>';

	
	echo'<tr><td>Discription: ';
	echo '<br>';
	echo $discription;
	echo '<br>';


	echo'</td></tr>';
	echo '</table></td></tr>';

}
echo '</table>';


?>