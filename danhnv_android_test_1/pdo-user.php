<?php 

require_once "config.php";

class User{

	private $DB2_URL = "http://localhost/danhnv_android_test_2/index.php";

	private $id = "";

	public function __construct(){
		
	}

	public function isLoginExist($username, $password){
		
	    try {
	    	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=". DB_NAME ."", DB_USER, DB_PASSWORD);

			$stmt = $db->prepare("SELECT * from users where username=:username and password=:password LIMIT 1");

			$stmt->execute(array(':username' => $username,
								':password' => $password));
			$count = $stmt->rowCount();

			if ($count > 0) {
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$this->id = $result->id;
				
				return true;
			}
			
			return false;
		} catch(PDOException $pdoex) {
			echo $pdoex->getMessage();
		}
	}

	public function isEmailUsernameExist($username, $email){
            
        try {
        	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=". DB_NAME ."", DB_USER, DB_PASSWORD);

			$stmt = $db->prepare("SELECT * from users where username=:username and email=:email LIMIT 1");

			$stmt->execute(array(':username' => $username,
								':email' => $email));

			$count = $stmt->rowCount();

			if ($count > 0) {
				return true;
			}

			return false;
		} catch(PDOException $pdoex)
		{
			echo $pdoex->getMessage();
		}
    }

    public function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function createNewRegisterUser($username, $password, $email){
            
        $isExisting = $this->isEmailUsernameExist($username, $email);
        
        
        if($isExisting){
            
            $json['success'] = 0;
            $json['message'] = "Error in registering. Probably the username/email already exists";
        }
        
        else{
            
        $isValid = $this->isValidEmail($email);
            
            if($isValid) {
            	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=". DB_NAME ."", DB_USER, DB_PASSWORD);

	            $stmt = $db->prepare("INSERT INTO users (username, password, email, created_at, updated_at) value (:username, :password, :email, NOW(), NOW())");

	            $stmt->execute(array(
	            	':username' => $username,
					':password' => $password,
					':email' => $email));

	            if($stmt){
	                
	                $json['success'] = 1;
	                $json['message'] = "Successfully registered the user";
	                
	            }else{
	                
	                $json['success'] = 0;
	                $json['message'] = "Error in registering. Probably the username/email already exists";
	                
	            }
            }
            else{
                $json['success'] = 0;
                $json['message'] = "Error in registering. Email Address is not valid";
            }
        }
        
        return $json;
    }

    public function loginUsers($username, $password){
            
        $json = array();
        
        $canUserLogin = $this->isLoginExist($username, $password);
        
        if($canUserLogin){
            
            $json['success'] = 1;
            $json['message'] = "Successfully logged in";
            $json['id'] = $this->id;

            session_start();
                
            $_SESSION['id'] = $this->id;
            $_SESSION['username'] = $username;
            $_SESSION['timeout'] = time();
            
        }else{
            $json['success'] = 0;
            $json['message'] = "Incorrect details";
        }
        return $json;
    }

    public function getUserDetailInfo($id) {

        $post = [
            'user_id' => $id
        ];

        $ch = curl_init($this->DB2_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }
}