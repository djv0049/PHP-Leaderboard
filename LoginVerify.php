<?php
session_start();
require "Createdatabase.php";

$PASS = $_POST['Password'];
$user = $_POST['UserName'];
$sql = "select password, userName from User where userName = '$user';";
$hash = "";

try {
    $result = $db->query($sql);
    $hash = $result->fetch()['password'];
    $result = $db->query($sql);
    $username = $result->fetch()['userName'];
} catch (\Throwable $th) {
    $_SESSION['ErrorMessage'] = "incorrect username";
    header("location: index.html");
    echo "no";
}
if (password_verify($PASS,$hash)){
    $_SESSION['Logged in'] = TRUE;
    $_SESSION['User'] = $user;
    header('location: leaderboard.php');
    echo $_SESSION['User'];
}
else{
    $_SESSION['ErrorMessage'] = "incorrect username or password";
    header("location: index.html");
    echo "no for password";
} 
 
?>