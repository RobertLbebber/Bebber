<?
session_start();
require_once("../QueryCommands.php"); 
echo '<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <title>Table Commands</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="/ectr/css/style.css">
	</head>
    <body>
        <div class="container">	
            <h1>MSQL Command Page</h1>
            <form method="post" action="./run.php">';
                //Password is "runThis"
 echo          '<label>Password Verification: <input type="password" name="password"></label><br>
                <label>Operation Procedure: <input type="text" name="operation"></label><br>
                <label>Table For Alteration:
                    <select name="table">';
$tables=getTableNames();
for($i=0; $i<count($tables);$i++){
    echo                '<option name="tableName value="'.$tables[$i].'>'.$tables[$i].'</option>';
    
    echo                '<script>console.log("Table '.$i.' value = '.$tables[$i].'")</script>';
}   
echo                '</select>
                </label>
                <br><br>
                <input type="submit" name="action" value="Submit"> 
            </form>
        </div>
    </body>
</html>';




$action = $_POST["action"];
$verification= $_POST["password"];
if(empty($_POST) == false && $action=="Submit" && $verification=="runThis"){
    echo '<h3>'.$_POST["table"].' | '.$_POST["operation"].'</h3>';
    alterTable($_POST["table"],$_POST["operation"]);
}else if (empty($_POST) == false){
    echo "<h3>Authorization Rejected</h3>";
}
?>