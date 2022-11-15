<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi, <b>
            <?php echo htmlspecialchars($_SESSION["username"]); ?>
        </b>. Welcome to our site</h1>
    <div class="card-body">
        <?php
        $unfollowedUserResult = $user->getFollower();
        while ($unfollowedUser = $unfollowedUserResult->fetch_assoc()) {
        ?>
        <li class="list-group-item" style=" padding: 5px;">
            <a href="#">@
                <?php echo $unfollowedUser['username']; ?>
            </a>
            <button type="button" id="follow_<?php echo $unfollowedUser['user_id']; ?>" data-userid="<?php echo $unfollowedUser['user_id'];
                   ?>" class="btn btn-primary pull-right follow" style="margin: 5px 5px 0px 0px ; ">
                Follow
            </button>
        </li>
        <?php

        }
        ?>

    </div>


    <p><a href="logout.php" class="btn btn-danger m1-3">Signout</a></p>
</body>
<script>
    $(document).on('click', '.follow', function () {
        var userId = $(this).data("userid");
        var action = 'followUser';
        $.ajax({
            url: 'user_action.php',
            method: "POST",
            data: { userId: userId, action: action },
            dataType: "json",
            success: function (response) {
                if (response.success == 1) {
                    $("#follow_" + userId).text("Following");
                    $("#following").text(parseInt($("#following").text()) + 1);
                }
            }

        });
    });
</script>

</html>