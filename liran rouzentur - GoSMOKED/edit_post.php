<?php
require_once 'app/helpers.php';
session_start();

if (!user_auth()) {
  header('location: ./');
  exit;
}

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {

  $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

  if ($pid) {

    $uid = $_SESSION['user_id'];

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    mysqli_query($link, "SET NAMES utf8");
    $pid = mysqli_real_escape_string($link, $pid);
    $sql = "SELECT * FROM posts WHERE id = $pid AND user_id=$uid";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

      $post = mysqli_fetch_assoc($result);
    } else {
      header('location: blog.php');
      exit;
    }
  } else {

    header('location: blog.php');
    exit;
  }
} else {
  header('location: blog.php');
  exit;
}
$page_title = 'Edit post';

$errors = [
  'title' => '',
  'article' => '',

];

if (isset($_POST['submit'])) {


  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $form_valid = true;

  if (!$title || mb_strlen($title) < 2) {

    $form_valid = false;
    $errors['title'] = "* Title must be at least two characters long";
  }
  if (!$article || mb_strlen($article) < 2) {

    $form_valid = false;
    $errors['article'] = "* Article must be at least two characters long";
  }
  // if user type in all the fields chack with the database
  if ($form_valid) {

    $title = mysqli_real_escape_string($link, $title);
    $article = mysqli_real_escape_string($link, $article);
    $sql = "UPDATE posts SET title = '$title' , article = '$article' WHERE id = $pid";
    $result = mysqli_query($link, $sql);
    $_SESSION['blog_action'] = 'POST_EDITED';
      header('location: blog.php');
      
      exit;
    
  }
}

?>

<?php include 'tpl/header.php' ?>
<!-- Main -->
<main class="min-h750">
  <div class="container">
    <section id="add-new-post-headline">
      <div class="row">
        <div class="col text-left ">
          <h1 class="text-white font-weight-bold "><u>Edit your Post</u></h1>
        </div>
    </section>
    <section id=signin-form>
      <div class="row">
        <div class="col-md-6 mt-3 ">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="title">* Title:</label>
              <input type="text" value="<?=htmlentities($post['title']); ?>" name="title" id="title" class="form-control">
              <span class="text-danger font-weight-bold"><?= $errors['title']; ?> </span>
            </div>
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="article">* Article:</label>
              <textarea name="article" id="article" class="form-control" cols="30" rows="10"><?=htmlentities($post['article']); ?></textarea>
              <span class="text-danger font-weight-bold"><?= $errors['article']; ?> </span>
            </div>
            <input type="submit" name="submit" value="Update Post" class="btn btn-danger btn-lg btn-custom">
            <a href="blog.php" class="btn btn-secondary btn-lg ml-3 " onclick="return confirm('Are you sure? all data would be lost !')">Cancel</a>

          </form>
        </div>
    </section>
  </div>


</main>
<?php include 'tpl/footer.php' ?>