<?php
//this will ber create new account
include 'layout.php'; //this is the header of the page
include 'config.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
//all the new values to br inserted to the database\\
$nUser= $_POST['cusername'];
$nPassword= $_POST['cpassword'];
$cnPassword= $_POST['confirmpassword'];
$nFirst= $_POST['cfirstName'];
$nSur= $_POST['csurname'];
$nEmail= $_POST['cemail'];
$nAddress1= $_POST['caddress1'];
$nAddress2= $_POST['caddress2'];
$nCity= $_POST['cCity'];
$nTele= $_POST['cphone'];
$nMobile= $_POST['cmobile'];
//////////////////////\\\\\\/////////////////////
/////these variables are for error checking\\\\\
$eUserName;
$ePassword;
$eFirst;
$eSur;
$eMail;
$eAddress;
$eCity;
$exUser;//userName exsits
$shortPass; //password too short
//the success varaible after account has been created\\
$sucess;
/////////////////////////////////////////////////
$passLength = strlen("$nPassword"); //checks the length of the password

//inserting the new user details into the database.
$queryIns ="INSERT INTO User(userID , userName , password , firstName , surname
   , addressLine1 , addressLine2 , telephone , mobile , email , city)
   VALUES (NULL , '$nUser','$nPassword','$nFirst','$nSur','$nAddress1','$nAddress2'
   ,'$nTele' , '$nMobile' , '$nEmail' , '$nCity')";
   //the null in place of the userID will increment the id number

//do a isset to check if the all boxes are checked
//check for all non null boxes
//also confirms the password and makes sure it's greater than 5
//make sure the username is unique, i.e. no two of the sane usernames,
//way to do is to get a list of all names in the database that currenly exist and compare to the name you inputted,
//if match then dont go through if not you an go through to the next stage


//this is to make sure user dosent insert the same username as the one in the database
$checkAllName = "SELECT * From User";
$counter=0;//this will be the true or false value
$result = $db->query($checkAllName);
if(!empty($nUser)){//if the user name box is not empty then ...
  //echo "<h1><br><br>Im not empty</h1>";
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {//go through all the names
    //echo "<br><br><h3>". $row["userName"] ."</h3><br><br>";
    //to check if the userName exsits i increase the counter
    if($row["userName"] == $nUser ){
      $counter++; //if user name is the same as the username in the database the increment the value to one
    }
  }
}
//echo "<br><br><h1>Counter: $counter</h1>";


//this will be the if statments error checking. prompting users if they have not inserted something
//following variables are all strings that will be used in the html.
//all the rror messages to display
if(empty($nUser)){
  $eUserName = "Pleases insert a UserName!";
}
if(empty($nPassword)){
  $ePassword = "Please insert a valid Password of length greater than 6";
}
if(empty($nFirst)){
  $eFirst = "Please insert your First name!";
}
if (empty($nSur)) {
$eSur = "Please enter your Surname!";
}

if(empty($nEmail)){
  $eMail = "Please enter your Email Address!";
}
if(empty($nAddress1)){
  $eAddress = "Please enter your Address!";
}
if(empty($nCity)){
  $eCity = "Please enter your City!";
}
if($counter ==1){
  $exUser = "UserName taken!";
}
if( $passLength > 0 &&$passLength < 6 ){
  $shortPass = "Pasword is too short!";
}

//this is the main update section. if everything is ok then update the user to the database
if(!empty($nUser)&&$counter ==0  && !empty($nPassword)&& $nPassword == $cnPassword && $passLength > 5  && !empty($nFirst) && !empty($nSur) && !empty($nEmail)
&& !empty($nAddress1) && !empty($nCity) ){
  //echo "<br><br><h1>Success!</h1>";
   if($db->query($queryIns)===TRUE){
     //echo "account created successfully";
   }
else{ // safe error to check if something went wrong with the insert
//statment.
echo "Error: " . $db . "<br>" . $db->error;
}//end of else

 }//end of !empty

}//end of main if statment

//password must be of length greater than 6


