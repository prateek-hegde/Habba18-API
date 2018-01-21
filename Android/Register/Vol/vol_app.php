<?php
require_once 'class.user.php';
$user = new User();

$name 	= isset($_POST['name']) ? $_POST['name'] : '';
$email 	= isset($_POST['email']) ? $_POST['email'] : '';
$num	= isset($_POST['num']) ? $_POST['num'] : '';
$clg 	= isset($_POST['clg']) ? $_POST['clg'] : '';
$dept 	= isset($_POST['dept']) ? $_POST['dept'] : '';
$year 	= isset($_POST['year']) ? $_POST['year'] : '';
$usn 	= isset($_POST['usn']) ? $_POST['usn'] : '';
$exp 	= isset($_POST['exp']) ? $_POST['exp'] : '';
$skill 	= isset($_POST['skill']) ? $_POST['skill'] : '';
$aboutme = isset($_POST['aboutme']) ? $_POST['aboutme'] : '';
$suggest = isset($_POST['suggest']) ? $_POST['suggest'] : '';
$interest = isset($_POST['interest']) ? $_POST['interest'] : '';

//die("Beta test is going on.. Please register after some time");

if(strlen($num) != 10){
	die('invalid Phone number');
} 

$stmt = $user->runQuery("SELECT id from vol where email = :email");
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();
if($count >= 1){
	echo "You are already registered";
} else {
	$stmt = $user->runQuery("INSERT into vol (name,email,num,college,dept,year,usn,exp,interst,skill,aboutme,suggestion) values (:name, :email, :num, :clg, :dept, :year, :usn, :exp, :interst, :skill, :aboutme, :suggest) ");
	$stmt->bindParam(":name", $name, PDO::PARAM_STR);
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->bindParam(":num", $num, PDO::PARAM_STR);
	$stmt->bindParam(":clg", $clg, PDO::PARAM_STR);
	$stmt->bindParam(":dept", $dept, PDO::PARAM_STR);
	$stmt->bindParam(":year", $year, PDO::PARAM_STR);
	$stmt->bindParam(":usn", $usn, PDO::PARAM_STR);
	$stmt->bindParam(":exp", $exp, PDO::PARAM_STR);
	$stmt->bindParam(":interst", $interest, PDO::PARAM_STR);
	$stmt->bindParam(":skill", $skill, PDO::PARAM_STR);
	$stmt->bindParam(":aboutme", $aboutme, PDO::PARAM_STR);
	$stmt->bindParam(":suggest", $suggest, PDO::PARAM_STR);
	
	try {
		$stmt->execute();
		
		$subject   = " Voluteer Registration Confirmation";
		$header    = 'From: noreply@acharya.habba';
		$body 	   = "Dear Student,\n
					 We are proud to inform you, that you have successfully registered for the Habba 18 volunteer program. You have taken the first step in a wonderful journey that is the Habba. \n
						Thank you.";
			 
			// mail($email, $subject, $body, $header);

		//echo "Beta test is going on.. Please register after some time";
		echo "You are succesfully registered";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



?>