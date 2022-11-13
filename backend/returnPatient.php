<?php
        session_start();
        $idPatient=$_POST['idPHP'];
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT * FROM patient WHERE PatientID ='$idPatient'";
        $result= mysqli_query($conn, $sql);
        if($result){
        $row = mysqli_fetch_array($result);
        echo("
        <br><div class='form-group'>
        <label class='form-group image'>Patient Image:</label></div>
        <img class='img-fluid img' src='data:image/jpeg;base64," .base64_encode($row['img_path']). "'height='300' width='150' onError='this.remove();'>
        <br>
        <br><div class='form-group'>
        <label for='ID'>Patient ID:</label>
        <input type='text' class='form-control' id='ID' value=".$row['PatientID']." readonly>
      </div>
      <div class='form-group'>
        <label for='Name'>Patient Name:</label>
        <p>".$row['Name']."</p>
      </div>
      <div class='form-group'>
        <label for='IC'>Patient IC Number:</label>
        <p>".$row['IC']."</p>
      </div>
      <div class='form-group'>
      <label for='Phone'>Contact Number:</label>
      <p>".$row['Contact']."</p>
    </div>   
    <div class='form-group'>
    <label for='Address'>Address:</label>
    <p>".$row['Address']."</p>
  </div>
  <div class='form-group'>
  <label for='psotcode'>Postcode:</label>
  <p>".$row['PostCode']."</p>
</div>      
  <div class='form-group'>
      <label for='State'>State</label>
      <p>".$row['State']."</p>
    </div>   
    <br>
    <br><div class='row'>
    <div class='col-4'></div>
    <div class='d-flex justify-content-center col-4'>");
    if(!$row['Hospitalised']){
    echo "<button type='button' class='btn btn-success mx-auto w-10 checkIn' >Check in</button>";
    echo "<button type='button' class='btn btn-danger mx-auto w-10 del' >Remove Patient</button>";}
    else{
    echo "<b>Patient is in hospitalised. No allowed remove patient</b>";}
    echo "</div><div class='col-4'></div>
    </div>";}
        exit();

    
?>