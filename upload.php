<html>
<body>

<?php

// Location to store uploaded files, relative to location of this script
// always include trailing slash
$upload_dir = "/var/www/images/";

// This is where the images are going to be loaded from, relative to the URL
$image_dir = "images/";

if($_POST['file-included'] != 1)
{

$this_file = $_SERVER['PHP_SELF'];

?>

<form action="<?=$this_file?>" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
<input type="hidden" name="file-included" value="1"
</form>

<?
  exit;
}
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 300000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists($upload_dir . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $upload_dir . $_FILES["file"]["name"]);
      $file_location = $image_dir . $_FILES["file"]["name"];
      echo "Stored in: <a href='{$file_location}' target='new'>{$file_location}</a><br>";
      echo "<a href='".$this_file."'>Upload Another</a>";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>

</body>
</html>

