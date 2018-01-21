<?php
require_once 'class.user.php';
$user = new USER();

$email = isset($_POST['email']) ? $_POST['email'] : '';

$user_existed = $user->checkEmail($email);

if($user_existed){
	$id = $user->getUserID($email);
	echo $id; 
} else {
	$user->register($email); // if user is not existed register user
	echo 0; // send 0
}

?>