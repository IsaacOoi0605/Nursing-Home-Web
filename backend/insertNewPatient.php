<?php

$server="localhost";
$user="root";
$password="";
$db="management";
$data=addslashes(file_get_contents($_FILES['img']['tmp_name']));
$conn = mysqli_connect($server,$user,$password,$db);
$name=$_POST['username'];
$IC=$_POST['userIC'];
$Phone=$_POST['userPhone'];
$Address=$_POST['userAdd'];
$Zip=$_POST['userZip'];
$State=$_POST['userState'];
$sql = "INSERT INTO patient (IC, Contact, Name, Hospitalised,PostCode,Address,State,img_path) VALUES ('$IC', '$Phone','$name',FALSE,'$Zip','$Address','$State','{$data}')";
$result= mysqli_query($conn, $sql);
if($result){
    echo("yes");
}
exit();
?>