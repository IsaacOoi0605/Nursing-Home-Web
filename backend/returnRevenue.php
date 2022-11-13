<?php
$server="localhost";
$user="root";
$password="";
$db="management";
$conn = mysqli_connect($server,$user,$password,$db);
$fromDate=date('Y-m-d',strtotime($_POST['fromDate']));
$toDate=date('Y-m-d',strtotime($_POST['toDate']));
$sql="SELECT * FROM revenue WHERE Date BETWEEN '$fromDate' AND '$toDate' ORDER BY Date";
$result=mysqli_query($conn, $sql);
$resultCheck=mysqli_num_rows($result);
if($resultCheck){
    $sql="SELECT SUM(Revenue) AS Total FROM revenue WHERE Date BETWEEN '$fromDate' AND '$toDate' ORDER BY Date";
    $sum=mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($sum);
    if(isset($_POST['form'])){
      $total=array();
      while($row = mysqli_fetch_array($result)) {
        $date=$row['Date'];
        $rev=$row['Revenue'];
        $day=array();
        array_push($day,$date,$rev);
        array_push($total,$day);
      }
      echo json_encode($total);
    }
    else{
      echo "<h3 class='text-center'>Total Revenue:RM".$row['Total']."</h3>";
    echo "<div class='text-center mt-2 mb-2'><div class='d-sm-inline-flex btn btn-primary me-2 showTable'>Display in Table</div><div class='d-sm-inline-flex btn btn-primary ms-2 showGraph'>Display in Graph</div></div>";
  echo "<div></div>";
    echo("<table class='table table-striped table-dark'>
  <thead>
    <tr>
    <th scope='col' class='text-center'>Date</th>
      <th scope='col' class='text-center'>Revenue</th>

      <th scope='col' class='text-center'>View</th>
    </tr>
  </thead>");
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td class='text-center'>" . $row['Date'] . "</td>";
    echo "<td class='text-center'>" . $row['Revenue'] . "</td>";
    echo "<td class='text-center'><button class='btn btn-success view'>View</button></td>";
    echo "</tr>";
  };
  echo("</table>");
}  
}
else{
echo("<br><h1  class='text-center'>No record found</h1>");
}
exit();
?>