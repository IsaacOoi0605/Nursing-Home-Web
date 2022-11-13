<?php
$fromDate=$_POST['fromDate'];
$toDate=$_POST['toDate'];
$data=exec("python C:/xampp/htdocs/FYP/python/loadBedModel.py $fromDate $toDate");
$arr=json_decode($data);
echo json_encode($arr);
?>