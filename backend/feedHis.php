<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";
    $db="management";
    $conn = mysqli_connect($server,$user,$password,$db);
    $id=$_SESSION['id'];
$sql="SELECT * FROM support_ticket WHERE ID='$id' ORDER BY DATE DESC";
$result=mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
  echo("<table class='table table-striped table-dark mt-5'>
  <thead>
    <tr>
    <th scope='col' class='text-center'>No.</th>
      <th scope='col' class='text-center'>Description</th>
      <th scope='col' class='text-center'>Date</th>
      <th scope='col' class='text-center'>View</th>

    </tr>
  </thead>");
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td class='text-center feedbackNo'>" . $row['FeedbackID'] . "</td>";
    echo "<td class='col-sm-6 feedback' style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>" . $row['description'] . "</td>";
    echo "<td class='text-center'>" . $row['date'] . "</td>";
    echo "<td class='text-center'><button class='btn btn-success view'>View</button></td>";
    echo "</tr>";
  };
  echo("</table>");
  
}
else{
echo("<br><h1  class='text-center'>No ticket history</h1>");
}
?>
