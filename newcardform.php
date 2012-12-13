<?php include("access.php");

$xml = simplexml_load_file("cat.xml");

echo('<fieldset ><form id="newimageform" action="./upload.php" method="post" enctype="multipart/form-data">');
echo('Plant Name: <input type="text" name="plantname"><br>');

echo('Description: <textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%" onload="javascript:setup()">');
echo('&lt;p&gt;This is the first paragraph.&lt;/p&gt;');
echo('&lt;p&gt;This is the second paragraph.&lt;/p&gt;');
echo('&lt;p&gt;This is the third paragraph.&lt;/p&gt;');
echo('</textarea><br /><fieldset><legend>Category</legend><div id="catoptions"> ');

foreach($xml->category as $child)
  {
  echo ('<input type = "checkbox" name = "category[]" value="');
  echo $child->name;
  echo ('">');
  echo $child->displayname;
  echo('<br>');
  
  }

echo('</fieldset>');
echo('<script type="text/javascript">setup()</script>');
echo('<br><br><div id="uploadFile">');
echo('<input type="file" accept="image/*" name="fileupload" onchange="validateFile(this.value)" id="fileupload"></br>');
echo('</div><input type="submit" value="Upload" class="btn btn-primary" onload="setup()"></form></fieldset >');

?>