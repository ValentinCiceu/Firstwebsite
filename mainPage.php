<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css" type="text/css"> --><!-- te frame work of materlized
interent is required!. if you dont have interent, download file and add it to the libraby(like you do with images) put in the assests folder
and link again-->
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<?php
//this will combine search bar and pagination together!
//this will be the welcome page after successfully signing in
//include 'config.php';
include 'session.php';

///search
if(isset($_GET['search_input'])){
  $search=$_GET['search_input']; //looking for the user input
}else {
$search=''; //leave search as an empty string
}


//category
if(isset($_GET['categoryID']) && $_GET['categoryID'] !=""){
$cat_input="categoryID =".(int)$_GET['categoryID'];//used for sql
$cat_link = $_GET['categoryID'];//used for the link at the for loop
}else{
$cat_input="1=1"; //this will return true, so if you have no category id just day true.
$cat_link = "";
//therefore printing out all values
}

///pagination
//pagination
if(isset($_GET['page'])){
  $page = (int)$_GET['page']; //page is the page number you see at the index bar

}
else{
  $page = 1;
}//if there is no page set, then automatically set to page 1

/*showing 3 books per page*/
$offset = ($page-1) * 5;

$no_of_books =  "SELECT count(*) as count FROM Book WHERE ((bookTitle Like '%$search%') OR (author LIKE '%$search%')) AND  ($cat_input)";
$myQuery = $db->query($no_of_books);
$count = (int)mysqli_fetch_array($myQuery)['count'];
//var_dump($count); // total of 6 books
$no_of_pages= ceil($count/5); //limiting to 3 books per page. ceil rounds up the number

////////////////////////////////////////////////


$books = "SELECT * FROM Book WHERE ((bookTitle Like '%$search%') OR (author LIKE '%$search%')) AND  ($cat_input) Limit 5 OFFSET $offset"; //limiting to 3 books to be displayed
$result = $db->query($books);
//$count = mysqli_num_rows($result);
//var_dump($result);
$cat = "SELECT * From Categories";
$catRes = $db->query($cat);
//var_dump($catRes);

 ?>

<form action="mainPage.php" method="get">
  <div class="posSearch">
<div class="searchBar" >
<input class="browser-default" type="text" name="search_input" value="" size="50" placeholder="Book name or Author name"> <!--the search bar -->
</div>



<div class="dropDownBar">
<select class="browser-default" name="categoryID">
  <option disabled selected value="">All</option> <!--the drop down menu -->
  <?php
  while($row = $catRes->fetch_array(MYSQLI_ASSOC)){
    echo " <option value='" . $row['categoryID'] . "'>" . $row['catDesc'] .  "</option>";
    //the value row thingy is for the index to be displayed
  }
   ?>
</select>
</div>
</div>
<div class="searchBox"><input type="submit" class="btn" value="Search"/>
</div>
</form>

<!-- <table> -->
<?php
/* //displays the table for each book
 while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  # code...
  echo "<tr>";
  echo "<td>" . $row["bookTitle"] ."</td>";
  echo "</tr>";
}

*/
 ?>
<!-- </table> -->
<?php
//small query for the reommended book reservation
$recommend="SELECT * FROM Book where isbn = 17";
//$recResult = $db->query($recommend);
$recResult = mysqli_query($db,$recommend);
$recRow = mysqli_fetch_array($recResult,MYSQLI_ASSOC);
 $recTitle = $recRow['bookTitle'];
 $rectDesc = $recRow['bookDesc'];
$recAutohor = $recRow['author'];
$recPub = $recRow['year'];
$recRes = $recRow['reserved'];

echo "<h1 class='catTitle'>Catalogue</h1>";
echo"<div class='recTitle'>";
echo"<h1 >Best Sellers</h1>";
echo"<div class='myRow'>";
        echo"<div class='col s12 m6'>";
          echo"<div class='card blue-grey darken-1'>";
            echo"<div class='card-content white-text'>";
              echo"<span class='card-title'>$recTitle</span>";
              echo"<p>$rectDesc  <br></br> By: $recAutohor <br></br> Published: $recPub <br></br> 4/5 GoodRead </p>";
            echo"</div>";
            echo"<div class='card-action'>";
            if($recRes=="Y"){ //if the book is already reserved
            echo "Sorry Im taken";
            }
            else{//if the book is not currently reserved
            echo "<a href='reserve.php?book_id="."17"."'>Reserve</a>";
            }
            echo"</div>";
          echo"</div>";
        echo"</div>";
      echo"</div>";
echo"</div>";

?>
<?php
//this is the card displayer
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
   # code...
//m is the size of the box
echo"<div class='row'>";
echo"<div class='col s12 m5' z-index = '-1'>";
echo "<div class='card blue-grey darken-1'>";
echo "<div class='card-content white-text'>";
echo"<span class='card-title'>" .$row["bookTitle"] . "</span>";
echo"<p>" .$row["bookDesc"] ."<br></br> Author: ". $row["author"] ."<br></br> Year published: " . $row["year"] ."</p>";
echo"</div>";
echo"<div class='card-action'>";
if($row["reserved"]=="Y"){ //if the book is already reserved
echo "Sorry Im taken";
}
else{//if the book is not currently reserved
echo "<a href='reserve.php?book_id=" .$row['isbn'] . "'>Reserve</a>";
}
echo "</div>";
echo"</div>";
echo "</div>";
echo "</div>";//end of the  echo statment

//displays cards corresponding to each name of the book
}


 ?>

<!--Best sellers -->


<?php
include 'mainPageLayout.php'; //this is the navigation bar at top
 ?>

<!--pagination thingy -->
<div class="paginationCotroller" >
<ul class="pagination">
<?php
for ($i=1; $i < $no_of_pages + 1; $i++) {
  # code...
  //this is the number of pages.
  echo "<li class='myActive'> <a href= 'mainPage.php?search_input=".$search ."&categoryID=".$cat_link."&page=$i'> $i </a> </li>  ";
}
//btn class comes from the materialized website. literlally copy the class name

 ?>
 </ul>
</div>
<br></br><br></br><br></br>
<?php include 'footer.php'?>
