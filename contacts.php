<?php
//this will contain all my contact details
session_start(); // start the seesion in order to destroy it (to log user out)
session_destroy(); //to automatically log the user out when checking into the contacts page

include 'layout.php'; //includes the layout (header) for the page
 ?>

<!--div tags used to move the box to the center of the page -->
<div class="contact">
  <h2>Having trouble?</h2>
  <div class="getInTouch">
    <p>Here's how to get in touch with us!</p>
    <ul class="myOrder" style="list-style: none;">
      <li>Email: VBooks.co@myVBooks.com</li>
      <li>Phone: 089994582</li>
      <li>Location:38811 Cherry St, Newark, CA 94560, USA </li>
    </ul>
    <p>At VBooks we strive to give our users the best possible expereince.</p>
    <p>So we make sure that our customer service team are ready to help you with any quereies you may have.</p>
  </div>
</div>






<!--includes the footer of the page-->
<?php include 'footer.php'; ?>
