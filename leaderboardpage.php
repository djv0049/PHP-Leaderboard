<!DOCTYPE html>
<html lang="en">
<head>
	<meta name ="Prototype Ladder">
	<meta name = "keywords" content = "Leaderboard, ladder, social, media">
    <title>social media name</title>
    <link rel="stylesheet" href="stylesheets/main-style.css">
    <?php 
    include 'leaderboard.php';
    $lb = new Leaderboard();
    if($lb->settings['website']['type'] == 'gaming') { ?> 
    <link rel="stylesheet" href="stylesheets/gaming.css">
    <?php }else {?>
    <link rel="stylesheet" href="stylesheets/hindi.css">
    <?php }?>
</head>
<body> 
    <?php
        $lb->displayLoggedInUser();
    ?>
    

    <div id = "page">
        <header>
            <?php echo "<h1>".$lb->language['Title']."</h1>"; ?>
        </header>
        <nav>
            
        </nav>
        <main>
            <div id="leaderboard">
                <div class ="topBar">
                    <div class="filters">
                        <?php echo "<p>".$lb->language['filter']."</p>"?>
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
                    <form method="post"> 
                        <input style="margin:0.5rem;" type="submit" name="sortasc"
                                class="button" value="<?php echo $lb->language['sort']?>" /> 
                        <input style="margin:0.5rem;" type="submit" name="sortdesc"
                                class="button" value="<?php echo $lb->language['sortdesc']?>" /> 
                        <input style="margin:0.5rem;" type="submit" name="add"
                                class="button" value="<?php echo $lb->language['add']?>" /> 
                                <input type = "text" name = "newscore">
                    </form> 
                    
                </div>
                <div class="col">
                    <div id="titleRow" class="scoreEntry">
                      <p class="rank"><?php echo $lb->language['rank']?></p>
                      <p class="profilePic"><?php echo $lb->language['pic']?></p>
                      <p class="name"><?php echo $lb->language['name']?></p>
                      <p class="country"><?php echo $lb->language['country']?></p>
                      <p class="date"><?php echo $lb->language['date']?></p>
                      <p class="score"><?php echo $lb->language['score']?></p>
                    </div>
                    
                <?php 
                    
                    if(array_key_exists('sortasc', $_POST)) 
                    { 
                        $lb->sortAsc();
                    } 
                    else if(array_key_exists('sortdesc', $_POST)) 
                    { 
                        $lb->sortDesc();
                    } 
                    else if(array_key_exists('load', $_POST)) 
                    { 
                        $lb->loadMore(); 
                    } 
                    else if(array_key_exists('less', $_POST))
                     { 
                        $lb->loadLess(); 
                    } 
                    else
                    {
                        $lb->sortAsc();
                    }
                    if(array_key_exists('add', $_POST))// || array_key_exists('newscore',$_POST)) 
                    { 
                        $lb->addScore(); 
                    } 
                    
                    ?>
                </div>
                
            </div>
            
           
        </main>
    </div>
</body>
</html>
<?php  /* 




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