<?
require_once("QueryCommands.php");
session_start();
/*
if ($_SESSION['authenticated'] != true) {
	die("Access denied");	
}
*/
$mysqli = new mysqli("localhost", "sienasel_sbxusr", "Sandbox@)!&", "sienasel_sandbox");


//Showing User Data Table
$userData=getUserTableName();
$result = $mysqli->query("SHOW COLUMNS FROM ".$userData);

echo '<table>';
echo '<tr>';
while ($row = $result->fetch_row()) {
	echo '<th>'.$row[0]."</th>";
}
echo '</tr>';

$result->close();

$result = $mysqli->query("SELECT * FROM ".$userData);

while ($row = $result->fetch_row()) {
	echo '<tr>';
	foreach ($row as $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';
$result->close();








/*
$result = $mysqli->query("SHOW COLUMNS FROM Questions9017");

echo '<table>';
echo '<tr>';
while ($row = $result->fetch_row()) {
	echo '<th>'.$row[0]."</th>";
}
echo '</tr>';

$result->close();

$result = $mysqli->query("SELECT * FROM Questions9017");

while ($row = $result->fetch_row()) {
	echo '<tr>';
	foreach ($row as $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

$result->close();
*/


$mysqli->close();

?>