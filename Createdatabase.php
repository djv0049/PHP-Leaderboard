

<?php
require_once 'database.php';
require_once 'db.php';
$db->selectDatabase();
session_destroy();



//$2y$10$pFKDAdTEmb3LVxYzM.KWbu9TWgx1u1nVfk6zuhEzox2OsFSgkqWB6

/*
 CODE TO CREATE THE DATABASE
*/


//drop database player_leaderboard;
$sql = "drop table if exists Score;";
$result = $db->query($sql);
$sql = "drop table if exists XpGained;";
$result = $db->query($sql);
$sql = "drop table if exists UserProfile;";
$result = $db->query($sql);
$sql = "drop table if exists User;";
$result = $db->query($sql);
$sql = "drop table if exists Country;";
$result = $db->query($sql);
$sql = "drop table if exists ScoreDate;";
$result = $db->query($sql);



// create database

    $sql = "create database if not exists player_leaderboard;";
    $result = $db->query($sql);
    $sql = "use player_leaderboard;";
    $result = $db->query($sql);

// cerate tables
    
    $sql = "create table if not exists ScoreDate(
        id varchar(8) primary key not null,
        day int(2) not null,
        month int(2) not null,
        year int(4) not null
    );";
    $result = $db->query($sql);

    $sql = "create table if not exists Country(
        code varchar(3) primary key,
        countryName varchar(56)
    );";
    $result = $db->query($sql);

    $sql = "create table if not exists User(
        id smallint primary key not null,
        userName varchar(15),
        country varchar(3),
        email varchar(31),
        password VARCHAR(100)
    );";
    /*,
        foreign key(country) references Country(code)
    */
    $result = $db->query($sql);

    $sql = "create table if not exists UserProfile (
        profileType varchar(7) not null, 
        userId smallint not null ,
        highScore int ,
        primary key(userId, profileType) 
    );";
    // -- composite primary key of userId and profile type
    $result = $db->query($sql);



    $sql = "create table if not exists Score(
        id int auto_increment primary key,
        profileId smallint not null,
        profileType varchar(7) not null,
        score int not null,
        dateId varchar(8) not null
    )engine = innodb;";
    $result = $db->query($sql);


    $sql = "create table if not exists XpGained(
        id int auto_increment primary key,
        profileId smallint not null,
        profileType varchar(7) not null,
        amountGained Int not null, 
        dateId varchar(8) not null
    );";
    $result = $db->query($sql);

    /*
CONSTRAINT `fk_book_author`
    FOREIGN KEY (author_id) REFERENCES author (id)
    */

// change query 

    $sql = "ALTER TABLE Score add constraint foreign key (profileId,profileType) references UserProfile (userId, profileType);";
    $result = $db->query($sql);
    $sql = "alter table XpGained add constraint foreign key (profileId,profileType) references UserProfile (userId, profileType);";
    $result = $db->query($sql);
    $sql = "alter table xpGained add constraint foreign key (dateId) references ScoreDate(id);";
    $result = $db->query($sql);
    $sql = "alter table Score add constraint foreign key (dateId) references ScoreDate (id);  ";
    $result = $db->query($sql);


// insert data
          //insert into ScoreDate values(27112020, 27, 11, 2020 );
    $sql = "insert into ScoreDate values(11102020, 11,  10, 2020 );";
    $result = $db->query($sql);
    $sql = "insert into ScoreDate values(12102020, 12,  10, 2020 );";
    $result = $db->query($sql);

    $sql = "insert into Country values(\"NZ\", \"new zealand\");";
    $result = $db->query($sql);
    $sql = "insert into Country values(\"AUS\", \"Australia\");";
    $result = $db->query($sql);

    $sql = "insert into User values(1, \"Daniel\", \"NZ\", \"dan@ara.com\",'\$2y\$10\$pFKDAdTEmb3LVxYzM.KWbu9TWgx1u1nVfk6zuhEzox2OsFSgkqWB6');";
    $result = $db->query($sql);
    $sql = "insert into User values(2, \"Matt\", \"AUS\", \"matt@ara.com\",'\$2y\$10\$pFKDAdTEmb3LVxYzM.KWbu9TWgx1u1nVfk6zuhEzox2OsFSgkqWB6');";
    $result = $db->query($sql);

    $sql = "insert into UserProfile values(\"gaming\", 1, 12);";
    $result = $db->query($sql);
    $sql = "insert into UserProfile values(\"hindi\", 1, 12);";
    $result = $db->query($sql);
    $sql = "insert into UserProfile values(\"gaming\", 2, 19);";
    $result = $db->query($sql);
    $sql = "insert into UserProfile values(\"hindi\", 2, 19);";
    $result = $db->query($sql);

    $sql = "insert into Score values(null, 1, \"gaming\", 8, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 1, \"gaming\", 9, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 2, \"gaming\", 12, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 2, \"gaming\", 118, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 2, \"gaming\", 2, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 2, \"gaming\", 4, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 1, \"gaming\", 81, 11102020);";
    $result = $db->query($sql);
    $sql = "insert into Score values(null, 1, \"gaming\", 91, 11102020);";
    $result = $db->query($sql);


    $sql = "insert into XpGained values(null, 2, \"hindi\", 19, 12102020);";
    $result = $db->query($sql);



// SIMPLE QUERY 

    $sql = "SELECT * FROM Score;";
    $result = $db->query($sql); 


// COMPLEX QUERY

    $sql = "select * from score 
    join UserProfile on score.profileId = UserProfile.userId and score.profileType = UserProfile.profileType
    join User on UserProfile.userId = User.id
    join country on country.code = user.country
    where country = \"Nz\";";
    $result = $db->query($sql);


header('location: index.html');