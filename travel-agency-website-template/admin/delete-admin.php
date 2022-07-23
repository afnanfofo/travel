<?php
include "../config/constans.php";

$id = $_GET['id'];
echo $id;
$sql = "delete from admin where id = '$id'";
$res = mysqli_query($conn,$sql);
if($res){
$_SESSION['admin']= " <span style='color: #2ed573'> admin is deleted </span>";
header("location:" . SITURL."/admin/manage-admin.php");
}
else{

$_SESSION['admin']= "<span style='color: #ff4757'> admin is not deleted </span>";
header("location:" . SITURL."/admin/manage-admin.php");
}
?>