<?php
    include 'signUp.php'; 
    include 'logIn.php';

    if (isset($_POST['LogSubmit']) && isset($_POST['username'])) {
        $uname = htmlentities($_POST['username']);
        $pass = htmlentities($_POST['password']);

        $logger = new logIn();
        $logger->TryLogIn($uname,$pass);
    }
        
    if (isset($_POST['SignSubmit'])) {
        $name = htmlentities($_POST['name']);
        $uname = htmlentities($_POST['susername']);
        $pass1 = htmlentities($_POST['password1']);
        $pass2 = htmlentities($_POST['password2']);
 
        $signer = new signUp();
        $signer->TrySignUp($name,$uname,$pass1,$pass2);
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
Username: <input type="username" name="username"></br>
Password: <input type="password" name="password"></br>
<input type = "submit" name = "LogSubmit" value = "Sign In">
</form>

<form method = "post" action = "">
Name: <input type="username" name="name"></br>
Username: <input type="username" name="susername"></br>
Password: <input type="password" name="password1"></br>
Re-Enter Your Password: <input type="password" name="password2"></br>
<input type = "submit" name = "SignSubmit" value = "Sign Up">
</form>

<img src="logo.png" align="middle" class="img">

</body>

</html>
