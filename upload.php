<?php 

if(isset($_POST['submit'])){

print_r($_FILES['file_upload']);

$temp_name = $_FILES['file_upload']['tmp_name'];
$the_file = $_FILES['file_upload']['name'];
$directory = "uploads";


if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){
	echo "File uploaded to uploads folder";
} else {
	echo "problem";
}
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>


<form action="upload.php" enctype="multipart/form-data" method="post">
	
<input type="file" name="file_upload"><br>

<input type="submit" name="submit">


</form>


	
</body>
</html>