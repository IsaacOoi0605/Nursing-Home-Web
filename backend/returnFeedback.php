<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";
    $db="management";
    $conn = mysqli_connect($server,$user,$password,$db);
$sql="SELECT * FROM support_ticket ORDER BY DATE DESC";
$result=mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
  echo("<table class='table table-striped table-dark mt-5'>
  <thead>
    <tr>
    <th scope='col' class='text-center'>No.</th>
    <th scope='col' class='text-center'>User ID</th>
      <th scope='col' class='text-center'>Description</th>
      <th scope='col' class='text-center'>Date</th>
      <th scope='col' class='text-center'>View</th>
      <th scope='col' class='text-center'></th>

    </tr>
  </thead>");
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td class='text-center feedbackNo'>" . $row['FeedbackID'] . "</td>";
    if($row['ID']){    
        echo "<td class='HosID text-center'>" . $row['ID'] . "</td>";
    }
    else{
        echo "<td class='HosID text-center'>Guest</td>";
    }
    echo "<td class='col-sm-6 feedback' style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>" . $row['description'] . "</td>";
    echo "<td class='text-center'>" . $row['date'] . "</td>";
    echo "<td class='text-center'><button class='btn btn-success view'>View</button></td>";
    echo "<td class='text-center'><button class='btn btn-danger remove'>Remove</button></td>";
    echo "</tr>";
  };
  echo("</table>");
  
}
else{
echo("<br><h1  class='text-center'>No review found</h1>");
}
?>
