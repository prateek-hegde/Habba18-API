<?php
require_once 'class.user.php';
$user = new User();
$i = "";
$j = "";

if(isset($_POST['start'])){
	$start = '1';

	$stmt = $user->runQuery("UPDATE meeting SET status = :start");
	$stmt->bindParam(":start", $start, PDO::PARAM_STR);
	$stmt->execute();
	
	$stmt = $user->runQuery("SELECT * FROM atn");
	$stmt->execute();
	$count = $stmt->rowCount();

	$sts = '0';
	try{
		for($i = 1; $i<= $count; $i++){
		$stmt = $user->runQuery("UPDATE atn SET status = :sts WHERE id = :i");
		$stmt->bindParam(":i", $i, PDO::PARAM_STR);
		$stmt->bindParam(":sts", $sts, PDO::PARAM_STR);
		$stmt->execute();
		}
	} catch(PDOExeption $e){
		echo $e->getMessage();
	}
}

if(isset($_POST['end'])){
	$end = '0';

	$stmt = $user->runQuery("UPDATE meeting SET status = :end");
	$stmt->bindParam(":end", $end, PDO::PARAM_STR);
	$stmt->execute();

	// $stmt = $user->runQuery("SELECT name FROM atn");
	// $stmt->execute();
	// $count = $stmt->rowCount();

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Meeting</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
<div align="center" style="padding-top: 50%">
	<form method="post" action="">
	<input type="hidden" name="start" value="1">
	<button type="submit" name="start" class="btn btn-success">Start Meeting</button>
</form> <br> <br>
<form method="post" action="">
	<input type="hidden" name="end" value="0">
	<button type="submit" name="end" class="btn btn-danger">End Meeting</button>
</form> 
</div>
</body>
</html>