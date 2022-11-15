<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utc-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
</head>

<body>
    <form action="login.php" method="post">
        <div class="imgcontainer">
            <img src="avatar.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label for="Name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="Uname" id="username" required>
            <label for="psw"><B>Password</B></label><br>
            <input type="password" placeholder="Enter Password" name="psw" id="password" required>
            <button type="submit">Login</button>
            <button type="button" class="signupbtn"><a href="register.php">Sign Up</a></button>
        </div>
        <div class="container" style="background-color: white ">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">Password ?</a></span>
        </div>
    </form>
</body>

</html>