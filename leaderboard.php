<!DOCTYPE html>
<html lang="en">
<head>
	<meta name ="Prototype Ladder">
	<meta name = "keywords" content = "Leaderboard, ladder, social, media">
    <title>social media name</title>
    <link rel="stylesheet" href="stylesheets/main-style.css">
    <?php 
    $ini = parse_ini_file("settings.ini",true);
    if($ini['website']['type'] == 'gaming') { ?> 
    <link rel="stylesheet" href="stylesheets/gaming.css">
    <?php }else {?>
    <link rel="stylesheet" href="stylesheets/hindi.css">
    <?php }?>
</head>
<body> 
    <?php
        $settings = parse_ini_file("settings.ini",true);
        $type = $settings['website']['type'];
        $lang = parse_ini_file("i18n.ini",true);
        $language = $lang[$type];
        global $nameArray;
        function sortByScore($a,$b){
            
            $a= $a['score'];
            $b = $b['score'];
            if($a == $b){
                // sort by time instead
                return 0;
            }
            return ($a > $b) ? -1: 1;
        }
        session_start();
        if(isset($_SESSION['User'])){
            echo $_SESSION['User']. $language['login'];
        }
    ?>

    <div id = "page">
        <header>
            <?php echo "<h1>".$language['Title']."</h1>"; ?>
        </header>
        <nav>
            
        </nav>
        <main>
            <div id="leaderboard">
                <div class ="topBar">
                    <div class="filters">
                        <?php echo "<p>".$language['filter']."</p>"?>
                        <select name="Country">
                            <optgroup label="Country">
                                <option value="NZL">NZ</option>
                                <option value="AUS">Australia</option>
                            </optgroup>
                        </select>
                        <select>
                        <optgroup label="Date" multiple="multiple">
                                <option value="Week">This Week</option>
                                <option value="Month">This Month</option>
                                <option value="Year">This Year</option>
                                <option value="All">All Time</option>
                            </optgroup>
                        </select>
                    </div>
                    <button style="margin:0.5rem;"><?php echo $language['add']?></button>
                </div>
                <div class="col">
                    <div id="titleRow" class="scoreEntry">
                      <p class="rank"><?php echo $language['rank']?></p>
                      <p class="profilePic"><?php echo $language['pic']?></p>
                      <p class="name"><?php echo $language['name']?></p>
                      <p class="country"><?php echo $language['country']?></p>
                      <p class="date"><?php echo $language['date']?></p>
                      <p class="score"><?php echo $language['score']?></p>
                    </div>
                <?php 
                    require "databasefunctions.php";
                    $allscores = getAllScores();
                    $allresults = array();
                    while ($row = $allscores->fetch()  ){
                        $currentScores = array();
                        $currentScores['name']  = $row['userName'];
                        $currentScores['country'] = $row['country'];
                        $currentScores['score'] = $row['score'];
                        $currentScores['date'] = $row['date'];
                        array_push($allresults, $currentScores);
                    }     

                    uasort($allresults,'sortByScore');
                    $rank = 1;
                    $img = '';
                    foreach ($allresults as $result) {
                        echo "<div class=\"scoreEntry\" >";
                        echo "<p class = \"rank\">".$rank."</p>";
                        echo "<p class = \"profilePic\">".$img."</p>";
                        foreach ($result as $key => $value) {
                        echo "<p class = \"".$key."\">".$value."</p>";
                        }
                        $rank++;
                        echo " </div>";
                    }
                    echo "<div class=\"loadMore\"><button>".$language['load']."</button></div>";
                ?>
                </div>
                
            </div>
            
           
        </main>
    </div>
</body>
</html>
<?php  /* 

USE THIS FOR DISPLAYING ALL RESULTS FROM ARRAY ONCE GOTTEN  FROM DATABASE
$result = "<tr><td>$row[ordernum]</td>";
    $result .= "<td>$row[productCode]</td>";
    $result .= "<td>$row[productname]</td>";
    $result .= "<td>$row[quantity]</td>";
    $result .= "<td>$row[price]</td></tr>";
    echo $result;





/*
<div id="scoreSubmit">
    <form action="/results.php" method ="POST">
        <label for="UserName">User name:</label><br>
        <input type="text" id="UserName" name="UserName" value="John"><br>
        <label for="Score">Last name:</label><br>
        <input type="Number" id="Score" name="Score" value=0><br><br>
        <input type="submit" value="Submit">
    </form> 
</div>
*/ ?>