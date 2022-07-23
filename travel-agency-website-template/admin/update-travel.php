<?php
include "../partial/menu.php";

$id=$_GET['id'];
$sql= "select * from travels where id=$id";

$res=mysqli_query($conn,$sql);
if($res->num_rows>0){
    $row=$res->fetch_assoc();
    $id=$row['id'];
    $title = $row['tital'];
    $description=$row['descreption'];
    $price = $row['price'];
    $image_old=$row['image'];
    $featured = $row['featured'];
    $active = $row['active'];
}else{
    $_SESSION['travel']= "<span style='color: #ff4757'> travel is not found </span>";
    header("location:" . SITURL."/admin/manage-travel.php");
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update travel</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>
">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" value="<?php echo $description;?>"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price"  value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
<img src="<?php echo $image_old;?>">
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes")echo "checked";?>

                                type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No")echo "checked";?>

                                type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input
                            <?php if($active=="Yes")echo "checked";?>
                                type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No")echo "checked";?>

                                type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="current_image" value="">

                        <input type="submit" name="submit" value="Update travel" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php
include "../partial/footer.php";

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $id_category = $_POST['category'];
    $description = $_POST['description'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $tmp = explode('.', $image_name);
        $dst = "../assets/images/" . time() . "_" . $title . "." . end($tmp);
        $uploded = move_uploaded_file($temp_name, $dst);
        $image_name = $dst;
    } else {
        $image_name = $image_old;
    }

    $sql="update travels set 
            tital = '$title',
            price = '$price',
            image = '$image_name',
            descreption = '$description',
            featured = '$featured',
            active = '$active'where id='$id' ";

    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['travel']= " <span style='color: #2ed573'>travel is updated </span>";
        header("location:manage-travel.php");
    }
    else{
        $_SESSION['travel']= "<span style='color: #ff4757'> travel is not updated </span>";
        header("location:manage-travel.php");
    }

}

    ?>