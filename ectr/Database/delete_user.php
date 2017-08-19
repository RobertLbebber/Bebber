<? session_start();

if ($_SESSION['authenticated'] != true&&_SESSION['usertype']!="admin") {
	die("Access denied");	
}
require_once("functions.php");
print_html_header("Delete User");
$action = $_POST['action'];

if ($action == "Delete User" ) {

  $usr = $_POST['username'];

	$mysqli = new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");
				
	$sql = "DELETE FROM User9017 WHERE username='$usr'";
	$mysqli->query($sql);
	
	if ($mysqli->affected_rows > 0) {
		echo '<p>'.$usr. ' was deleted.</p>
					<p><a href="delete_user.php">Delete Another User</a></p>';
		die();
	}
	else  {
		echo '<p>'.$usr. ' was not found.</p>
					<p><a href="delete_user.php">Delete Another User</a></p>';
		die();
	}
	$mysqli->close();
}
?>

  <form method="post" action="delete_user.php">
    <label>Username: <?
		$mysqli = new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");
		$result = $mysqli->query("SELECT username FROM User9017");
		echo '<select name="username">';
		while ($row = $result->fetch_row()) {
			echo '<option>'.$row[0]."</option>";
		}
		echo '</select>';
	?></label><br>
	
    <input type="submit" name="action" value="Delete User"> 
  </form>
	</body>
</html>