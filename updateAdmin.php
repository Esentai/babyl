<?php
require "Database.php";
require "User.php";
session_start();
$db = new Database();
$conn = $db->connect();

if ($_SERVER['REQUEST_METHOD'] = 'POST'){
    if (isset($_POST['search'])){
        $req = $_POST['search'];
        $sql = "SELECT user_id , user_name , email FROM users WHERE user_name LIKE ? AND isAdmin = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s" , $req);
        $stmt->execute();
        $res = $stmt->get_result();

        $result = array();
        while($row = $res->fetch_assoc()){
            array_push($result,$row);
        }
        echo json_encode($result);
    } else {
        $id = $_POST['id'];
        $sql = 'UPDATE users SET users.isAdmin = 1 WHERE user_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("d",$id);
        if($stmt->execute()) header("location: index.php");
        else echo "Something wend wrong";

    }

}