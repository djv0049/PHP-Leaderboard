<?php 
require "database.php";
require "db.php";
$GLOBALS['database'] = $db;
$GLOBALS['type'] =  parse_ini_file("settings.ini",true)['website']['type'];
function getAllScores()
{
   
    if($GLOBALS['type']  == 'gaming')
    {
    $sql = "select userName, country, score, concat(day,'/',  month,'/',  year) as date from User, userprofile, scoredate, score
    where user.id = userprofile.userid 
    and userid = score.profileId and userProfile.profileType = score.profileType and scoredate.id = dateId
    ";
    }
    else if ($GLOBALS['type'] == 'hindi')
    {
        $sql = "select userName, country, amountGained, concat(day,'/',  month,'/',  year) as date from User, userprofile, scoredate, xpgained
        where user.id = userprofile.userid 
        and userid = xpgained.profileId and userProfile.profileType = xpgained.profileType and scoredate.id = dateId
        ";
    }
    return $GLOBALS['database']->query($sql);
}

function insertScore($score){
    
    if(isset($_SESSION['User']))
    {
        $date = date("dmY");
        $day = substr ( $date, 0 , 2 );
        $month = substr ( $date, 2 , 2 );
        $year =  substr ( $date, 4 , 4 );

        //echo "<script>alert('$date!');
        //var result = prompt('Enter your score');</script>";
        $sql = "use player_leaderboard;";
        $result = $GLOBALS['database']->query($sql);
        $name = $_SESSION['User'];
        if($GLOBALS['type'] == 'gaming')
        {
            $sql = "select id from scoredate where id = ".$date;
            $result = $GLOBALS['database']->query($sql);
            if(!$result->fetch())
            {
                $sql = "insert into ScoreDate values(31102020, 11, 10, 2020 );";
                $result = $GLOBALS['database']->query($sql);
                $sql = "insert into ScoreDate values(".$date.", ".$day.", ".$month.", ".$year.");";
                $GLOBALS['database']->query($sql);
            }
            // get user id
            $sql = "select id from user where userName = '".$name."';";
            $user = $GLOBALS['database']->query($sql)->fetch()['id'];
            echo $user;
            // get score type
            // if($GLOBALS['type'] == 'gaming')
            // {
            //     $type = 1;
            // }
            // else{
            //     $type = 2;
            // }

            //insert statement
            $sql = "insert into score values(null,".$user ." ,'" . $GLOBALS['type'] ."',".strval($score).",".strval($date).");";
            var_dump($GLOBALS['database']->query($sql));


        }
        
    
    }
    else 
    {
        echo "<script>alert('You need to log in to submit a score!');</script>";
    }


}