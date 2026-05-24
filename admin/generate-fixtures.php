<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';

// GET TOURNAMENT SETTINGS

$settings = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT * FROM tournament_settings WHERE id=1")

);

$league_type = $settings['league_type'];

$min_players = $settings['min_players'];

$max_players = $settings['max_players'];




// CLEAR OLD FIXTURES

mysqli_query($conn, "TRUNCATE TABLE fixtures");




// GET PLAYERS

$players = [];

$query = mysqli_query($conn,

"SELECT id FROM players"

);

while($row = mysqli_fetch_assoc($query)){

    $players[] = $row['id'];

}



// COUNT PLAYERS

$total_players = count($players);




// VALIDATION

if($total_players < $min_players){

    die("❌ Minimum $min_players players required.");

}


if($total_players > $max_players){

    die("❌ Maximum $max_players players allowed.");

}




// ODD PLAYER SUPPORT

if($total_players % 2 != 0){

    $players[] = "BYE";

    $total_players++;

}




// ROUND CALCULATIONS

$total_rounds = $total_players - 1;

$half = $total_players / 2;

$round = 1;




// FIRST HALF FIXTURES

for($i = 0; $i < $total_rounds; $i++){

    for($j = 0; $j < $half; $j++){

        $home = $players[$j];

        $away = $players[$total_players - 1 - $j];



        if($home != "BYE" && $away != "BYE"){

            mysqli_query($conn,

            "INSERT INTO fixtures

            (round_no, home_player_id, away_player_id)

            VALUES

            ('$round', '$home', '$away')"

            );

        }

    }



    // ROTATION SYSTEM

    $fixed = array_shift($players);

    $last = array_pop($players);

    array_unshift($players, $fixed);

    array_splice($players, 1, 0, $last);



    $round++;

}




// DOUBLE ROUND ROBIN

if($league_type == 'double'){


    $first_half = mysqli_query($conn,

    "SELECT * FROM fixtures"

    );


    while($match = mysqli_fetch_assoc($first_half)){


        $new_round = $match['round_no'] + $total_rounds;

        $home = $match['away_player_id'];

        $away = $match['home_player_id'];



        mysqli_query($conn,

        "INSERT INTO fixtures

        (round_no, home_player_id, away_player_id)

        VALUES

        ('$new_round', '$home', '$away')"

        );

    }

}




header("Location: fixtures.php");

?>