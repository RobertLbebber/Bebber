<?
require_once("../functions.php");

session_start();
/*
if ($_SESSION['authenticated'] != true|| $_SESSION['usertype']!='admin') {
    echo '<h1>Access Denied</h1>';
    die("Access denied");	
}
*/
echo '<h1>Access Approved</h1>';
$mysqli = db_connect();
$sql = "DROP TABLE Questions9017";
$mysqli->query($sql);
$sql = "DROP TABLE ectrUserData";
$mysqli->query($sql);
$sql = "DROP TABLE User9017";
$mysqli->query($sql);
$mysqli->close();
?>