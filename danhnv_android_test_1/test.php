<?php
    
    echo "Hello,World <br>";

    require_once 'pdo-user.php';
    
    // Don't do this obviously, just for demo purposes
 //    $user = "root";
 //    $pass = "";
     
 //    $db = new PDO("mysql:host=localhost;dbname=multilevelsauth_users", $user, $pass);
    
 //    try {
	// 	$stmt = $db->prepare("SELECT * from users where username=:username and password=:password LIMIT 1");

	// 	$stmt->execute(array(':username' => "admin",
	// 						':password' => md5("admin")));
	// 	$count = $stmt->rowCount();

	// 	if ($count > 0) {
	// 		$result = $stmt->fetch(PDO::FETCH_OBJ);
	// 		$this->id = $result->id;
			
	// 		return true;
	// 	}
		
	// 	return false;
	// } catch(PDOException $pdoex) {
	// 	echo $pdoex->getMessage();
	// }

$userObject = new User();
if ($userObject->isLoginExist("admin", md5("admin"))) {
	echo "OK! I'm fine";
} else {
	echo "Méo!";
}

