<?php
require_once 'init.php';

//if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name 	= isset($_POST['name']) ? $_POST['name'] : '';
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
	$dob 	= isset($_POST['dob']) ? $_POST['dob'] : '';
	$desig 	= isset($_POST['desig']) ? $_POST['desig'] : '';
	$cat 	= isset($_POST['cat']) ? $_POST['cat'] : '';
	$email 	= isset($_POST['email']) ? $_POST['email'] : '';
	$num 	= isset($_POST['num']) ? $_POST['num'] : '';
	$clg 	= isset($_POST['clg']) ? $_POST['clg'] : '';
	$dept 	= isset($_POST['dept']) ? $_POST['dept'] : '';
	$usn 	= isset($_POST['usn']) ? $_POST['usn'] : '';
	
	// 
	

	$stmt = $user->runQuery("SELECT id,image from players where email = :email");
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->execute();
	$obj = $stmt->fetch(PDO::FETCH_OBJ);
	$count = $stmt->rowCount();
	$image = $obj->image;
	if($count == 1){
		if($image == ''){
			echo "ggwp";
		} else {
			echo "ar";
		}
	} else {
		$code = 'APL-'.time();
		$stmt = $user->runQuery("INSERT INTO players (name,gender,dob,desig,cat,email,num,clg,dept,usn,code) values(:name, :gender, :dob, :desig, :cat, :email, :num, :clg, :dept, :usn, :code) ");

		$stmt->bindParam(":name", $name, PDO::PARAM_STR);
		$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
		$stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
		$stmt->bindParam(":desig", $desig, PDO::PARAM_STR);
		$stmt->bindParam(":cat", $cat, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":num", $num, PDO::PARAM_STR);
		$stmt->bindParam(":clg", $clg, PDO::PARAM_STR);
		$stmt->bindParam(":dept", $dept, PDO::PARAM_STR);
		$stmt->bindParam(":usn", $usn, PDO::PARAM_STR);
		$stmt->bindParam(":code", $code, PDO::PARAM_STR);

		if($stmt->execute()){
			
			
			
			echo "ok";

		} else {
			echo "Could not register";
		}
	}


	

//}
?>