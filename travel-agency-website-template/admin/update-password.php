<?php
include "../partial/menu.php";

if(isset( $_GET['id'])){
    $id = $_GET['id'];
    $sql = "select * from admin where id ='$id'";
    $res = mysqli_query($conn , $sql );
    if($res->num_rows>0){
        $row = $res->fetch_assoc();
        $old_pass= $row['password'];

    }
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_SESSION['admin'])){
            echo ($_SESSION['admin']);
            unset($_SESSION['admin']);
        }
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>


<?php
include "../partial/footer.php";

if(isset($_POST['submit'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
        if ($new_password == $confirm_password) {
            $new_password_md = md5($new_password);
            $sql = "update admin set password ='$new_password_md' where id ='$id'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $_SESSION['admin'] = "<span style='color: #006DC6'> password is changed </span>";
                header("location:" . SITURL . "/admin/manage-admin.php");
            } else {
                $_SESSION['admin'] = "<span style='color: #ff4757'> password can not be changed </span>";
                header("location:" . SITURL . "/admin/manage-admin.php");
            }
        } else {
            $_SESSION['admin'] = "<span style='color: #006dc6'> password are not matched </span>";
            header("location:" . SITURL . "/admin/update-password.php?id=$id ");
        }
    }

?>