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
        <form id='form' class='mb-2'>
        <br><div class='form-group'>
        <label class='form-group image'>Patient Image:</label></div>
        <input id='Image' name='img'class='form-control img' type='file' accept='image/png, image/gif, image/jpeg' onchange='showImage(this);'/>
        <img id='blah' src='#' alt='image' />
        <br><br><div class='form-group'>
        <label for='ID'>Patient ID:</label>
        <input type='text' class='form-control' id='ID' value=".$row['PatientID']." readonly>
      </div>
      <div class='form-group'>
        <label for='Name'>Patient Name:</label>
        <input type='text' class='form-control' id='name' value='".$row['Name']."'>
        <p class='errorMsg text-danger'></p>
      </div>
      <br>
<div class='form-group'>
        <label for='IC'>Patient IC Number:</label>
        <input type='text' class='form-control' id='IC' value='".$row['IC']."'>
        <p class='errorMsg text-danger'></p>
      </div>
      <br>
      <div class='form-group'>
      <label for='Phone'>Contact Number:</label>
      <input type='text' class='form-control' id='Phone' value='".$row['Contact']."'>
      <p class='errorMsg text-danger'></p>
    </div><br>   
    <div class='form-group'>
    <label for='Address'>Address:</label>
    <input type='text' class='form-control' id='Address' value='".$row['Address']."'>
    <p class='errorMsg text-danger'></p>
  </div><br>   
  <div class='form-group'>
    <label for='postcode'>Postcode:</label>
    <input type='text' class='form-control' id='postcode' value='".$row['PostCode']."'>
    <p class='errorMsg text-danger'></p>
  </div><br>   
  <div class='form-group'>
      <label for='State'>State</label>
      <input type='text' class='form-control' id='State' value='".$row['State']."'>
      <p class='errorMsg text-danger'></p>
    </div>
    </form>");}
        exit();

    
?>