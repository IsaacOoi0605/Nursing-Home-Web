<?php
session_start();
if(isset($_POST['idPHP'])){
    $_SESSION['checkPatientID']=$_POST['idPHP'];
}
if(isset($_POST['bedSeries'])){
    $_SESSION['checkBedSeries']=$_POST['bedSeries'];
}
if(isset($_POST['bedID'])){
    $_SESSION['checkBedID']=$_POST['bedID'];
}
if(isset($_POST['gotDis'])){
    if($_POST['gotDis']==0){
        $_SESSION['checkDisease']=array();
    }
    else{
        $_SESSION['checkDisease']=$_POST['diseaseList'];
    
    }
    }
if(isset($_POST['gotMed'])){
if($_POST['gotMed']==0){
    $_SESSION['checkMedicine']=array();
}
else{
    $_SESSION['checkMedicine']=$_POST['medicine'];

}
}
exit();
?>