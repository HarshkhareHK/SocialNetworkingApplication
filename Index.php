<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;

}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = $login_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please Enter Username.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please Enter your Password.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: welcome.php");
                        } else {
                            $login_err = "Invalid Username or Password";
                        }
                    }
                } else {
                    $login_err = "Invalid Username or Password";
                }
            } else {
                echo "OOPs! something went wrong";
            }
            mysqli_stmt_close($stmt);
        }

    }
    mysqli_close($link);
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {

            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your Credentials</p>
        <?php
        if (!empty($login_err)) {
            echo '<div >' . $login_err . '</div>';

        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="imgcontainer">
                <img src="avatar.png" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="Name"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username"
                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span>
                    <?php echo $username_err; ?>
                </span>
                <label for="psw"><B>Password</B></label><br>
                <input type="password" placeholder="Enter Password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span>
                    <?php echo $password_err; ?>
                </span>
                <input type="submit" value=Login>
                <p>don't have an account? <a href="register.php">Signup Now</a> </p>
            </div>
        </form>
    </div>
</body>

</html>