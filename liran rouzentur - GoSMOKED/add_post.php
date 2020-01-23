<?php
require_once 'app/helpers.php';
session_start();

if (!user_auth()) {
  header('location: ./');
  exit;
}
$page_title = 'Add post';

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



    $uid = $_SESSION['user_id'];

    // connect php to mysql database
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    //before you send to mysql the data in the $sql,php informes mysql that they are going to talk in utf8
    mysqli_query($link, "SET NAMES utf8");
    //mysqli_set_charset($link,"utf8");  same commend as the "mysqli_query($link,"SET NAMES utf8");"

    //! // prevants $title and $article(whatever the user puts in the title or article boxes)to be hacked by SQL injection // mysqli_real_escape_string() = the user input is not going to read as a code because the function sets the input as string and all the characters that can be used by hackers to hack by SQL injection are gating backslash ("\") and referred to as string .        !!!! we will use this func in all the fileds thet users can write (input fields)!!!!    chack signin.php .
    $title = mysqli_real_escape_string($link, $title);
    $article = mysqli_real_escape_string($link, $article);

    $sql = "INSERT INTO posts VALUES(null,$uid,'$title','$article',NOW())";

    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link) > 0) {
      $_SESSION['blog_action'] = 'POST_CREATED';
      header('location: blog.php');
      exit;
    }
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
          <h1 class="text-white font-weight-bold "><u>Add your New Post</u></h1>
        </div>
    </section>
    <section id=signin-form>
      <div class="row">
        <div class="col-md-6 mt-3 ">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="title">* Title:</label>
              <input type="text" value="<?= old('title'); ?>" name="title" id="title" class="form-control">
              <span class="text-danger font-weight-bold"><?= $errors['title']; ?> </span>
            </div>
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="article">* Article:</label>
              <textarea name="article" id="article" class="form-control" cols="30" rows="10"><?= old('article'); ?></textarea>
              <span class="text-danger font-weight-bold"><?= $errors['article']; ?> </span>
            </div>
            <input type="submit" name="submit" value="Uploud Post" class="btn btn-danger btn-lg btn-custom">
            <a href="blog.php" class="btn btn-secondary btn-lg ml-3" onclick="return confirm('Are you sure? all data would be lost !')">Cancel Post</a>

          </form>
        </div>
    </section>
  </div>


</main>
<?php include 'tpl/footer.php' ?>