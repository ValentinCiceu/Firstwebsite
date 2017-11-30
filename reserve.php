<?php
//this will be for the reservation of books
include 'config.php'; //to connect to the database
session_start();

//to get the date and time for the time stamp
date_default_timezone_set('Europe/Dublin');//setting the timezone to Irish time
$date = date ("Y/m/d"); //this is the format in the table

$user_check = $_SESSION['login_ID'];//checks the user id to link where the books goes to
$myIsbn = (int)$_GET['book_id'];//gets the books ISBN number
//var_dump($myIsbn);
//i need the user ID to send the book to

//simple query to update the book column to set reserved to Y and change the
//userID from controlle to user
$sql = "UPDATE Book SET reserved = 'Y',userID = $user_check where isbn = $myIsbn";
//the top is for the book update

//this is for debugging to check the right user
echo"logged in user is:  $user_check book id selected is:". $myIsbn."";

//to update the reservation table to time stamp the reservation
$timeStamp="INSERT INTO Reservation(resid , isbn , userID , resDate)
VALUES (NULL ,'$myIsbn',' $user_check','$date')";
   //the null in place of the resId will increment the id number
   //do the update and the timestamp statment
if($db->query($sql)===TRUE && $db->query($timeStamp)===TRUE){
  //echo"record updated!!";
  header("location:mainPage.php");//send the user back to the main page
}
else{
  echo "error on updating" . $db->error;//if something happens send an error
}
 ?>
