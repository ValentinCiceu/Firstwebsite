
<?php
//this will be te looging in section of webpage
//this will contain the header , footer and sign-in sheet in the middle
include 'layout.php';//this is the layout(header) for the website
include 'config.php';//to connect to the database

//ini_set('display_errors', 0); //anti-error displayer

session_start();
$error;//="Your UserName or Password is invalid!"; //= "this is an error message"; //will print out a message
//if you logged in incorrectly

//this checks if you submitted something
if($_SERVER["REQUEST_METHOD"]=="POST"){
$cUserName = $_POST['cusername']; //saves the user name inserted (even if it's null) after the submission
$cPassword = $_POST['cpassword']; //saves password

//query runs this new username and assword to check if it's in the database already
$query = "SELECT * FROM User WHERE userName = '$cUserName' AND password = '$cPassword'";
$result = mysqli_query($db , $query); //run query
$row = mysqli_fetch_array($result , MYSQLI_ASSOC); //fetch the arrays of names
$count = mysqli_num_rows($result); //gets the number of rows from the query

//also get the id of the logged in user to store in the session
$idQuery = "SELECT userID FROM User WHERE userName = '$cUserName' ";
$idResult  = mysqli_query($db , $idQuery); //run the query
$rowID = mysqli_fetch_array($idResult , MYSQLI_ASSOC); //fetch the result matching the query

$user_ID = $rowID["userID"] +0; //stores the retreived userID to the variable and converts to integer
//var_dump($user_ID); //used for debugging
if($count >0){ //remember count represents the number of rows. if greater than 0 then that means a reuslt has been found
   $_SESSION['login_user'] = $cUserName;//stores the username inserted into the session
   $_SESSION['login_ID'] = $user_ID; //storing these values for the session
// to check if the user is authorised to continue
header("location:mainPage.php");//sends usr to the main page where they can reserve books
//echo "<h1> $user_ID</h1>";
}

//two error checks
else{//if nothing happens then print this message
  $error = "Your UserName or Password is invalid!";
}

if($count <1){//if count is less than 0 (meaning no result mathich query) then print statment
  //header("location:login.php");
  $error = "Your UserName or Password is invalid!";
}

}//end of primary if statment

 ?>
<!--again all the divs here are to allign the login box -->
  <div align = "center">
          <div class="pos" align = "left">
           <div class"heading"><b>Login</b></div>
           <div class="myForm">
             <form action = "login.php" method = "post">
                <label>UserName  :</label><input type = "text" name = "cusername" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "cpassword" class = "box" /><br/><br />
                <div class="testing" >
                <input type = "submit" value = " Next "/><br />
                </div>
             </form>
             <div class="back"> <!--this back class draws the grey filler border whithin the login box.(used for decoration) -->
              <div class="error"><!--this border is used to position the error message -->
             <?php echo "$error"; //this is where the error message gets printed?>
              <div class= "accPos">
             <div class="createAcc">
               <a href="setUp.php">Create new account</a> <!--link to set up a new user account-->
             </div>
             </div>
            </div>
           </div>
          </div>
         </div>
       </div>
     </div>

     <!--what is v-books? -->
<div class="description">
<h2>What is VBooks?</h2>
<div class="bodDesc">
  <p>VBooks is an online book reservation site
  allowing a user to reserve as many books as they want for free and for an
unlimeted time. Simply login to your account, check if a book you desire is available to be reserved
and click the reserve button. VBooks has a range of genres rangin from documntaries to thrillers,
with an endless catalogue that continues to grow, you will be bound to find something you enjoy!
</p>
</div>
</div>

<?php include 'footer.php'?> <!--include the footer of the page -->
