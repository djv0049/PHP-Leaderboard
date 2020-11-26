<?php
require_once 'database.php';
require_once 'db.php';
session_start();
//require "Createdatabase.php";

$PASS = $_POST['Password'];
$user = $_POST['UserName'];
$sql = "select password, userName from User where userName = '$user';";
$hash = "";

try 
{
    $result = $db->query($sql);
    $hash = $result->fetch()['password'];
    $result = $db->query($sql);
    $username = $result->fetch()['userName'];
} catch (\Throwable $th) 
{
    $_SESSION['ErrorMessage'] = "incorrect username";
    //header("location: index.html");
    echo "no";
}
if (password_verify($PASS,$hash))
{
    $_SESSION['Logged in'] = TRUE;
    $_SESSION['User'] = $user;
    header('location: leaderboardpage.php');
    echo $_SESSION['User'];
}
else
{
    $_SESSION['ErrorMessage'] = "incorrect username or password";
    //header("location: index.html");
    echo "no for password";
} 

function check_ini(){
    $settings = parse_ini_file("settings.ini",true);
    if($settings['website']['type'] == 'gaming') 
    {
        
    }
    else
    {

    }
}
 
?>