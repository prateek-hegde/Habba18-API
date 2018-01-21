<?php
header('Access-Control-Allow-Origin: *');
require_once 'init.php';
//$user = new User();
$stmt = $user->runQuery("SELECT * FROM college");
try {
	$stmt->execute();
} catch (Exception $e) {
	echo $e->getMessage();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('result' => $result));

?>