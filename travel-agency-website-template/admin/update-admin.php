<?php
include "../partial/menu.php";

$id = $_GET['id'];
$sql = "select * from admin where id ='$id'";
$res = mysqli_query($conn , $sql);
if($res){
    if($res->num_rows>0){
        $row = $res->fetch_assoc();
        $full_name = $row['full_name'];
        $user_name = $row['user_name'];
    }
    else{
        $_SESSION['admin']= "<span style='color: #ff4757'> admin is not found </span>";
        header("location:" . SITURL."/admin/manage-admin.php");
    }
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name?>">

                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $user_name?>"
">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>


<?php
include "../partial/footer.php";

if(isset($_POST['submit'])) {
    $fullname = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "update admin SET 
full_name = '$fullname',
user_name = '$username' where id='$id'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['admin'] = " <span style='color: #2ed573'> admin is Updated </span>";
        header("location:" . SITURL . "/admin/manage-admin.php");
    } else {

        $_SESSION['admin'] = "<span style='color: #ff4757'> admin is not Updated </span>";
        header("location:" . SITURL . "/admin/manage-admin.php");
    }
}?>