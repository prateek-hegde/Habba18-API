<?php
require_once 'class.user.php';
$user = new User();

$meet = $user->runQuery("SELECT status FROM meeting WHERE id = 1");
$meet->execute();
$stObj = $meet->fetch(PDO::FETCH_OBJ);
$status = $stObj->status;
if($status == 0){
	//echo "Fuck off";
	exit();
}


if(isset($_GET['email'])){
	$email = $_GET['email'];
	$stmt = $user->runQuery("SELECT * FROM atn WHERE email = :email");
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result' => $result));
}

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$stmt = $user->runQuery("SELECT atn,status FROM atn WHERE id = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$obj = $stmt->fetch(PDO::FETCH_OBJ);
	if($obj->status == 0){
	$atn = $obj->atn;
    $atn = $atn + 1;

	$sts = '1';
	$update = $user->runQuery("UPDATE atn SET atn = :atn, status = :sts WHERE id = :id");
	$update->bindParam(":id", $id, PDO::PARAM_INT);
	$update->bindParam(":atn", $atn, PDO::PARAM_INT);
	$update->bindParam(":sts", $sts, PDO::PARAM_STR);
	$update->execute();


	} else {
		echo "Attendance already taken";
	}
	

	//echo "Attendance taken";
}



?>