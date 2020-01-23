
//! securty for SQL injection

mysqli_real_escape_string();

prevants whatever the user puts in the input boxes to be hacked by SQL injection
the user input is not going to read as a code because the function sets the input as string and all the characters that can be used by hackers to hack by SQL injection are gating backslash ("\") and referred to as string .
!!!! we will use this func in all the fileds thet users can write (input fields)!!!! chack signin.php .




//! xss attack

htmlentities(); && htmlspecialchars();

htmlentities() = every character that has an HTML entity (exemple : "! = &#33;" ) would be read as one. that meens that a code like "<script>
  bla bla bla
</script>" would accapted to the DB as an entity string and not as code : "&lt;script&gt; bla bla bla &lt;/script&gt;

htmlspecialchars()= considerd to be faster then htmlentities() because it would only transform thous how considered to be dangerous special characters (only transform : "&'>< ) but also considerd to be less safe . 

//* combind one of the above with :
filter_input(x,x,x); (type of input_what mathod , name of the input field ,aggainst "xss attaccs" ) aggainst "xss attaccs"


//* להגיד ל filter input
 לעזוב סימנים מיוחדים שמוגדרים מראש
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);

//! csrf (Cross-Site Request Forgery)

token();


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


//! password hashing

encrypted passwords!
password_hash('the password itself\what to encrypte ',the algorithm of the encryption);
//* evrey time the user input his password the algorithm transform to a random string, and saves this string in the data base until the next time the user would signin to the site and tham it would change
//* exemple: 324hjdf0-9idfn@$Kf%Dsg^Jsdgj^jdksgj

password_verify('the password that the user would use ',the saved encrypted password );
//* password_verify(); chacks if what the user has typed and what is saved as an encrypted string in the data base matches.


$hash_pass = password_hash('123456',PASSWORD_BCRYPT);
password_verify('123456', $hash_pass );


//! data fishing

https (ssl certificate)
//* buy an ssl certificate



//! session hijacking

//* store the user ip and the user agent


//* gives you all the info about the user and the host server
$_SERVER

//* client ip 
$_SERVER['REMOTE_ADDR']
//* client os and browser
$_SERVER['HTTP_USER_AGENT']
//* server ip
$_SERVER['SERVER_ADDR']
//* query string only
$_SERVER['QUERY_STRING']
//* requested mathod
$_SERVER['REQUEST_MATHOD']
//* the url only without the domain
$_SERVER['REQUEST_URI']
//* when was the request time / outpot in unix time
$_SERVER['REQUEST_TIME']
//* from where the client came from
if (isset ($_SERVER['HTTP_REFERER'])){
  $_SERVER['HTTP_REFERER']

}

//* use the next function

if(!function_exists('user_auth')){

/**
*
* is this the real user ? online or offline ?
*
* 
* @return      bool
*
*/
function user_auth(){

 $auth = false;

 if(isset($_SESSION['user_id'])){

   if(isset($_SESSION['user_ip'])&& $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']){

     if(isset($_SESSION['user_agent'])&& $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']){

              $auth = true;

     }
   } 
 }
return $auth;
}
}




//! secure file upload

chack error (0 = no error)
chack size
chack extantion
chack is_uploud





