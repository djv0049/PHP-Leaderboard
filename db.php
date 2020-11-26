<?php

$host = 'localhost' ;
$dbUser ='root';
$dbPass ='';
$dbName ='player_leaderboard';
 
$db = new Database( $host, $dbUser, $dbPass, $dbName ) ;
$db->selectDatabase();
?>