<?php
require_once 'class.user.php';
header('Access-Control-Allow-Origin: *');
$user = new User();

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$stmt = $user->runQuery("SELECT eid,name,url,description,amount FROM subcat WHERE cid = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result' => $result));
}

if(isset($_GET['eid'])){
	$id = $_GET['eid'];

	$stmt = $user->runQuery("SELECT * FROM subcat WHERE eid = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result' => $result));
}

?>