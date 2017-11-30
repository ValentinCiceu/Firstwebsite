<?php
//this will store current user details
//and check of there is a user currently logged in and allowed to proceed
include 'config.php';//to connect to the database
session_start();
$user_check = $_SESSION['login_user']; //takes in the users's name
$user_ID=$_SESSION['login_ID'];//takes the currently signed in user's id

//to check if there is a user signed in and what user is it , if not send back to login page
$loggedUser = "SELECT userName FROM User WHERE userName = '$user_check'";
$ses_sql = mysqli_query($db,$loggedUser);//run the query
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['userName'];//takes the username
//echo "$login_session";
if(!isset($_SESSION['login_user'])){
header("location:login.php"); //send the user back to the login page
}
 ?>
