<?php
require_once 'init.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$ImageData = $_POST['image_path'];
	$email = $_POST['email'];
die("Beta test is going on.. Please register after some time");
	if(empty($email)){
		echo "Email is empty";
	} else if(empty($ImageData)){
		echo "Please Select an Image";
	} else {

		$size = strlen(base64_decode($ImageData));
		if($size > 700000){
			echo "Image should be less than 512kb";
		} else {
			$stmt = $user->runQuery("SELECT id,name,code from players where email = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			$obj = $stmt->fetch(PDO::FETCH_OBJ);
			$id = $obj->id;
			$code = $obj->code;
			$code = $code.$id;
			$name = $obj->name;


			$ImagePath = 'images/'.$id.'.jpg';
			$ServerURL = 'https://acharyahabba.in/apl/'.$ImagePath;

			$stmt = $user->runQuery("UPDATE players SET image = :url, code = :code WHERE email = :email");
			$stmt->bindParam(':url', $ServerURL, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':code', $code, PDO::PARAM_STR);
			if($stmt->execute()){
				if(file_put_contents($ImagePath,base64_decode($ImageData))){

					$subject   = "APL Registration Confirmation";
					$headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: APL-4<developers@acharyahabba.in>" . "\r\n";
					$htmlContent = '
								    <html>
								    <body>
								        <div style="width: 600px; height: 120px; padding: 25px; display: block;
								        	box-sizing: content-box; border: 1px solid red; 
								        	font-size:12pt; font-style: helvatica; box-shadow: 10px 10px grey;">
								        	Dear '.$name.',<br>
								        	We are proud to inform you, that you have successfully registered for the APL 2018. And your Confirmation Code is <b><i>'.$code .'</i></b>.<br>
								        	You have taken the first step in a wonderful journey, that is the APL.<br><br>
								        	Thank you.
								        </div>
								    </body>
								    </html>';	

					//mail($email, $subject, $htmlContent, $headers);
					echo "Beta test is going on.. Please register after some time";
				//echo "Registration successfull";
				} else {
					echo "something went wrong";
				}

			} else {
				echo "Not Uploaded";
			}
		}
		
	}


	

}


?>