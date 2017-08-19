<?
require_once("EctrUserClass.php");
require_once("../Database/QueryCommands.php");
session_start();
emailMatch();

function emailMatch(){
    if(isset($_GET["verification"])&&isset($_GET["email"])){
        if( $_SESSION["verification"]&&isset($_SESSION["user"]->email)){
            if($_SESSION["user"]->email==$_GET["email"]){
                if($_SESSION["verification"]==$_GET["verification"]){
                    $_SESSION["user"]->addUserToTable();                    
                    $_SESSION["authenticated"]=true;
                    header("Location: ../Database/show_data.php");
                    exit;
                }else{
                    echo '<script>alert("Mismatching Verifications")</script>';            
                    echo '<script>alert("$Session = '.$_SESSION["verification"].'")</script>';
                    echo '<script>alert("$Get = '.$_GET["verification"].'")</script>';
                }
            }else{
                echo '<script>alert("Nothing here2")</script>';                
            }
        }else{
            echo '<script>alert("Nothing here3")</script>';            
        }
    }
}
?>
