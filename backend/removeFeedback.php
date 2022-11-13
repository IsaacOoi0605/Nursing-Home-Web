<?php
$server="localhost";
$user="root";
$password="";
$db="management";
$conn = mysqli_connect($server,$user,$password,$db);
$id=$_POST['id'];
$sql="DELETE FROM support_ticket WHERE FeedbackID='$id'";
if(mysqli_query($conn,$sql)){
    echo 1;
}
exit();
?>