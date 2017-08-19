<?

$tableNames = array("EctrUserData","EctrPrimaryNavBarLinks");

// Connects to database
function db_connect() {
	return new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");	
}

function getTableNames(){    
    global $tableNames;
	return $tableNames;
}

function getUserTableName(){
    global $tableNames;
	return $tableNames[0];
}

function getPriNavBarTableName(){
    global $tableNames;
	return $tableNames[1];
}

function addUser($fname,$lname,$em,$pass,$utype,$ccID,$usID){
    $mysqli=db_connect();
    $userData=getUserTableName();
    $hashPass = password_hash($pass, PASSWORD_BCRYPT);
    $sql="INSERT INTO $userData (firstname,lastname,email,password,usertype,creditcardID,userID) VALUES ";  
    $sql.="('$fname','$lname','$em','$hashPass','$utype','0','0')";
    $mysqli->query($sql);
    $mysqli->close();
}

//TODO: should be made into a seperate table and called rather than created
function getPriNavBarArray(){
	$links['home.php'] = "Home";
	$links['profile.php'] = "Profile";
	$links['feed.php'] = "News Feed";
	$links['contact.php'] = "Contact Us";
	$links['donate.php'] = "Donate";
	$links['logout.php'] = "Logout";
	return $links;
}

function alterTable($tableName, $command){
    $sql = "ALTER TABLE ".$tableName." ".$command;
    $myspli=db_connect();
    echo '<script>console.log("'.$sql.'")</script>';
    $myspli->query($sql);
    $myspqli->close();
}
?>