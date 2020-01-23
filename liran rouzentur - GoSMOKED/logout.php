<?php
require_once 'app/helpers.php';
session_start();

$page_title = 'Logout';
if (!user_auth()) {
  header('location: ./');
  exit;
}
?>

<?php include 'tpl/header.php' ?>
<!-- Main -->
<main class="min-h750">
  <div class="container">
    <section>

      <div class="row ">
        <div class="col-12 text-center ">
          <h1 class="display-5 text-light ">are you sure you want to Logout from <a class="navbar-brand text-danger font-weight-bold">Go<i class="fas fa-fire"></i>MOKED</a>?
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center ">
          <a href="./">
            <input type="button" name="submit" value="No ! i want to stay !" class="btn btn-danger btn-lg btn-logout-custom" style="margin-top: 2em"></a>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center ">
        <a href="logoutcode.php">
            <input type="submit" name="submit" value="Log out" class="btn btn-danger btn-lg btn-custom" style="margin-top: 2em">
          
          </div>
      </div>
  </div>
  </section>



</main>
<?php include 'tpl/footer.php' ?>