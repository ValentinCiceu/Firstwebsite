<?php
//this will connect to database
ini_set('display_errors', 0); //turning off the error message //1 for error on
//0 for error off
//this error disabler is used on all pages. why? some of the variables i deliberaterly
//left blank to fill up at later stage (e.g. the error checker in setup page)
//error will genereate stating tha the variable is unassigned(delibertely) which looks ugly 
//creating variables to connect to my database
$serverName = "localhost";
$username = "root";
$password = "";
//$dbname = "assignmenttest2"; //test database
$dbname = "assignment";//real database
//creating the connection
$db = new mysqli($serverName , $username , $password , $dbname);
//if the connection fails
if($db->connect_error){
  die("connection failed: " . $db->connect_error);
}
 ?>
