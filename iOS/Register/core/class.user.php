<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;

	
	public function __construct()
	{

		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function checkInput($var){
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;
	}

	public function getUserID($email){
		$stmt = $this->conn->prepare("SELECT id FROM users WHERE email = :email");
		$stmt->bindParam(":email", $email, PDO::PARAM_INT);
		$stmt->execute();
		$user_id = $stmt->fetch(PDO::FETCH_OBJ);
		return $user_id->id;
	}
	
	public function checkEmail($email){
		$stmt = $this->conn->prepare("SELECT id FROM users WHERE email = :email");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();

		if($count > 0){
			return true;
		} else {
			return false;
		}
	}

	public function register($email)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO users(email) 
				VALUES(:email)");
			$stmt->bindparam(":email",$email);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==$this->Secured_password($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						
						if(!empty($_POST['remember'])){
							setcookie ("email",$email,time()+ (30 * 24 * 60 * 60)); //30 days
							setcookie ("password",$upass,time()+ (30 * 24 * 60 * 60)); //30 days
						} else {
							@setcookie("email","");
							@setcookie("password","");
						}

						return true;



						
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="your_gmail_id_here@gmail.com";  
		$mail->Password="your_gmail_password_here";            
		$mail->SetFrom('your_gmail_id_here@gmail.com','Coding Cage');
		$mail->AddReplyTo("your_gmail_id_here@gmail.com","Coding Cage");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}

	public function uploadImage($filename, $filesize){
		$fileinfo  = pathinfo($filename);
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		
		if($filesize <= 500000){
			$upload_path = 'images/';
			$website = 'http://acharyahabba.in/apl/';
			$upload_url = $website.$upload_path;

			$imageName = $this->getFileName();
			$file_url = $upload_url . $imageName . '.' . $extension;
			$file_path = $upload_path . $imageName . '.'. $extension;

			if(move_uploaded_file($_FILES['image']['tmp_name'],$file_path)){
				return $file_url;
			} else {
				$GLOBALS['imageError'] = "something went wrong";
			}
		} else {
			$GLOBALS['imageError'] = "File is loo large";
		}

		

	}

	private function getFileName(){
		$sql = "SELECT max(id) as id FROM players ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$id = $stmt->fetch(PDO::FETCH_OBJ);
		if($id == NULL){
			return 1;
		} else {
			return ++$id->id;
		}	
	}	
}