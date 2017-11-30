<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css" type="text/css">-->
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<?php
//this will be the unreserve function
//this will also contains display all currently owned books
//it has similar layout as the
//session_start();
include 'session.php'; // to verify if the user is logged in or not.

//search bar controller
//the isset checks if the search bar variable has been set
if(isset($_GET['search_input'])){
  $search=$_GET['search_input']; //gets the search you entered
/*so if you typed boruto, it will show up in the index bar
and so the Get saves this search to this variable*/
}else {
  $search=''; //if no search than leave it blank
}
//category controller
if(isset($_GET['categoryID']) && $_GET['categoryID'] !="" ){
  $cat_input="categoryID=".(int)$_GET['categoryID']; //this is used for the sql query
  $cat_link = $_GET['categoryID'];//gets the id you looked for
}else {
  $cat_input="1=1";/*this trick is used if you dont look through the dropDownBar
  it will return true in the sql query if you look for nothing*/
  $cat_link="";
}

//pagination conroller
if(isset($_GET['page'])){
  $page = (int)$_GET['page'];//this is the page number you see on the index bar
}

else {
  $page = 1;
  //if no input has been made then set it to be automatically page 1
}

//getting the number of books you have currently reserved
//say page is 1, then 1-1 is 0. 0 *5 is 0 therefore start at book 0 and go to 4 (5 books displayed)
//page is 2, then 2-1 is 1, 1*5 is 5 ....etc
$offset = ($page-1)*5;


$no_of_books = "SELECT count(*) as count FROM  Book WHERE ((bookTitle LIKE '%$search%' )
OR (author LIKE '%$search%')) AND ($cat_input) AND UserID = $user_ID";
//selecting all books based on the search bar or through the category dropdown and
//also check if the book belongs to the user
$myQuery = $db->query($no_of_books);
$count = (int)mysqli_fetch_array($myQuery)['count'];
$no_of_pages=ceil($count/5);//limiting to 3 books per page
//so the top is to show the paginations number and to alter them based on
//what you searched either through the search bar or through the dropdown bar.

$books = "SELECT * FROM Book WHERE ((bookTitle LIKE '%$search%') OR (author LIKE '%$search%'))
AND ($cat_input) AND UserID = $user_ID LIMIT  5 OFFSET $offset"; //this is used to actually display the books AND
//again limiting to 5 books a page
$result = $db->query($books);

//to print out all category tables
$cat = "SELECT * FROM Categories";
$catRes = $db->query($cat);
 ?>

<!-- for the search bar and the dropDownBar -->
<form action="unreserve.php" method="get">
<div class="posSearch">
  <div class="searchBar">
    <input class="browser-default" type="text" name="search_input" value="" size="50" placeholder="Book name or Author name" >
  </div>

  <div class="dropDownBar">
    <select class="browser-default" name="categoryID">
      <option disabled selected value="">All</option>
      <?php
      while ($row = $catRes->fetch_array(MYSQLI_ASSOC)){
        # code... dropping down all the category values
        echo "<option value'" . $row['categoryID'] . "'>" . $row['catDesc'] . "</option>" ;
        //displaying values per row
      }
       ?>
    </select>
  </div>
</div>
<div class="searchBox"><input type = "submit" class="btn" value="search"/>
</div>
</form>

<h1 class="catTitle"><?php echo "" . $user_check. "'s Books"; ?></h1>
<?php
//if you have no books in the inventory you should promt a mesaage stating this
$user_check=$_SESSION['login_ID'];//gets the userID number
$checkStorage = "SELECT * FROM Book WHERE userID = '$user_check'";
$checkResult = mysqli_query($db,$checkStorage);
$checkRows = mysqli_num_rows($checkResult);

if ($checkRows ==0) { //checks if you have no books reserved
  //might put up an image of a sad book/maybe draw one on photoshop
  echo "<p>You currently have no books in your inventory.</p>";
  echo "<p>but fear not! We have a huge collection of books waiting to be read! </p>";
}
  ?>

<?php
//this is the code to genereate the boxes to display the title, author etc.
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  # code...
  echo"<div class='row'>";
  echo"<div class='col s12 m5' z-index = '-1'>";
  echo "<div class='card blue-grey darken-1'>";
  echo "<div class='card-content white-text'>";
  echo"<span class='card-title'>" .$row["bookTitle"] . "</span>";
  echo"<p>".$row["bookDesc"]  . ""  . $row["author"] ."</p>";
  echo"</div>";
  echo"<div class='card-action'>";
  //if the book is not currently reserved
  echo "<a href='unreserveController.php?book_id=" .$row['isbn'] . "'>unReserve</a>";
  echo "</div>";
  echo"</div>";
  echo "</div>";
  echo "</div>";//end of the  echo statment
}
 ?>

 <?php
//to include the header.
/*reason for putting it through this way is so that when you scroll down the boxes
goes behind the navigation bar. there is a bug that if i just used z-index
then i cant click on the link anymore :( */
include 'mainPageLayout.php';
?>

<div class="paginationCotroller">

<ul class="pagination">
<?php
//this will be for the numbers to show up as the pagination
//so i can go to the next page or previous
//i want 1 to be the start on page so diplay page 1
for ($i=1; $i <$no_of_pages + 1 ; $i++) {
  # code...
  echo "<li class='myActive'> <a href='unreserve.php?search_input=" . $search."&categoryID=".$cat_link."&page=$i'>$i</a></li>";
}
 ?>

</ul>
</div>
<br></br><br></br><br></br>
<?php //to include the footer for the page
include 'footer.php'; ?>
