<? 
require_once("functions.php");
require_once("AccountManagement/EctrUserClass.php");
require_once("Database/QueryCommands.php");
session_start();
session_destroy();
session_start();
print_html_header("Login",false);


// Error is empty string
$error = "";

//  Only process if $_POST is not empty and the Insert button was pressed 
if (isset($_POST['action']) && $_POST['action'] == "Login") {

  $submitted_email = $_POST['email'];
  $submitted_password = $_POST['password'];

	// Connect to database and get stored password and usertype
	$mysqli = db_connect();		
	$result = $mysqli->query("SELECT password, usertype FROM ".getUserTableName()." WHERE email='$submitted_email'");
	$row = $result->fetch_row();
	$stored_password = $row[0]; 
	$mysqli->close();
	
	if ($submitted_password != "" && password_verify($submitted_password,$stored_password)) {
        $_SESSION['authenticated'] = true;
        $temp= new EctrUserClass();
        $_SESSION["user"]=$temp->userDataToObject("email",$submitted_email);
        if($_SESSION["user"]){
           echo "<script>alert(".$_SESSION["user"]->firstName.")</script>";
	       header("Location: home.php");
	       die();
        }
	}
	else {
		 $error = '<p>Login failed</p>';
	}
}else if(empty($_POST) == false && $_POST['newUser'] == "Sign Up"){
	header("Location: ./AccountManagement/sign_up.php");
}

print_login_form($error);

print_html_footer();

function print_login_form($error) {
	echo '
  <form method="post" action="index.php">
    <label>
    	Email Address: 
    	<input name="email" type="text">
    </label>
    <label>
    	Password: 
    	<input name="password" type="password">
    </label><br>
    <input type="submit" name="action" value="Login"> 
	<input type="submit" name="newUser" value="Sign Up"> 
    '.$error.'
  </form>
  ';
}
?>

