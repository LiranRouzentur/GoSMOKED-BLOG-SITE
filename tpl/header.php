<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <link rel="stylesheet" href="css/style.css">
  
  <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
  <link rel="manifest" href="../manifest.json">
  <title >GoSMOKED | <?= $page_title ?> </title>
</head>


<body>



  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent ">
      <div class="container ">

        <a class="navbar-brand text-danger font-weight-bold" href="./">Go<i class="fas fa-fire"></i>MOKED</a>
        <button class="navbar-toggler white-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span  class="fas fa-hamburger bg-transparent text-danger "></span>
        </button>



        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto list-group font-weight-bold">

            <li class="nav-item active">
              <a class="nav-link  text-white" href="blog.php">Blog<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link  text-white" href="about.php">About<span class="sr-only">(current)</span></a>
            </li>


            <?php if (!user_auth()) : ?>
              <li class="nav-item active">
                <a class="nav-link  text-white" href="signin.php">Signin<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link  text-white" href="signup.php">Signup<span class="sr-only">(current)</span></a>
              </li>
            <?php else : ?>
              <div class="float-left mt-4">
                <div class="dropdown ">
                  <a class=" text-danger font-weight-bold " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                      <img width="30" height="30" class="rounded-circle mr-3" src="images/<?= $_SESSION['user_image']; ?>">
                      <?= htmlentities($_SESSION['user_name']); ?></a>
                  </span>
                  <div class="text-center dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-danger" href="profile.php?pid=<?= $_SESSION['user_name']; ?>"><i class="far fa-address-card mr-4"></i>Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger " href="logout.php"><i class="fas fa-sign-out-alt mr-3"></i>Log out</a>


                  </div>
                </div>
              </div>



            <?php endif; ?>
          </ul>

        </div>

      </div>
    </nav>
    


  </header>
  

  