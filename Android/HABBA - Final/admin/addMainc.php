<?php  
 require_once 'init.php';

 $number = count($_POST["mainc"]);  //$_POST["mainc"][$i]
 if($number > 0){ 
   
      for($i=0; $i<$number; $i++){  
      		$rand = rand(1,51);
			$url = 'http://acharyahabba.in/app/images/'.$rand.'.jpg';
           if(trim($_POST["mainc"][$i] != '')){
              $stmt = $user->runQuery("INSERT INTO events (name, url) VALUES (:name, :url) ");
              $stmt->bindParam(":name", $_POST["mainc"][$i], PDO::PARAM_STR);
              $stmt->bindParam(":url", $url, PDO::PARAM_STR);
              $stmt->execute();
           }  
             
      }  
      echo "Data Inserted";  
 }  
 else{  
   
      echo "Please Enter Name";  
 }  
 ?>