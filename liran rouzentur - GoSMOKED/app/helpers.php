<?php
require_once 'db_config.php';
if (!function_exists('old')) {

  /**
   *
   * return last input value of a field
   *
   * @param    string  $fn The filed name
   * @return      string
   *
   */
  function old($fn)
  {
    return $_REQUEST[$fn] ?? '';
  }
}




if (!function_exists('csrf')) {

  /**
   *
   * generate rendom string for security
   *
   *
   * @return  string
   *
   */
  function csrf()
  {
    $token = sha1(rand(1, 10000) . '$$' . rand(1, 1000) . 'icar');
    $_SESSION['csrf_token'] = $token;
    return $token;
  }
}

if (!function_exists('user_auth')) {

  /**
   *
   * is this the real user ? online or offline ?
   *
   * 
   * @return      bool
   *
   */
  function user_auth()
  {

    $auth = false;

    if (isset($_SESSION['user_id'])) {

      if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {

        if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
          $auth = true;
        }
      }
    }
    return $auth;
  }
}



if (!function_exists('email_exist')) {


  /**
   *
   * chack if the user is allready signed up
   *
   * @param    PHP connaction to DB , the value the user put
   * @return      bool
   *
   */
  function email_exist($link, $email)
  {

    $exist = false;
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
      $exist = true;
    }
    return $exist;
  }
}
