<?php
include "../config/constans.php";
$id = $_GET['id'];
echo $id;
$sql = "delete from travels where id = '$id'";
$res = mysqli_query($conn,$sql);
if($res){
    $_SESSION['travel']= " <span style='color: #2ed573'> travel is deleted </span>";
    header("location:" . SITURL."/admin/manage-travel.php");
}
else{

    $_SESSION['travel']= "<span style='color: #ff4757'> travel is not deleted </span>";
    header("location:" . SITURL."/admin/manage-travel.php");
}

?>