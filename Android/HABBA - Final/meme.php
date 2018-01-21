<?php
// memes
require_once 'class.user.php';
$user = new User();

$stmt = $user->runQuery("SELECT * FROM memes order by id desc");
$stmt->execute();

$feed = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('feed' => $feed));

?>