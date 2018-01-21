<?php
require_once 'class.user.php';
$user = new User();
$stmt = $user->runQuery("SELECT * FROM notification ORDER BY timestamp DESC");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('result' => $result));

?>