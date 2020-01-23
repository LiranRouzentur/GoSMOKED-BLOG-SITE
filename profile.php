<?php


require_once 'app/helpers.php';
session_start();


$page_title = 'Edit your profile';

if (!user_auth()) {
  header('location: ./');
  exit;
}


$errors = [
  'name' => '',
  'email' => '',
  'password' => '',
  'conf_password',
];

$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
$sql_edit = "SELECT * FROM users u WHERE u.id ='$_SESSION[user_id]'; ";
$result = mysqli_query($link, $sql_edit);
$edited = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {


  $new_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $new_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $conf_password = filter_input(INPUT_POST, 'conf_password', FILTER_SANITIZE_STRING);

  $form_valid = true;

  if (!$new_name || mb_strlen($new_name) < 2) {

    $errors['name'] = "* Name must be at least two characters long";
    $form_valid = false;
  }
  if (!$new_email) {

    $errors['email'] = '* A valid email is required';
    $form_valid = false;
  }
  if (!$conf_password || strlen($conf_password) != strlen($password)) {
    $errors['password'] = '* Password\'s dont Match !';
    $form_valid = false;
  }
  if (!$password || strlen($password) < 6 || strlen($password) > 20) {
    $errors['password'] = '* Password is required to be at least 6 characters long and up to 20';
    $form_valid = false;
  }
  if (empty($password) || empty($conf_password)) {
    $form_valid = true;
  }

  $profile_image = $_SESSION['user_image'];
  define('MAX_FILE_SIZE', 1024 * 1024 * 5);

  // if there where a file upload  && the error is 0
  if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {

    // if there where a file upload && the file size is what we set in the difine ver MAX_FILE_SIZE
    if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

      // if its set
      if (isset($_FILES['image']['name'])) {

        // what file extensions to allaow
        $allowed_ex = ['jpg', 'png', 'jpeg', 'gif', 'bmp'];

        // "pathinfo()" func in php - input a file name and it would return an array with this files info [dirname,basename , extension , filename]. 
        $details = pathinfo($_FILES['image']['name']);


        // whatever the user send , change it to lowercase and if in the array $details there are extension that are the same as the ones in $allowed_ex
        if (in_array(strtolower($details['extension']), $allowed_ex)) {

          // Check if this is a new file that is bieng uploded to the server right now in to the tmp folder. this would make it impossible for hackers to get an already made file that is on the server and to use it for their benefit.
          if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {


            // the new name of the upluded file would be the date he was uploded + his origenal name before uplode , this makes him extrimly uniqe
            $profile_image = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];


            // finale step . move the file .
            //func in php = move_uploaded_file(first arrgument = where is the file temporrery ? , secound arrgument = where to you want to move the file and whats is going to be his name , );

            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $profile_image);
          }
        }
      }
    }
  }

  // if user type in all the fields chack with the database
  if ($form_valid) {

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $pid = $_SESSION['user_id'];

    $new_name = mysqli_real_escape_string($link, $new_name);
    $new_email = mysqli_real_escape_string($link, $new_email);
    $password = mysqli_real_escape_string($link, $password);
    $password = password_hash($password, PASSWORD_BCRYPT);


    $sql = "UPDATE users u SET u.name = '$new_name' , u.email = '$new_email', u.password = '$password' WHERE u.id = $pid";
    $result = mysqli_query($link, $sql);


    if ($result && mysqli_affected_rows($link) > 0) {
      $sql = "UPDATE users_profile SET profile_image = '$profile_image' WHERE user_id = '$pid'";
      $result = mysqli_query($link, $sql);
    }




    $_SESSION['user_name'] = $new_name;

    $_SESSION['user_image'] = $profile_image;

    $_SESSION['blog_action'] = 'PROFILE_EDITED';
    header('location: blog.php');

    exit;
  }
}


?>

<?php include 'tpl/header.php' ?>
<!-- Main -->
<main class="min-h750">
  <div class="container">

    <div class="card-body">
      <h5 class="mb-4 text-center text-white font-weight-bold h3"><u>Edit your profile</u></h5>
      <form class="m-0 sky-form" action="" method="post" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?= $token; ?>">
        <div class="form-group">
          <label class="text-white font-weight-bold h5" for="name">* Name </label>
          <input class="form-control" type="text" name="name" value="<?= htmlentities($edited['name']); ?>" placeholder="">
          <small class="form-text text-danger"><?= $errors['name']; ?></small>
        </div>
        <div class="form-group">
          <label class="text-white font-weight-bold h5" for="email">* Email</label>
          <input class="form-control" type="email" name="email" value="<?= htmlentities($edited['email']); ?>" placeholder="">
          <small class="form-text text-danger"><?= $errors['email']; ?></small>
        </div>
        <div class="form-group">
          <label class="text-white font-weight-bold h5" for="password">Password</label>
          <input value="" class="form-control" type="password" name="password" id="password" placeholder="">
          <small class="form-text text-danger"><?= $errors['password']; ?></small>
          <span class="text-danger"></span>
        </div>
        <div class="form-group">
          <label class="text-white font-weight-bold h5" for="conf_password">Password confirmation</label>
          <input value="" class="form-control" type="password" name="conf_password" id="conf_password" placeholder="">
          <small class="form-text text-danger"><?= $errors['password']; ?></small>
          <small class="form-text" id="message"></small>
          <span class="text-danger"></span>
        </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text text-danger font-weight-bold h5" id="inputGroupFileAddon01">Change profile image</span>
            </div>
            <div class="custom-file ">
              <input onchange="jQuery(this).next('label').text(this.value);" type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01"></label>
            </div>
          </div>
          <span class="text-danger"></span>
        </div>

        <div class="form-group">
          <button style="margin: 0px;" type="submit" name="submit" class="btn btn-danger btn-block mt-30 text-center">
            Save changes
          </button>
        </div>
      </form>
    </div>

  </div>



</main>
<?php include 'tpl/footer.php' ?>