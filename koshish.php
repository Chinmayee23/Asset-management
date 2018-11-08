<html>
<body>
<?php
require 'connect.inc.php';
				$ID = mysqli_real_escape_string($connect,$_GET['ID']);
				$C = mysqli_real_escape_string($connect,$_GET['C']);
				$O = mysqli_real_escape_string($connect,$_GET['O']);
				if($ID!=0 && $C==0){
				$query2="UPDATE `requests` SET `status`='Approved'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Approving");
				header('Location:request_pending.php?ID=0&D=1');
				}
				else if($ID!=0 && $C==1){
				$query2="UPDATE `requests` SET `status`='Delivered'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Delivering");
				header('Location:request_pending.php?ID=0&C=10&D=1');
				}
				else if($ID!=0 && $C==2){
					$query2="UPDATE `requests` SET `status`='Issued'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:asset_requests.php?ID=0&C=10&D=1');
				}
				else if($ID!=0 && $C==3){
					$query2="UPDATE `requests` SET `status`='$O'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:asset_requests.php?ID=0&C=10&D=1');
				}
				else if($ID!=0 && $C==4){
					$query2="UPDATE `requests` SET `status`='HOD approved'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:mailprincipal.php?ID=0&C=10&D=2');
				}
				else if($ID!=0 && $C==5){
					$query2="UPDATE `requests` SET `status`='Returned'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:asset_requests.php?ID=0&C=10&D=1');
				}
				else if($ID!=0 && $C==6){
					$query2="UPDATE `requests` SET `status`='Principal approved'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:request_pendingp.php?ID=0&C=10&D=1');
				}
				else if($ID!=0 && $C==7){
					$query2="UPDATE `requests` SET `status`='HOD disapproved'  WHERE `reqid`='$ID' ";
				mysqli_query($connect,$query2);
				echo("Updating");
				header('Location:request_pendingp.php?ID=0&C=10&D=1');
				}
				
				
?>
</body>
</html>