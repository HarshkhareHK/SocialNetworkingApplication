<?php
class user
{
    public function followUser()
    {
        if ($_SESSION["user_id"] && $this->followUserId) {
            $sqlQuery = "INSERT INTO" . $this->followTable . "('follower_id', 'followed_user_id') VALUES(?,?)";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param("ii", $_SESSION["user_id"], $this->followUserId);
            if ($stmt->execute()) {
                $output = array("success" => 1);
                echo json_encode($output);
            }
        }
    }
}
?>