?>
  <!--Moving the sign around -->
    <div class "dec">
    <div class="content">
      <img src="reading.jpg" width="50%" height="40%" alt="">
      <div class="text">
        <p class="flow-text">Sign up to indulge in a relaxing time with your favourite book.</p>
         <p class="flow-text">It's simple and free!</p>
       </div>
    </div>
  </div>

  <!--showcasing some of the books (for design) -->
  <div class="showCase">
  <p class="flow-text">  Some books in our aresenal:</p>
  <ul>
    <li>The Hobbit</li>
    <li>Naruto</li>
    <li>Life of Pi</li>
    <li>WWII in Numbers</li>
    <li>Fifty Shades of Grey</li>
    <li>Exploring Peru</li>
    <li>Computer Science All in One</li>
    <li>DaVinvi Code</li>
    <li>The Teacher</li>
    <li>The Girl Who fell from the Sky</li>
    <li>The Passanger</li>
    <li>Once</li>
    <li>Game of Thrones</li>
    <li>War and Peace</li>
    <li>The Odyssey</li>
    <li>Hamlet</li>
    <li>and more!</li>
  </ul>
  </div>

  <!-- Why join  -> explanation as to why to join-->

  <div class="explain">
<p class="flow-text">So why join?</p>
<p>VBooks allows users to reserve any book we have on our list. <br></br>
   Free of charge and no strings attached. Reserve for as long as your heart desires.
<br></br>Sign up is quick and simple.</p>
  </div>


<!--these are all the insert boxes for signing up -->
  <div class="spliiter">
  <div class="setUpMain">
    <form action="setUp.php" method="post">
      <label>UserName: </label><input type = "text" name = "cusername" class = "sbox"/><br /><br />
      <label>First name: </label><input type = "text" name = "cfirstName" class = "sbox"/><br /><br />

      <div class="surname">
      <label>Surname: </label><input type = "text" name = "csurname" class = "sbox"/><br /><br />
      </div>
      <label>New password: </label><input type = "password" name = "cpassword" class = "sbox"/><br /><br />
      <label>Confirm password: </label><input type = "password" name = "confirmpassword" class = "sbox"/><br /><br />
      <label>Email: </label><input type = "text" name = "cemail" class = "sbox"/><br /><br />
      <label>Address line1: </label><input type = "text" name = "caddress1" class = "sbox"/><br /><br />
      <div class="address2">
        <label>Address line2: </label><input type = "text" name = "caddress2" class = "sbox"/><br /><br />
          <div class="myErrorCheck">
            <!--this is for the error message. Indicates wheter something is unfilled, password too short,
          userName exsits also to indicate if account has been created
          how it's done, create string variables for each input box to check is empty when submitted
          string Variale specifically if the userNAme exsits,
          String Variable if the Password exsits-->
            <!--reason for plcing the error messages here is to align the errors under the AddressLine 2 box
          using its div-->
          <ul class="listError" style="list-style: none;" >
            <?php
            //if something is missing echo the following messages in a list
            echo "<li>". $eUserName ."</li>";
            echo "<li>". $ePassword ."</li>";
            echo "<li>". $eFirst ."</li>";
            echo "<li>". $eSur ."</li>";
            echo "<li>". $eMail ."</li>";
            echo "<li>". $eAddress ."</li>";
            echo "<li>". $eCity ."</li>";
            echo "<li>". $exUser ."</li>";
            echo "<li>". $shortPass ."</li>";

             ?>
          </ul>
        </div>
      </div>
      <label>City :</label><input type = "text" name = "cCity" class = "sbox"/><br /><br />
      <label>Telephone number: </label><input type = "text" name = "cphone" class = "sbox"/><br /><br />
      <label>Mobile number: </label><input type = "text" name = "cmobile" class = "sbox"/><br /><br />
      <div  > <!--the submit button -->
          <input class="SubmitBtn" type = "submit" value = " Create Account "/><br />
      </div>

    </form>
  </div>
  </div>



</div>

<?php include 'footer.php'; ?> <!--the footer of the page-->
