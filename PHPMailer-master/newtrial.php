<?php
require "PHPMailer-master/PHPMailerAutoload.php";
require 'connect.inc.php';
session_start();
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$dukaan_name = mysqli_real_escape_string($connect,$_GET['DN']);
$ID = mysqli_real_escape_string($connect,$_GET['ID']);
$query="SELECT * from mydukaan WHERE '$dukaan_name'=`dukaan_name`";
$result=mysqli_query($connect,$query);
	while($row=mysqli_fetch_array($result))
	{
		$user_id=$row['user_id'];
		$query1="SELECT * from signupdata WHERE '$user_id'=`id`";
		$result1=mysqli_query($connect,$query1);
		while($row1=mysqli_fetch_array($result1))
		{
			$emailid=$row1['email'];
			$firstname=$row1['firstname'];
		}
	}
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
/*$mail->Port = 587;
$mail->SMTPSecure = 'tls';*/


$mail->Username = "amruta0303@gmail.com";
$mail->Password = "amrutasonu";

$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.

$mail->From = "amruta0303@gmail.com";
$mail->FromName = "Dukaan";

$mail->addAddress($emailid,"User 1");

//$mail->addCC("user.3@ymail.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");

$mail->Subject = "Order";
$mail->Body = 
"Hi ".$firstname.",<br/><br/>You have an order from ".$name.".Please click on the Email-ID in this mail to provide
further details to the buyer about the date of delivery and payment methods. Provide your personal details so that
the buyer can keep track of his purchase.<br/>".$email;

if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else{
$query="UPDATE cart SET status='Placed' WHERE id='$ID'  ";
mysqli_query($connect,$query);
echo "Message has been sent";
?><script> location.replace("cart.php"); </script><?php
}
?>