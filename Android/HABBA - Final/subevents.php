<?php
require_once 'class.user.php';
$user = new User();

if(isset($_GET['main'])){
	$mainc = $_GET['main'];

	$stmt = $user->runQuery("SELECT name,amount FROM subcat WHERE mainc = :mainc");
	$stmt->bindParam(":mainc", $mainc, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(array('result1' => $result));
}


?>