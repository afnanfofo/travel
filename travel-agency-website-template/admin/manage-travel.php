<?php
include "../partial/menu.php";
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage travel</h1>

        <br/><br/>

        <!-- Button to Add Admin -->
        <a href="add-travel.php" class="btn-primary">Add travel</a>

        <br/><br/><br/>
        <?php
        if(isset($_SESSION['travel'])){
            echo ($_SESSION['travel']);
            unset($_SESSION['travel']);
        }
        ?>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

<?php
$sql= "select * from travels";
$res = mysqli_query($conn,$sql);
if($res->num_rows>0){
    while ($row=$res->fetch_assoc()) {
        $id= $row['id'];
        $title = $row['tital'];
        $price = $row['price'];
        $image=$row['image'];
        $description=$row['descreption'];
        $featured = $row['featured'];
        $active = $row['active'];

        ?>

            <tr>

                <td><?php echo $id?></td>
                <td><?php echo $title?></td>
                <td><?php echo $price?></td>
                <td><img src=<?php echo "../assets/".$image?> " width="50px"></td>
                <td class="des"><?php echo $description?></td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>

                <td>
                    <a href="update-travel.php?id=<?php echo $id?>" class="btn-secondary">Update travel</a>
                    <a href="delete-travel.php?id=<?php echo $id?>" class="btn-danger">Delete travel</a>
                </td>
            </tr>
                <?php

            }
        }else{
            ?>
            <tr>
                <td colspan="6">
                    <div class="error"> No Website Added.</div>
                </td>
            </tr>
            <?php
        }
        ?>


        </table>
    </div>

</div>

<?php
include "../partial/footer.php";
?>