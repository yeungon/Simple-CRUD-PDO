<?php // Do not put any HTML above this line
session_start();

/*if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}
*/
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // ==> md5(XyZzy12*_php123) /notmeow123

// $failure = false;  // If we have no POST data




// Check to see if we have some POST data, if we do process it

if ( isset($_POST['ok'])) {

// if ( isset($_POST['email']) && isset($_POST['pass']) ) {


    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {


        /*$failure = "User name and password are required";*/

          $_SESSION['error'] = "User name and password are required";

             header("Location: login.php");

            return;
       

    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL )){

        // $failure =  "Email must have an at-sign (@)"; 

        $_SESSION['error'] = "Email must have an at-sign (@)";

        header("Location: login.php");

        return;


    }else {
        

        /*combine the "salt" and the input password typed by the users*/
        
        $passwordinput = $salt.$_POST['pass'];

        /*convert to the hash using the function md5()*/
        
        $check = md5($passwordinput);

               
        /*$check = hash('md5', $salt.$_POST['pass']);*/

        if ( $check == $stored_hash ) {
            // Redirect the autos.php

            error_log("Login success ".$_POST['email']);

            // Redirect the browser to view.php
            $_SESSION['name'] = $_POST['email'];

            // echo $_SESSION['name'];

            header("Location: index.php");
            
            return;
            
        } else {

            $_SESSION['error'] = "Incorrect password";
        
            header("Location: index.php");

            return;
            

            /*the log is recorded*/

            error_log("Login fail ".$_POST['email']." $check");


        }
    }
}


/*cancel button*/

if(isset($_POST['cancel'])){

    header("Location: index.php");

    return;
}






?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>Vuong Nguyen</title>
</head>
<body>
<div class="container">
<h1>Welcome to the Automobiles, Sessions, and POST-Redirect designed by Vuong Nguyen</h1>    
<h4>Please Log In</h4>
<?php

/*if ( $failure !== false ) {
    
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
*/
if ( isset($_SESSION['error']) ) {

echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");

unset($_SESSION['error']);

}


?>
<form method="POST" action="login.php">

<label for="nam">User Name</label>

<input type="text" name="email" id="nam"><br/>

<label for="id_1723">Password</label>

<input type="text" name="pass" id="id_1723"><br/>

<input type="submit" name = 'ok' value="Log In">

<input type="submit" name = "cancel" value="Cancel">



<!-- <input type="submit" name="cancel" value="Cancel"> -->



</form>


<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is php123. -->
</p>
</div>
</body>

</html>
