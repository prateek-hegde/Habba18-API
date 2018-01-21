<?php
require_once 'class.user.php';
header('Access-Control-Allow-Origin: *');
$user = new User();

if(isset($_GET['cid'])){
	$cid = $_GET['cid'];

	$stmt = $user->runQuery("SELECT * FROM dept WHERE cid = :cid");
	$stmt->bindParam(":cid", $cid, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result' => $result));
}

if(isset($_GET['name'])){
	$name = $_GET['name'];

	$stmt = $user->runQuery("SELECT * FROM dept WHERE clg_name = :name");
	$stmt->bindParam(":name", $name, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result' => $result));
}
?>