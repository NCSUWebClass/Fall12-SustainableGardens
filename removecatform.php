<?
$cat =  $_REQUEST['type'];

echo('<fieldset ><legend>Delete Category?</legend><form id="editimageform" action="removecat.php" method="post" enctype="multipart/form-data">');

//Category Name
echo('Name: <input type="text" name="catname" value="');
echo($cat);
echo('" readonly><br/><br/>');


//Submit for button
echo('<input type="submit" class="btn btn-primary" value="Delete Category"></form></fieldset >');


?>