<?php
//timeline
require_once 'class.user.php';
$user = new User();
$stmt = $user->runQuery("SELECT * FROM timeline ORDER BY timestamp asc");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($result)
echo json_encode(array('result' => $result));

?>