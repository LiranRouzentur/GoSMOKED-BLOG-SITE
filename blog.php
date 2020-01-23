<?php

require_once 'app/helpers.php';
session_start();


$page_title = 'Blog';
//conaccet to the database with the login detiles
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

//before you send to mysql the data in the $sql,php informes mysql that they are going to talk in utf8
mysqli_query($link, "SET NAMES utf8");

// select from the database all the col from the table "posts" , and from the table users select the col name and date /join them where the id in users is equill to the user_id in posts.order them by descending date  
$sql = "SELECT u.name,up.profile_image,p.*,DATE_FORMAT(p.date,'%H:%i:%s  |||  %d/%m/%Y') pdate FROM posts p 
      JOIN users u ON u.id = p.user_id  
      JOIN users_profile up ON u.id = up.user_id 
      ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);

?>


<?php include 'tpl/header.php' ?>
<!-- Main -->
<main class="min-h750">
  <div class="container">
    <section id="blog-headline">
      <div class="row  ml-1">
        <div class="col-6-lg col-6-md col-6-sm text-center pl-2" style="background-color: rgba(0, 0, 0, 0.5);">
          <a class="navbar-brand text-danger font-weight-bold ">Go<i class="fas fa-fire"></i>MOKED</a>
          <h1 class="text-white font-weight-bold">Blog Page</h1>
        </div>


        <div class="col text-center ">
          <?php if (user_auth()) : ?>
            <a href="add_post.php" class="btn btn-danger btn-lg btn-logout-custom add-new-post-btn " style="margin-top: 2em">Add New a Post <i class="fas fa-plus-circle"></i></a>
          <?php else : ?>
            <a href="signin.php" class="btn btn-danger btn-lg btn-logout-custom add-new-post-btn " style="margin-top: 2em width:100">Join us today to add your own post</a>
          <?php endif; ?>
        </div>
      </div>


      <?php if (user_auth()) : ?>
        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
          <div class="row">
            <?php while ($post = mysqli_fetch_assoc($result)) : ?>
              <div class="col-12 my-4">
                <div class="card">
                  <div class="card-header">
                    <img width="30" height="30"src="images/<?= $post['profile_image']; ?> " class="rounded-circle mr-3">
                    <!--htmlentities() = every character  that has an HTML entity (exemple : "! = &#33;" ) would be read as one. that meens that a code like "<script>bla bla bla</script>" would accapted to the DB  as an entity string and not as code : "&lt;script&gt; bla bla bla &lt;/script&gt;-->
                    <span class="text-danger font-weight-bold"><?= htmlentities($post['name']); ?></span>
                    <span class="float-right text-danger font-weight-bold"><?= $post['pdate']; ?></span>
                  </div>
                  <div class="card-body">
                    <h4><?= htmlentities($post['title']); ?></h4>
                    <!--Look for all the \n(newline character in a string) and replace it with <br>-->
                    <p><?= str_replace("\n", '<br>', htmlentities($post['article'])); ?></p>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                      <div class="float-right">
                        <div class="dropdown show dropleft">
                          <a class=" text-danger font-weight-bold" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </a>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item text-danger " href="edit_post.php?pid=<?= $post['id']; ?>">
                              <i class="fas fa-edit mr-3"></i>Edit</a>

                            <a class="dropdown-item text-danger delete-post-btn" href="delete_post.php?pid=<?= $post['id']; ?>" onclick="return confirm('Are you sure?')">
                              <i class="fas fa-trash-alt mr-3"></i>Delete</a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u=example.org" class="dropdown-item text-danger" target="_blank"><i class="fab fa-facebook text-primary mr-3"></i>Share on Facebook</a>

                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif;  ?>
      <?php else : ?>
      <?php endif; ?>
    </section>
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
        case "POST_DELETED":
          echo 'toastr["error"]("<b>Post has been deleted successfuly</b>")';
          break;
        case "POST_CREATED":
          echo 'toastr["error"]("<b>Post has been created successfuly<b>")';
          break;
        case "POST_EDITED":
          echo 'toastr["error"]("<b>Post has been edited successfuly<b>")';
          break;
        case "PROFILE_EDITED":
          echo 'toastr["error"]("<b>Profile has been edited successfuly<b>")';
          break;
      }
      unset($_SESSION['blog_action']);
      ?>
  </script>

<?php endif ; ?>