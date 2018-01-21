<?php
require_once 'init.php';

$stmt = $user->runQuery("UPDATE timeline SET status = '2' WHERE date > CURDATE() ");
$stmt->execute();

$stmt3 = $user->runQuery("UPDATE timeline SET status = '1' WHERE date = CURRENT_DATE() ");
$stmt3->execute();

$stmt2 = $user->runQuery("UPDATE timeline SET status = '0' WHERE date < CURDATE() ");
$stmt2->execute();
?>