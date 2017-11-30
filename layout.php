<?php
//this is the header layout for the login page and the set up page.
 ?>

<!--all the div tags and nav tags are used to structure the navigation bar out.
chnge shape, colour, etc,

It also hols links to various pages such as setup page , contacts page, login page , etc.
even the logo 'VBooks' is a link to the login page -->
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width , initial-scale=1.0">
     <title></title>
     <link rel="stylesheet" href="main.css">
     <link rel="stylesheet" href="setUp.css">
     <link rel="stylesheet" href="login.css">
   </head>
   <body>
     <!--the header-->
     <header>
     <nav class="MYnavtab">
       <div class="MYmenu">
         <a class ="MYwebLogo" href="login.php">VBooks</a>
         <ul class="MYultab">
           <li><a href="#myBook">My Books</a></li>
           <!--this is the little dropdo bar on the header. the javascript
         in this basically disables the first link. so when i click on it nothing happens-->
           <li class="MYdropdown"><a href="javascript:void(0)" class="MYdropbtn" >My account</a>
             <div class="MYdropdown-content">
               <a href="login.php">Login</a>
               <a href="setUp.php">Sign up!</a>
               <a href="contacts.php">Contact</a>
             </div>
           </li>
           <li><a href="login.php">Home</a></li>
         </ul>
       </div>

     </nav>
    </header>
<section>
</section>

     <!--Inspiration for this navigation bar was researched from W3Schools-->
