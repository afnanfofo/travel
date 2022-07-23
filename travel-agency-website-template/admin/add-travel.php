<?php
include "../partial/menu.php";
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Travel</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the travel">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the travel."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add travel" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        


    </div>
</div>
<?php

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $id_category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['image']['name']) &&$_FILES['image']['name']!="") {
        $image_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $tmp=explode('.', $image_name);
        $dst = "../assets/images/" . $title . "." . end($tmp);
        // $uploded = move_uploaded_file($temp_name, $dst);
        $uploded=move_uploaded_file($temp_name,"../".$dst);
        $image_name=$dst;
    }else{
        $image_name="../assets/images/product-5-370x270.jpg";
    }
    $sql="insert into travels set 
            tital = '$title',
            price = '$price',
            image = '$image_name',
            descreption = '$description',
            featured = '$featured',
            active = '$active'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['travel']= " <span style='color: #2ed573'> travel is added </span>";
        header("location:manage-travel.php");
    }
    else{

        $_SESSION['travel']= "<span style='color: #ff4757'> travel is not added </span>";
        header("location:manage-travel.php");
    }



}
include "../partial/footer.php";
?>