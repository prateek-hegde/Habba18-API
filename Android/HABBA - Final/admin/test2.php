<?php
require_once 'init.php';
	$caption = 'test caption';
	$name = 'test name';
	
for ($i=0; $i <150 ; $i++) { 
	
	$rand = rand(4,6);
	$file_url = 'http://acharyahabba.in/habba18/admin/memes/'.$rand.'.jpg';
	
	$stmt = $user->runQuery("INSERT INTO memes (caption,image,name) VALUES (:caption, :fileurl, :name) ");
	$stmt->bindParam(":fileurl", $file_url, PDO::PARAM_STR);
	$stmt->bindParam(":caption", $caption, PDO::PARAM_STR);
	$stmt->bindParam(":name", $name, PDO::PARAM_STR);
	$stmt->execute();
}

?>