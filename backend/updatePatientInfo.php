<?php

$server="localhost";
$user="root";
$password="";
$db="management";
$conn = mysqli_connect($server,$user,$password,$db);
$patID=$_POST['userID'];
$name=$_POST['username'];
$IC=$_POST['userIC'];
$Phone=$_POST['userPhone'];
$Address=$_POST['userAdd'];
$Zip=$_POST['userZip'];
$State=$_POST['userState'];
if($data=addslashes(file_get_contents($_FILES['img']['tmp_name']))){
    $sql="UPDATE patient SET IC='$IC',Contact='$Phone',Name='$name',PostCode='$Zip',Address='$Address',State='$State',img_path='{$data}' WHERE PatientID='$patID'";
}
else{
    $sql="UPDATE patient SET IC='$IC',Contact='$Phone',Name='$name',PostCode='$Zip',Address='$Address',State='$State' WHERE PatientID='$patID'";
}
$result= mysqli_query($conn, $sql);
if($result){
    echo("true");
}
exit();
?>