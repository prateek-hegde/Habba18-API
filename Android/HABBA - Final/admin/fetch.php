<?php
 require_once 'init.php';
if(isset($_POST['get_option'])){
	$subc = $_POST['get_option'];

	$stmt = $user->runQuery("SELECT * FROM subcat WHERE mainc = :subc ");
	$stmt->bindParam(":subc", $subc, PDO::PARAM_STR);
	$stmt->execute();
	echo "<option>Select Subcategory</option>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	
		echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
	}
	exit;
}
?>