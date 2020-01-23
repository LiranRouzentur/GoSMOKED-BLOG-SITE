<?php
require_once 'app/helpers.php';
session_start();

// if the user is allready connected dont run the code after this IF , and send the user straight to the home page
if (isset($_SESSION['user_id']) || isset($_COOKIE['rememberme_id'])) {
  header('location: ./');
  exit;
}
$page_title = 'Sign in page';

$errors = [
  'email' => '',
  'password' => '',
  'submit' => '',
];

// IF client click on submit btn
if (isset($_POST['submit'])) {


  if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {


    // collect client data into variabels 
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // and validaite as an email
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // if the user didnt type anything to the email field
    if (!$email) {

      $errors['email'] = '* A valid email is required';
    } elseif (!$password) { // if the user did type to the email filed but not the password field
      $errors['password'] = '* Please enter your password';
    } else { // if the user type in all the fields chack with the database
      // connect php to mysql database
      $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);



      $email = mysqli_real_escape_string($link, $email);
      $password = mysqli_real_escape_string($link, $password);

      // select all data from users file in database  thet matches ither the nameor password thet where inserted by the user 
      $sql = "SELECT u.*,up.profile_image FROM users u  
      JOIN users_profile up ON  u.id = up.user_id 
       WHERE email = '$email' LIMIT 1 ";
      //return the selected object 
      $result = mysqli_query($link, $sql);


      // if there is a match with what the user typed in
      if ($result && mysqli_num_rows($result) == 1) {

        // fetch the all the data match on that user
        $user = mysqli_fetch_assoc($result);


        // if the password thet stord in the database matches what the user typed
        if (password_verify($password, $user['password'])) {


          if (!empty($_POST['remember'])) {

            $for_time = time() + 60 * 60 * 24 * 365;
            setcookie('rememberme_id', $user['id'], $for_time, "/");
            setcookie('rememberme_name', $user['name'], $for_time, "/");
            setcookie('rememberme_user_ip', $_SERVER['REMOTE_ADDR'], $for_time, "/");
            setcookie('rememberme_user_agent', $_SERVER['HTTP_USER_AGENT'], $for_time, "/");
          }



          //  crates new sessoin under the name user_ip and the value is the user ip on login as saved on the $_SERVER['REMOTE_ADDR'];
          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];

          //  crates new sessoin under the name user_agent and the value is the user os and browser on login 
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

          // crates sessoin under the name user_id and his value is $user = id
          $_SESSION['user_id'] = $user['id'];

          // crates sessoin under the name user_name and his value is  $user = name
          $_SESSION['user_name'] = $user['name'];



          $_SESSION['user_image'] = $user['profile_image'];



          // redirect,to the home page and dont proccese the code after this point
          $_SESSION['blog_action'] = 'FIRST_SIGNIN_INDICATOR';
          header('location: ./');
          exit;
        } else { // if not true return the following
          $errors['submit'] = '* Wrong email or password';
        }
      } else { // if not true return the following
        $errors['submit'] = '* Wrong email or password';
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
        <div class="col-lg-4 col-md-6 col-sm-12 text-center ">
          <h1 class="display-5 text-light ">Sign In with your </h1>
          <h1 class="display-5 text-danger ">Go<i class="fas fa-fire "></i>MOKED<h1 class="display-5 text-light "> account.</h1>
        </div>
    </section>
    <section id=signin-form>
      <div class="row ">
        <div class="col-lg-6 mt-3 ">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <input type="hidden" name="csrf_token" value="<?= $token; ?>">
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="email">* Email:</label>
              <input type="email" value="<?= htmlentities(old('email')); ?>" name="email" id="email" class="form-control">
              <span class="text-danger font-weight-bold"><?= $errors['email']; ?></span>
            </div>
            <div class="form-group">
              <label class="text-white font-weight-bold h4" for="password">* Password:</label>
              <input type="password" name="password" id="password" class="form-control ">
              <span class="text-danger font-weight-bold"><?= $errors['password']; ?></span>
              <span class="text-danger font-weight-bold"><?= $errors['submit']; ?></span>
            </div>
            <div class="form-check">
              <label for="remember" class="form-check-label text-white font-weight-bolder">
                <input type="checkbox" id=remember value="1" class="form-check-input" name="remember"> Remember me
              </label>
            </div>
            <input type="submit" name="submit" value="Sign in" class="btn btn-danger btn-lg btn-custom" style="margin-top: 2em">

          </form>
        </div>
    </section>

    <section>
      <div class="row">
        <div class="col-lg-6 mt-3 font-weight-bolder">
          <b class="text-white ">Haven't got your free account yet? </b>
          <a href="signup.php" class="text-danger ml-2 h5" style="background-color:rgba(0, 0, 0, 0.5)"> Sign up today !</a>
        </div>
      </div>

  </div>

  </div>
  </section>



  </div>
  </div>


</main>
<?php include 'tpl/footer.php' ?>