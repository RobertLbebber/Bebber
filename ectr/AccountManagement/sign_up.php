<?
require_once("../functions.php");
require_once("../EmailProcesses/EmailCommands.php");
require_once("EctrUserClass.php");
session_start();

$styleLoc=array ("./Style/style.css");
print_html_header("Sign Up",false,$styleLoc);
$emailLoc="verification_email.html";

if(isset($_POST["send"])&&$_POST["send"]=="Enter"){
    $action=$_POST["send"];
    if(empty($_POST)==false&&$action=="Enter"){
        $user = EctrUserClass::WithRow($_POST["FNAME"],$_POST["LNAME"],$_POST["PASS"],$_POST["EMAIL"],"",$_POST["MEMTYPE"]);
        $_SESSION["user"]=$user; 
        sendVerificationEmail($user);
    }
}else if(isset($_POST["send"])&&$_POST["send"]=="Back"){
    header("Location: ../index.php");
    exit;
}

echoForm();

function sendVerificationEmail($user){    
    global $emailLoc;
    $message= file_get_contents($emailLoc);
    $verificationCode=rand(10000,99999);
    $_SESSION["verification"] =$verificationCode;
    $message= str_replace("[REPLACEME0]", $user->firstname,$message);
    $message= str_replace("[REPLACEME]", $verificationCode,$message);
    $message= str_replace("[REPLACEME2]", $_SESSION["user"]->email,$message);
    sendEmail($user->getEmail(),$message);
    /**
    *
    *
    *    Let User Know Email Has Been Sent
    *    
    *    
    **/
}

function echoForm(){
    echo'    <form method="post" action="sign_up.php">
            <div >
                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                <div class="field-group">
                    <label for="EMAIL">Email Address  <span class="asterisk">*</span></label>
                    <input type="email" value="" name="EMAIL" class="required email" id="EMAIL">
                </div>
                <div class="field-group">
                    <label for="mce-FNAME">First Name  <span class="asterisk">*</span></label>
                    <input type="text" value="" name="FNAME" class="required" id="FNAME">
                </div>
                <div class="field-group">
                    <label for="mce-LNAME">Last Name  <span class="asterisk">*</span></label>
                    <input type="text" value="" name="LNAME" class="required" id="LNAME">
                </div>
                <div class="field-group">
                    <label for="mce-PASS">Password  <span class="asterisk">*</span></label>
                    <input type="password" value="" name="PASS" class="required" id="PASS">
                </div>
                <div class="field-group size1of2">
                    <label for="MEMTYPE">Membership </label>
                    <select name="MEMTYPE" class="" id="MEMTYPE">
                        <option value="Patron">Patron</option>
                        <option value="Ectr">Ectr</option>
                    </select>
                </div>
                <div class="field-group">
                    <label for="BIRTHDAY-month">Birthday </label>
                    <div class="datefield">
                        <span class="subfield monthfield">
                            <input class="birthday " type="text" pattern="[0-9]*" value="" placeholder="MM" size="2" maxlength="2" name="BIRTHDAY[month]" id="BIRTHDAY-month">
                        </span> / 
                        <span class="subfield dayfield">
                            <input class="birthday " type="text" pattern="[0-9]*" value="" placeholder="DD" size="2" maxlength="2" name="BIRTHDAY[day]" id="BIRTHDAY-day">
                        </span> / 
                        <span class="subfield yearfield">
                            <input class="birthday " type="text" pattern="[0-9]*" value="" placeholder="YYYY" size="4" maxlength="4" name="BIRTHDAY[year]" id="BIRTHDAY-year">
                        </span> 
                        <span class="date format">( mm / dd / yyyy)</span>
                    </div>
                </div>
                <br><br>
                <div class="clear">
                    <input type="submit" value="Enter" name="send" class="button">
                    <input type="submit" value="Back" name="send" class="button">
                </div>
            </div>
        </form>';
}
?>