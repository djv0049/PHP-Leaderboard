<?php 
require "database.php";
require "db.php";
$GLOBALS['database'] = $db;
function getAllScores(){
    $sql = "select userName, country, score, concat(day,'/',  month,'/',  year) as date from User, userprofile, scoredate, score
    where user.id = userprofile.userid 
    and userid = score.profileId and userProfile.profileType = score.profileType and scoredate.id = dateId
    ";
    return $GLOBALS['database']->query($sql);
}

function addScore($score){
    $date = date("Y-m-d");
}