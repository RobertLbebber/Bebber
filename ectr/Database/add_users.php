<?

if($_GET['key']!="3587") {
	die("Access denied");
}

$hashOfABC = password_hash("abc", PASSWORD_BCRYPT);

$sql = "INSERT INTO Users780646 VALUES ('alice', '".$hashOfABC."', 'admin', '0', '0')";

$mysqli = new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");			
$mysqli->query($sql);
$mysqli->close();

?>