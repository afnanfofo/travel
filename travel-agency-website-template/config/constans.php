<?php
session_start();
define("SITURL",'http://localhost:63342/travel-agency-website-template/');
define("servername","localhost");
define("username","root");
define("password","");
define("dbname","travel");
$conn = mysqli_connect(servername,username,password,dbname);
?>