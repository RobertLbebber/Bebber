<?
/*
if($_GET['key']!="T8e4F") {
	die("Access denied");
}
*/
$mysqli = new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");			

$sql = "CREATE TABLE EctrUserData ( 
					firstname VARCHAR(64) NOT NULL, 
					lastname VARCHAR(64) NOT NULL, 
                    email VARCHAR(100) NOT NULL,
					password VARCHAR(64) NULL, 
					usertype VARCHAR(64) NOT NULL DEFAULT 'patron', 
					creditcardID INT NOT NULL DEFAULT '0', 
					userID INT NOT NULL AUTO_INCREMENT, 
					PRIMARY KEY (`userID`) 
				)";		
$mysqli->query($sql);
$mysqli->close();

$result = $mysqli->query("SHOW COLUMNS FROM EctrUserData");
echo "<h4>$result</h4>";
//header("Location: show_data.php");
?>
<h1>
    Looks Good Here
</h1>
