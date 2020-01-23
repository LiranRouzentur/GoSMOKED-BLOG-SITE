<?php
require_once 'app/helpers.php';
session_start();
$page_title = 'About';

?>

 <?php include 'tpl/header.php' ?>
  <!-- Main -->
  <main class="min-h750">
    <div class="container">

<div class="row featurette my-5">
<div class="col col-lg-4 col-md-12 col-sm-12 ">
    <img class="featurette-image img-responsive mb-5"  alt="500x500" style="height: 500px; object-fit:contain" src="images/meabout.jpg" data-holder-rendered="true">
  </div>

  <div class="col col-lg-8 col-md-12 col-sm-12   about-text">
    <h2 class="featurette-heading text-white "><ins>A Little Bit About Us.</ins><br> <h4><span class="text-white">a doorway to food lovers all around the world...</span></h4></h2>

    <p class="lead mt-5 text-danger font-weight-bolder "><strong>We all love sharing information about our passions.<br>
             What do we love more than sharing our own opinions? <br>
             Checking out what other people have to say!<br>
          If you are looking for delicious smoking recipes,<br>
           BBQ techniques or even wanting to learn a bit more<br>
            about the barbecuing history than this site has all of that covered<br>
             and more! <br>
            So when you take a look at this site, approach it with a napkin handy!</strong></p>
  </div>
  
</div>


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing text-center mt-5">

  
  <div class="row">
    <div class="col-lg-6 text-danger">
      <img class="rounded-circle" src="images/recipeAbout.jpg" alt="recipe " width="140" height="140">         
      <h2>Recipes</h2>
      <p><strong>social network created for cooks by cooks. where everyone plays a part in helping cooks discover and share the joy of home cooking .</strong></p>
      
    </div>
    <div class="col-lg-6 text-danger">
      <img class="rounded-circle" src="images/sharingAbout.jpg" alt="sharing " width="140" height="140">
      <h2>Meet New People</h2>
      <p><strong>Not only will it make your adventure incredibly delicious, it's a great way to learn a new skill, connect with a new community and familiarize yourself with the smoked food scene. A win-win, right? </strong></p>
      
    </div><!-- /.col-lg-4 -->
    <!-- <div class="col-lg-4">
      <img class="rounded-circle" src="images/potAbout.jpg" alt="pot "  width="140" height="140">
      <h2>Kitchen Equipment</h2>
      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
      
    </div>/.col-lg-4 -->
  </div><!-- /.row -->


  <!-- START THE FEATURETTES -->



  </main>
<?php include 'tpl/footer.php' ?>