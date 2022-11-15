<?php if (!empty($_POST['action']) && $_POST['action'] == 'followUser') {
    $user->followUserId = $_POST["userId"];
    $user->followUser();
}

?>