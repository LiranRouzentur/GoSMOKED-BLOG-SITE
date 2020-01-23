<?php
require_once 'app/helpers.php';
session_start();

// if the user is allready connected dont run the code after this IF and send the user straight to the home page
if (isset($_SESSION['user_id'])) {
  header('location: ./');
  exit;
}
$page_title = 'Sign up page';

$errors = [
  'name' => '',
  'email' => '',
  'password' => '',
  'submit' => '',
];

// IF client click on submit btn
if (isset($_POST['submit'])) {



  if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {


    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    // collect client data into variabels 
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($link, $name);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // and validaite as an email
    $email = mysqli_real_escape_string($link, $email);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($link, $password);
    $form_valid = true;
    $profile_image = 'default_profile.png';
    define('MAX_FILE_SIZE', 1024 * 1024 * 5);


    //error if the next if staitment is true
    if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {

      $errors['name'] = '* Name is required to be at least 2 characters long and up to 70';
      $form_valid = false;
    }
    if (!$email) {
      $errors['email'] = '* A valid email is required';
      $form_valid = false;
    } elseif (email_exist($link, $email)) {
      $errors['email'] = '* Email is taken';
      $form_valid = false;
    }
    if (!$password || strlen($password) < 6 || strlen($password) > 20) {
      $errors['password'] = '* Password is required to be at least 6 characters long and up to 20';
      $form_valid = false;
    }

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





    


    if ($form_valid) {

      $password = password_hash($password, PASSWORD_BCRYPT);
      $sql = "INSERT INTO users VALUES(null,'$name','$email','$password')";
      $result = mysqli_query($link, $sql);

      if ($result && mysqli_affected_rows($link) > 0) {
        $new_user_id = mysqli_insert_id($link);
        $sql = "INSERT INTO users_profile VALUES(null,$new_user_id,'$profile_image')";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) > 0) {

          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];

          //  crates new sessoin under the name user_agent and the value is the user os and browser on login 
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

          // crates sessoin under the name user_id and his value is $user = id
          $_SESSION['user_id'] = $new_user_id;

          // crates sessoin under the name user_name and his value is  $user = name
          $_SESSION['user_name'] = $name;

         

          $_SESSION['user_image'] = $profile_image;

          $_SESSION['blog_action'] = 'FIRST_SIGNUP_INDICATOR';
          // redirect,to the blog page and dont proccese the code after this point
          header('location: blog.php');
          exit;
        }
      }
    }
  }
  $token = csrf();
} else {
  $token = csrf();
}



?>
<?php include 'tpl/header.php' ?>
<!-- Main -->
<main class="min-h750">
  <div class="container">
    <section id=signin-header>
      <div class="row ">
        <div class="col-4 text-center ">
          <h1 class="display-5 text-light ">Join<h1 class="display-5 text-danger ">Go<i class="fas fa-fire "></i>MOKED<h1 class="display-5 text-light "> today !</h1>
        </div>
    </section>
    <section id=signin-form>
      <div class="row ">
        <div class="col-lg-6 mt-3 ">
          <!--enctype="multipart/form-data" transforms the file that the user upload to binary, so he would be able to reach the server. The server is in http/https and thous protocol only able to move text type data. Later when the file would be all ready on the server we would transform it back to its original file type. -->
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $token; ?>">
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="name">* Name:</label>
              <input type="text" value="<?= old('name'); ?>" name="name" id="name" class="form-control">
              <span class="text-danger font-weight-bold"><?= $errors['name']; ?></span>
            </div>

            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="email">* Email:</label>
              <input type="email" value="<?= old('email'); ?>" name="email" id="email" class="form-control">
              <span class="text-danger font-weight-bold"><?= $errors['email']; ?></span>
            </div>

            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="password">* Password:</label>
              <input type="password" name="password" id="password" class="form-control ">
              <span class="text-danger font-weight-bold"><?= $errors['password']; ?></span>
            </div>




            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text text-danger font-weight-bold h5" id="inputGroupFileAddon01">Upload profile image</span>
                </div>
                <div class="custom-file ">
                  <input onchange="jQuery(this).next('label').text(this.value);" type="file" name="simage" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01"></label>
                </div>
              </div>
              <span class="text-danger"></span>
            </div>


            <input type="submit" name="submit" value="Sign up" class="btn btn-danger btn-lg btn-custom" style="margin-top: 2em">

          </form>
        </div>
    </section>
  </div>


</main>
<?php include 'tpl/footer.php' ?>