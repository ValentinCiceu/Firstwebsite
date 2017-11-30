<?php
//this will be the code to update and unreserve the book you choose
//the user will not be able to see this page unless something goes wrong
include 'config.php';//connect to the database
session_start();
$user_check=$_SESSION['login_ID'];//gets the userID number
$myIsbn=(int)$_GET['book_id']; //gets the chosen book id number
$sql="UPDATE Book SET reserved = 'N',userID = 1 where isbn = $myIsbn";
if($db->query($sql)===TRUE){
  header("location:unreserve.php");
}else{
  echo "error on updating" . $db->error;
}


/*note the userID of 1 is my controller. this is not a user but the database itself.
so any unereseve books will go to this ID.*/
 ?>
