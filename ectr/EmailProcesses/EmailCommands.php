<?
function sendEmail($emailAddress,$emailMessage){
$to = $emailAddress;
$subject = "HTML email";
// Always set content-type when sending HTML email
$headers = "From: Robert.l.bebber@gmail.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to,$subject,$emailMessage,$headers);
}
?>