<?php
require_once 'init.php';
if(isset($_POST['submit'])){
	$caption  = $user->checkInput($_POST['caption']);
	$heading  = $user->checkInput($_POST['heading']);
	$url  	  = $user->checkInput($_POST['url']);
	$filename = $_FILES["image"]["name"];
	$filesize = $_FILES["image"]["size"];

	$dir = 'feeds/'; $table = 'feeds';
	$image = $user->uploadImage($filename, $filesize, $dir,$table);
	$stmt = $user->runQuery("INSERT INTO feeds (heading,caption,image,url) VALUES (:heading, :caption, :image, :url) ");
	$stmt->bindParam(":heading", $heading, PDO::PARAM_STR);
	$stmt->bindParam(":image", $image, PDO::PARAM_STR);
	$stmt->bindParam(":caption", $caption, PDO::PARAM_STR);
	$stmt->bindParam(":url", $url, PDO::PARAM_STR);
	if($stmt->execute()){
		$imageError = 'done';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>FEEDS</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<div class="container" align="center" style="width: 40%; padding-top: 20px;">
		<form method="post" id="uploadForm" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleFormControlInput1">Heading</label>
				<input type="text" name="heading" class="form-control" id="exampleFormControlInput1">
			</div>

			<div class="form-group">
				<label for="exampleFormControlInput1">Caption</label>
				<input type="text" name="caption" class="form-control" id="exampleFormControlInput1">
			</div>

			<div class="form-group">
				<label for="exampleFormControlInput1">URL, if any</label>
				<input type="text" name="url" class="form-control" id="exampleFormControlInput1">
			</div>

			<div class="form-group">
				<input type="file" name="image" id="image" class="form-control-file" id="exampleFormControlFile1" accept="image/png, image/jpeg, image/jpg" required>
				<small id="fileHelp" class="form-text text-muted">Photo should be less than 500Kb
					<br> only JPG, JPEG & PNG  files are allowed</small>
				</div>

				<button type="submit" id="btnSubmit" name="submit" class="btn btn-success">Submit</button>
			</form>

			<span><?php if(isset($imageError)){echo $imageError;} ?></span>
		</div>
	</body>
	</html>