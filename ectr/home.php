<? 
require_once("functions.php");
require_once("./AccountManagement/EctrUserClass.php");
session_start();

if ($_SESSION['authenticated'] != true) {
  die("Access denied");	
}

$cssLoc=array("./css/style2.css");
print_html_header("Home",true);

echo 'Welcome to Ectr, '.$_SESSION["user"]->firstName.'. Use the menu above to navigate.';

print_html_footer();
?>