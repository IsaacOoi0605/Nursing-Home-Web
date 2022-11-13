<?php
$server="localhost";
$user="root";
$password="";
$db="management";
$conn = mysqli_connect($server,$user,$password,$db);
$fromDate=date('Y-m-d',strtotime($_POST['fromDate']));
$toDate=date('Y-m-d',strtotime($_POST['toDate']));
$sql="SELECT * FROM hospitalised as hos inner join patient as pat on hos.PatientID=pat.PatientID WHERE (hos.CheckInDate BETWEEN '$fromDate' AND '$toDate') AND (hos.CheckOutDate BETWEEN '$fromDate' AND '$toDate' OR hos.CheckOutDate='0') ORDER BY hos.CheckInDate";
$result=mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
  echo"<br>";
  echo "<input type='text' class='form-control searchCol col-10' id='userPass' placeholder='Search'>";
  echo "<br>";
  echo("<table class='table table-striped table-dark'>
  <thead>
    <tr>
    <th scope='col' class='text-center'>Hospitalised ID</th>
      <th scope='col' class='text-center'>Patient ID</th>
      <th scope='col' class='text-center'>Image</th>
      <th scope='col' class='text-center'>Name</th>
      <th scope='col' class='text-center'>IC</th>
      <th scope='col' class='text-center'>Check In Date</th>
      <th scope='col' class='text-center'>Days</th>
      <th scope='col' class='text-center'>View</th>
    </tr>
  </thead>");
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td class='HosID text-center'>" . $row['HosID'] . "</td>";
    echo "<td class='PatID text-center'>" . $row['PatientID'] . "</td>";
    echo "<td class='text-center'><img src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='80' width='100'/></td>";
    echo "<td class='text-center name'>" . $row['Name'] . "</td>";
    echo "<td class='text-center'>" . $row['IC'] . "</td>";
    echo "<td class='text-center'>" . $row['CheckInDate'] . "</td>";
    //if havent check out
  if($row['CheckOutDate']=='0000-00-00'){
    $today=date("Y/m/d");
    $today=strtotime($today);
    $date=strtotime($row['CheckInDate']);
    $day=$today-$date;}
    //else already checkout
  else{
    $date1 = strtotime($row['CheckInDate']);
    $date2 = strtotime($row['CheckOutDate']);
    $day= $date2-$date1;
  }
  $day=round($day/(60*60*24))+1;
  echo "<td class='text-center'>" . $day . "</td>";
    echo "<td class='text-center'><button class='btn btn-success view'>View</button></td>";
    echo "</tr>";
  };
  echo("</table>");
  
}
else{
echo("<br><h1  class='text-center'>No record found</h1>");
}
exit();
?>