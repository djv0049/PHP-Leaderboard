<?php
require "databasefunctions.php";
class Leaderboard
{
    
    static $maxResults ;
    
    public $settings;
    
    public $type ;
    public  $language;
    public  $nameArray;
    public $allresults;
    static $sorted;
    function __construct()
    {
        if(Leaderboard::$sorted != 'descending'){
            Leaderboard::$sorted = 'ascending';
        }
        $this->allresults = $this->getResults();
        $this->settings = parse_ini_file("settings.ini",true);
        $this->type = $this->settings['website']['type'];
        $lang = parse_ini_file("i18n.ini",true);
        $this->language = $lang[$this->type];
    }


    function getResults()
    {
        $allscores = getAllScores();
        $allresults = array();
        while ($row = $allscores->fetch()  )
        {
            $currentScores = array();
            $currentScores['name']  = $row['userName'];
            $currentScores['country'] = $row['country'];
            $currentScores['score'] = $row['score'];
            $currentScores['date'] = $row['date'];
            array_push($allresults, $currentScores);
        }
        return $allresults;
    }


    function displayScores()
    {
       
        $rank = 1;
        $img = '';
        foreach ($this->allresults as $result)
        {
            if(!isset($_SESSION['maxresults'])){
                $_SESSION['maxresults'] = 5;
            }
            if($rank <= $_SESSION['maxresults'] )
            {
                echo "<div class=\"scoreEntry\" >";
                echo "<p class = \"rank\">".$rank."</p>";
                echo "<p class = \"profilePic\">".$img."</p>";
                foreach ($result as $key => $value) 
                {
                echo "<p class = \"".$key."\">".$value."</p>";
                }
                $rank++;
                echo $_SESSION['maxresults']." </div>";
            }
            if($rank > count($this->allresults))
            {
                echo "no more results";
            }
        }
        ?>
        <form method="post"> 
            <input style="margin:0.5rem;" type="submit" name="load"
                    class="button" value="<?php echo $this->language['load']?>" /> 
        </form> 
        <?php
    }

    function loadmore()
    {
        if($_SESSION['maxresults'] != 5 && !($_SESSION['maxresults'] >5)){
            echo "penis";
            $_SESSION['maxresults'] =5;
        }

        else if ($_SESSION['maxresults'] <  count($this->allresults)){
            $_SESSION['maxresults'] +=5;
        }
        
        switch(Leaderboard::$sorted){
            case 'ascending':
                $this->sortAsc();
                break;
            case 'descending':
                $this->sortDesc();
            break;
        }
    }

    function sortAsc() 
    { 
        Leaderboard::$sorted = 'ascending';
        uasort($this->allresults,array('Leaderboard','sortByAsc'));
        $this->displayScores();
    } 
    
    
    
    function sortDesc()
    {
        Leaderboard::$sorted = 'descending';
        uasort($this->allresults,array('leaderboard','sortByDesc'));
        $this->displayScores();
    }
    
    function displayLoggedInUser()
    {
        session_start();
        if(isset($_SESSION['User']))
        {
            echo $_SESSION['User']. $this->language['login'];
        }
    }
    
    static function sortByAsc($a,$b)
    {                
        $a= $a['score'];
        $b = $b['score'];
        if($a == $b)
        {
            // sort by time instead
            return 0;
        }
        return ($a > $b) ? -1: 1;
    }
    
    static function sortByDesc($a,$b)
    {
        $a= $a['score'];
        $b = $b['score'];
        if($a == $b)
        {
            return 0;
        }
        return ($a < $b) ? -1: 1;
    }

}