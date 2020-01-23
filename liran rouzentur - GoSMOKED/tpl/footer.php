<!-- Footer -->
<footer>
  <div class="footer expand-lg" id="footer">
    <div class="container">
      <div class="row center-block text-center">
        <div class="col">
          <h3 class="location pb-3"> <ins>Contact</ins> </h3>
          <ul>
            <br>
            <li><a class="email" href="mailto: liranmail@gmail.com"> liranmail@gmail.com </a>
            </li>
            <li>
              <p>+972523711704</p>
            </li>

          </ul>
        </div>
        <div class="col-md-6">
          <h3 class="location pb-3"> <ins>Location:</ins> Givataim , Israel </h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27047.673836693684!2d34.79179484361653!3d32.0703514462151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4bba478c09a7%3A0x876720020e35c8f7!2sGiv&#39;atayim!5e0!3m2!1sen!2sil!4v1569849647899!5m2!1sen!2sil" width="300" height="125" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <!-- <div class="col">
          <ul>
            <li>
              <h5> <a href="blog.php" style="margin-top: 2em"> Blog</a>
              </h5>
            </li>

            <li>
              <h5><a href="about.php"> About </a>
              </h5>
            </li>


            <?php if (!user_auth()) : ?>
              <li>
                <h5><a href="signin.php">Signin</a></h5>
              </li>
              <li>
                <h5><a href="signup.php">Signup</a></h5>
              </li>
            <?php else : ?>
              <li class="mx-5">
                <h5>
                  <div>
                    <div class="dropdown ">
                      <a class=" text-danger font-weight-bold" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>
                          <img width="30" height="30" class="rounded-circle ml-4" src="images/<?= $_SESSION['user_image']; ?>">
                          <?= htmlentities($_SESSION['user_name']); ?></a>
                      </span>
                      <div class="dropdown-menu  text-center mt-2 " aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item text-danger" href="profile.php?pid=<?= $_SESSION['user_name']; ?>"><i class="far fa-address-card mr-4"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger " href="logout.php"><i class="fas fa-sign-out-alt mr-3"></i>Log out</a>


                      </div>
                    </div>
                  </div>
                </h5>
          </li>
              <?php endif; ?>




          </ul>
        </div>

        <!--/.row-->
      </div>
      <!--/.container-->
    </div>
    <!--/.footer-->
    <div>

    </div> -->

    <div class="text-center">
      <a class="footer-copyright text-danger font-weight-bold" href="./">Go<i class="fas fa-fire"></i>MOKED &copy; <?= date('Y'); ?></a>
    </div>
  </div>
  <!--/.footer-bottom-->
  
  <!--scroll up button-->
  <div class="progress-wrap">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
  <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>

</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/dc93cf3e39.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="js/script.js"></script>

</body>

</html>


