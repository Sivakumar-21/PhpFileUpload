<?Php
$target_dir= "upload/";
//specify the file path => Ex: upload.anyfilename.jpg
$target_file= $target_dir.basename($_FILES['fileToUpload']['name']);
$uploadok = 1;

//check the file type => ex: jpg, png or gif
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {

  print_r($_POST);
  exit();
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}


// Check file size
if($_FILES['fileToUpload']['size'] > 500000){
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else{
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
    $htmltext = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
    echo "The file." .$htmltext. "has been uploaded.";
    

  }
  else {
    echo "Sorry, there was an error uploading your file.";
  }
}





?>



<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  <hr>
  Select image to upload: <br>
  <input type="file" name="fileToUpload" id="fileToUpload"><br>
  <input type="submit" value="Upload Image" name="submit"><br>
</form>

</body>
</html>