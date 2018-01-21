<?php
require_once 'class.user.php';
$user = new User();

// $stmt = $user->runQuery("SELECT eid,name,lat,lang FROM subcat WHERE status = 'active'"); //WHERE status = 'active'
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode(array('result' => $result));


$venue = array('CS/IS Block', 'Main Auditorium','Mechanical Block','EC/EEE Block','MBA/MCA Block', 'Civil Block', 'AIGS Block', 'Basket Ball Ground', 'Main Stadium', 'Architecture Block', 'Pharmacy Block'); 
$final = array();

for ($i=0; $i < sizeof($venue) ; $i++) { 
	$stmt = $user->runQuery("SELECT name,lat,lang FROM subcat WHERE venue = :v ");
	$stmt->bindParam(":v", $venue[$i], PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$name = array_column($result, 'name');
	$name = implode(", ",$name);

	$lat = array_column($result, 'lat');
	$lat = array_unique($lat);
	$lat = implode(" ",$lat);

	$lang = array_column($result, 'lang');
	$lang = array_unique($lang);
	$lang = implode(" ",$lang);

	

	$final[$i] = array('eid' => $i, 'venue' => $venue[$i], 'name' => $name, 'lat' => $lat, 'lang' => $lang);
	$final2 = array_merge($final,$final[$i]);
	

	 
}

array_splice($final2, sizeof($venue));

foreach ($final2 as $key => $value) {
	if($value['name'] == ""){
		unset($final2[$key]);
	}
}

echo json_encode(array('result' => $final2)); 


?>