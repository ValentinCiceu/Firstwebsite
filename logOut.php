<?php
//this page is responsible for logging out the user and to destroy the session
//this will link with the session file in that it wont allow the user back in unless the sign in again
session_start();

if(session_destroy()){
  header("location:login.php"); //send user back to login page after they logge out
}

 ?>
