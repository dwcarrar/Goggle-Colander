<?php
    session_start();
    include 'signUp.php'; 
    include 'logIn.php';

    if (isset($_POST['LogSubmit']) && isset($_POST['username'])) {
        $uname = htmlentities($_POST['username']);
        $pass = htmlentities($_POST['password']);

        $logger = new logIn();
        $valid = $logger->TryLogIn($uname,$pass);
	if ($valid == 1) {
            $_SESSION['username'] = $_POST['username'];
	    $_SESSION['loggedin'] = true;
	    header("LOCATION:conlander.php");
	}
    }
        
    if (isset($_POST['SignSubmit'])) {
        $name = htmlentities($_POST['name']);
        $uname = htmlentities($_POST['susername']);
        $pass1 = htmlentities($_POST['password1']);
        $pass2 = htmlentities($_POST['password2']);
 
        $signer = new signUp();
        $success=$signer->TrySignUp($name,$uname,$pass1,$pass2);
	if ($success == 2) {
	    echo "<script>alert('Sign-Up Successful!');</script>";
	}
    }
?>
<html>

<style>
    body {
        background-color: powderblue;
    }

    form {
        text-align: center;
        margin: auto;
        width: 60%;
        padding: 10px;
    }

    h1 {
        text-align: center;
    }

    .img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

</style>

<body>

<h1 style="color:blue;"> Goggle Colander </h1>

<form class="center" method = post action = "">
<input type="username" placeholder="Username" name="username"></br>
<input type="password" placeholder="Password" name="password"></br>
<input type = "submit" name = "LogSubmit" value = "Sign In">
</form>

<form method = "post" action = "">
<input type="username" maxlength="10" placeholder="Name" name="name"></br>
<input type="username" maxlength="10" placeholder="Username" name="susername"></br>
<input type="password" maxlength="10" placeholder="Password" name="password1"></br>
<input type="password" maxlength="10" placeholder="Re-Enter Your Password" name="password2"></br>
<input type = "submit" name = "SignSubmit" value = "Sign Up">
</form>

<img src="logo.png" align="middle" class="img">

</body>

</html>
