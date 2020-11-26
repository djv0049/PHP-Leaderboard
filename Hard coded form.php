
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name ="Prototype Ladder">
	<meta name = "keywords" content = "Leaderboard, ladder, social, media">
    <title>social media name</title>
    <link rel="stylesheet" href="stylesheets/main-style.css">
    <link rel="stylesheet" href="stylesheets/flair.css">
</head>
<body>
    
    <div id = "page">
        <header>
            <h1>Leaderboard!!</h1>
        </header>
        <nav>
            List of nav related stuff here 
        </nav>
        <main>
            <div id="leaderboard">
                <div class ="topBar">
                    <div class="filters">
                        <p>Filter by:</p>
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
                    <button style="margin:0.5rem;">Add</button>
                </div>
                <div class="col">
                    <div id="titleRow" class="scoreEntry">
                      <p class="rank">Rank</p>
                      <p class="profilePic"></p>
                      <p class="name">Name</p>
                      <p class="country">Country</p>
                      <p class="date">Date</p>
                      <p class="score">Score</p>
                    </div>
                <div class="scoreEntry" style="background-color:#334499;">
                                    <p class="rank">1</p>
                                    <p class="profilePic">img</p>
                                    <p class="name">Luofeng</p>
                                    <p class="country">NZ</p>
                                    <p class="date">Today</p>
                                    <p class="score">9001</p>
                                </div>
                                <div class="scoreEntry" style="background-color:#334477;">
                                    <p class="rank">2</p>
                                    <p class="profilePic">img</p>
                                    <p class="name">Tilly</p>
                                    <p class="country">NZ</p>
                                    <p class="date">Today</p>
                                    <p class="score">1234</p>
                                </div>
                                <div class="scoreEntry" style="background-color:#334499;">
                                    <p class="rank">3</p>
                                    <p class="profilePic">img</p>
                                    <p class="name">Dan</p>
                                    <p class="country">NZ</p>
                                    <p class="date">Today</p>
                                    <p class="score">405</p>
                                </div>
                                <div class="scoreEntry" style="background-color:#334477;">
                                    <p class="rank">4</p>
                                    <p class="profilePic">img</p>
                                    <p class="name">Matt</p>
                                    <p class="country">NZ</p>
                                    <p class="date">Today</p>
                                    <p class="score">403</p>
                                </div>
                                <div class="scoreEntry" style="background-color:#334499;">
                                    <p class="rank">5</p>
                                    <p class="profilePic">img</p>
                                    <p class="name">Amit</p>
                                    <p class="country">NZ</p>
                                    <p class="date">Today</p>
                                    <p class="score">401</p>
                                </div>
                                <div class="loadMore"><button>Load next 5</button></div>
                </div>
            </div>
            <div id="scoreSubmit">
                <form action="/results.php" method ="POST">
                    <label for="UserName">User name:</label><br>
                    <input type="text" id="UserName" name="UserName" value="Dan"><br>
                    <label for="Score">Last name:</label><br>
                    <input type="Number" id="Score" name="Score" value=0><br><br>
                    <input type="submit" value="Submit">
                </form> 
            </div>
        </main>
    </div>
</body>
</html>