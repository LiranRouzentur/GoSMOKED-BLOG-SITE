<?php
require_once 'app/helpers.php';
session_start();



if (isset($_COOKIE['rememberme_id']) && isset($_COOKIE['rememberme_name'])) {
  $_SESSION['user_id'] = $_COOKIE['rememberme_id'];
  $_SESSION['user_name'] = $_COOKIE['rememberme_name'];
  $_SESSION['user_ip'] = $_COOKIE['rememberme_user_ip'];
  $_SESSION['user_agent'] = $_COOKIE['rememberme_user_agent'];
}


//conaccet to the database with the login detiles
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

//before you send to mysql the data in the $sql,php informes mysql that they are going to talk in utf8
mysqli_query($link, "SET NAMES utf8");

// select from the database all the col from the table "posts" , and from the table users select the col name and date /join them where the id in users is equill to the user_id in posts.order them by descending date  
$sql = "SELECT u.name,up.profile_image,p.*,DATE_FORMAT(p.date,'%H:%i:%s  |||  %d/%m/%Y') pdate FROM posts p 
      JOIN users u ON u.id = p.user_id  
      JOIN users_profile up ON u.id = up.user_id 
      ORDER BY p.date DESC
      LIMIT 2";

$result = mysqli_query($link, $sql);





$page_title = 'Home';

?>

<?php include 'tpl/header.php' ?>



<!-- Main -->
<main class="min-h750">


  <div class="container">
    <section id=main-class-contact>
      <div class="row ">
        <div class="col-12 text-center ">
          <h1 class="display-5 text-light ">Welcome To GoSMOKED</h1>
        </div>
        <div class="col-12 text-center ">
          <h3 class="text-light ">A Great Place To Learn , And Share , Passion For Smoked Food </h3>
        </div>
      </div>
    </section>
    <section id="joinUSbtn">
      <div class="row">
        <div class="col-12 text-center">
          <?php if (!user_auth()) : ?>
            <a href="signin.php"><button class="btn btn-danger btn-lg btn-logout-custom btn-custom" style="margin-top: 3.5em">Join Us</button></a>
          <?php else : ?>
            <a href="add_post.php"><button class="btn btn-danger btn-logout-custom btn-lg btn-custom " style="margin-top: 3.5em">Add a New Post <i class="fas fa-plus-circle btn-logout-custom"></i></button></a>
          <?php endif; ?>


    </section>


    <section id="home-page-blog">

      <div class="row mb-2 my-5 ">
        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
          <?php $i = 0;
            while ($post = mysqli_fetch_assoc($result)) : ?>
            <div class="col-md-6">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                <div class="col p-4 d-flex flex-column position-static">

                  <strong class="d-inline-block mb-2 text-primary"></strong>
                  <h3 class="mt-1 word-break"><?= htmlentities($post['title']); ?></h3>
                  <div>
                    <img width="30" height="30" src="images/<?= $post['profile_image']; ?> " class="rounded-circle mr-3 mb-2 "><span class="text-danger font-weight-bold"><?= htmlentities($post['name']); ?></span>
                  </div>




                  <div class="mb-1 text-muted"><?= $post['pdate']; ?></div>
                  <p class="card-text mb-auto">
                    <?= mb_substr(str_replace("\n", '<br>', htmlentities($post['article'])), 0, 40) . "..."; ?>
                  </p>
                  <?php if (!user_auth()) : ?>
                    <a href="signin.php" class="stretched-link">Continue reading</a>
                  <?php else : ?>
                    <a href="blog.php" class="stretched-link">Continue reading</a>
                  <?php endif; ?>


                </div>
                <div class="col-auto d-none d-lg-block">
                  <?php if ($i % 2 == 0) : ?>
                    <img src="images/bbq1.jpg" alt="bbq1" width="200" height="250">
                  <?php else : ?>
                    <img src="images/bbq2.jpg" alt="bbq1" width="200" height="250">
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php $i++;
            endwhile; ?>

        <?php endif; ?>

      </div>

    </section>





  </div>
  </div>





</main>


<?php include 'tpl/footer.php' ?>


<?php if (user_auth() && isset($_SESSION['blog_action'])) : ?>
  <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }


    <?php
      switch ($_SESSION['blog_action']) {
        case "FIRST_SIGNIN_INDICATOR":
          echo 'toastr["error"]("<b>Welcome back , Login Succeeded</b>")';
          break;
        case "FIRST_SIGNUP_INDICATOR":
          echo 'toastr["error"]("<b>Welcome to GoSMOKED !<b>"," Signup Succeeded")';
          break;
      }
      unset($_SESSION['blog_action']);
      ?>
  </script>
<?php endif; ?>