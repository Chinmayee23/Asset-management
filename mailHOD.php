<html>
<body>
<?php
require "PHPMailer-master/PHPMailerAutoload.php";
require 'connect.inc.php';
session_start();

if(isset($_POST['astname'])&&isset($_POST['quantity']))
{
	
	$astname=$_POST['astname'];
	$quantity=$_POST['quantity'];
	$sthid=$_SESSION['id'];
	$date=date('y/m/d');
	echo $date;
	if(!empty($astname)&&!empty($quantity)&&!empty($sthid))
	{	
					$requests_query = "INSERT INTO requests (sthid,assetname,req_date,quantity,status) VALUES ('$sthid','$astname','$date','$quantity','Requested')";
					if(!mysqli_query($connect,$requests_query))
					{
						echo 'not inserted';
					}
					else
					{
					echo 'inserted';
					error_reporting(E_ERROR | E_PARSE);
					header('Location:login_sh2.php');
					}
					                                         
				}
else{
	echo "no rows returned";
}
}

$email=$_SESSION['email'];
					$dept=$_SESSION['dept'];
										$name=$_SESSION['name'];

					echo $dept;
					$reqhod_query = "select * FROM `stakeholders` WHERE `dept`='$dept' AND `designation`='HOD'";
					if($reqhod_query_run=mysqli_query($connect,$reqhod_query))
							{
								echo "query working";
								$rows=mysqli_num_rows($reqhod_query_run);
								if($rows==0)
								{
									echo "Enter valid username and password combination";
								}
								else if($rows!=0)
								{
									
									//$user_id=mysql_result($login_query_run,0,'id');
									echo "hi";
									$row=mysqli_fetch_assoc($reqhod_query_run);
										$id=$row['sthid'];
																			   echo "sth=$id";

									   $nameh=$row['name'];
									   									   echo $nameh;

									   $emailid=$row['email'];
									   									   echo $emailid;

									   $depth=$row['dept'];
									   echo $depth;
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
$mail->FromName = "ASM";
$mail->addAddress($emailid,"User 1");

//$mail->addCC("user.3@ymail.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");

$mail->Subject = "Order";
$mail->Body = 
"Hi ".$nameh.",<br/><br/>You have a request for approval from ".$name.".Please open the website to approve the request.<br/>";

if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else{
mysqli_query($connect,$query);
echo "Message has been sent";		
	}
	
	
?>
<script> location.replace("login_sh2.php"); </script>
</body>
</html>