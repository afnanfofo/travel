<?php
include "../config/constans.php"; ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
<div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <br><br>
			<form class="text-center" name="login-form" action="index.php" method="POST" onsubmit="return validateLoginForm()">
					
						
						<?php

							//Check if user click on the submit button

								if(isset($_POST['admin_login']))
								{
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
										$hashedPass = sha1($password);

										//Check if User Exist In database

										$stmt = $con->prepare("Select id, username, password from users where username = ? and password = ? FROM admin");
										$stmt->execute(array($username,$hashedPass));
										$row = $stmt->fetch();
										$count = $stmt->rowCount();

										// Check if count > 0 which mean that the database contain a record about this username

										if($count > 0)
										{

											$_SESSION['username'] = $username;
												$_SESSION['password'] = $password;
												$_SESSION['userid'] = $row['id'];
                                                header("location:index.php");
												die();
										}
										else
										{
											?>
										<div class="alert alert-danger">
							<button data-dismiss="alert" class="close close-sm" type="button">
											<span aria-hidden="true">×</span>
									</button>
							<div class="messages">
								<div>Username and/or password are incorrect!</div>
							</div>
						</div>
										<?php 
									}
					}
				?>

				<!-- USERNAME INPUT -->

					<div class="form-input">
							<span class="txt1">Username</span>
								<input type="text" name="username" class = "form-control username" oninput="document.getElementById('username_required').style.display = 'none'" id="user" autocomplete="off">
					</div>
                    <br>

					<!-- PASSWORD INPUT -->
			
					<div class="form-input">
							<span class="txt1">Password</span>
							<input type="password" name="password" class="form-control" oninput="document.getElementById('password_required').style.display = 'none'" id="password" autocomplete="new-password">
					</div>
                    <br><br>

					<!-- SIGNIN BUTTON -->
			
					<p>
							<button type="submit" name="admin_login" class="btn-primary" >Sign In</button>
					</p>
                    <br><br>

					<!-- FORGOT PASSWORD PART -->

					<span class="forgotPW">Forgot your password ? <a href="../index.php">Reset it here.</a></span>

				</form>
</div>  
        <?php
        include "../partial/footer.php";
        ?>
