<?php
header('Access-Control-Allow-Origin: *');
require_once 'class.user.php';
$user = new User();
$stmt = $user->runQuery("SELECT * FROM events");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('result' => $result));

?>