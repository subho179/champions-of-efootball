<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';


// GET SETTINGS

$settings = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT * FROM tournament_settings WHERE id=1")

);

$playoff_spots = $settings['playoff_spots'];




// GENERATE PLAYOFFS

if(isset($_POST['generate_playoffs'])){


    // CLEAR OLD PLAYOFFS

    mysqli_query($conn,
    "TRUNCATE TABLE playoff_matches");



    // GET TOP PLAYERS

    $teams = [];

    $query = mysqli_query($conn,

    "SELECT standings.*,
            players.player_name

    FROM standings

    JOIN players
    ON standings.player_id = players.id

    ORDER BY
    points DESC,
    goal_difference DESC,
    goals_for DESC

    LIMIT $playoff_spots"

    );


    while($row = mysqli_fetch_assoc($query)){

        $teams[] = $row;

    }



    // TOP 2 FORMAT

    if($playoff_spots == 2){

        createSeries(
            "final",
            1,
            $teams[0]['player_id'],
            $teams[1]['player_id'],
            $conn
        );

    }



    // TOP 4 FORMAT

    elseif($playoff_spots == 4){

        createSeries(
            "semi",
            1,
            $teams[0]['player_id'],
            $teams[3]['player_id'],
            $conn
        );

        createSeries(
            "semi",
            2,
            $teams[1]['player_id'],
            $teams[2]['player_id'],
            $conn
        );

    }



    // TOP 8 FORMAT

    elseif($playoff_spots == 8){

        createSeries(
            "quarter",
            1,
            $teams[0]['player_id'],
            $teams[7]['player_id'],
            $conn
        );

        createSeries(
            "quarter",
            2,
            $teams[1]['player_id'],
            $teams[6]['player_id'],
            $conn
        );

        createSeries(
            "quarter",
            3,
            $teams[2]['player_id'],
            $teams[5]['player_id'],
            $conn
        );

        createSeries(
            "quarter",
            4,
            $teams[3]['player_id'],
            $teams[4]['player_id'],
            $conn
        );

    }


    header("Location: playoffs.php");

}




// CREATE BO3 SERIES FUNCTION

function createSeries(
    $stage,
    $series_group,
    $home,
    $away,
    $conn
){

    for($i = 1; $i <= 3; $i++){

        mysqli_query($conn,

        "INSERT INTO playoff_matches

        (stage, series_group, match_no,
         home_player_id, away_player_id)

        VALUES

        ('$stage', '$series_group', '$i',
         '$home', '$away')"

        );

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Playoffs</title>

    <link rel="stylesheet"
          href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:30px;
            font-size:38px;
        }

        .generate-btn{
            background:#ff9900;
            color:black;
            border:none;
            padding:15px 24px;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
            margin-bottom:30px;
        }

        .generate-btn:hover{
            background:#ffb733;
        }

        .series-box{
            background:#171717;
            padding:25px;
            border-radius:18px;
            margin-bottom:25px;
        }

        .series-title{
            color:#ff9900;
            margin-bottom:20px;
            font-size:24px;
        }

        .match{
            padding:15px;
            background:#1f1f1f;
            border-radius:10px;
            margin-bottom:12px;
        }

        .winner{
            color:#4dff88;
            font-weight:bold;
        }

    </style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<div class="main-content">

<?php include __DIR__ . '/../includes/topbar.php'; ?>

<div class="content">

<h1 class="page-title">
🏆 Playoffs
</h1>


<!-- GENERATE BUTTON -->

<form method="POST">

<button type="submit"
        name="generate_playoffs"
        class="generate-btn">

⚡ Generate Playoffs

</button>

</form>



<?php

$series = mysqli_query($conn,

"SELECT playoff_matches.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM playoff_matches

JOIN players p1
ON playoff_matches.home_player_id = p1.id

JOIN players p2
ON playoff_matches.away_player_id = p2.id

ORDER BY stage, series_group, match_no"

);


$current = "";

while($row = mysqli_fetch_assoc($series)){

    $series_name =
    strtoupper($row['stage'])
    ." #"
    .$row['series_group'];



    if($current != $series_name){

        if($current != ""){

            echo "</div>";

        }

        echo "<div class='series-box'>";

        echo "<div class='series-title'>
              $series_name
              </div>";

        $current = $series_name;

    }

?>

<div class="match">

Game <?php echo $row['match_no']; ?>

—

<?php echo $row['home_player']; ?>

vs

<?php echo $row['away_player']; ?>

<?php

if($row['match_status'] == 'completed'){

    echo "<br><br>";

    echo "<span class='winner'>";

    echo $row['home_score']
    ." - "
    .$row['away_score'];

    echo "</span>";

}

?>

</div>

<?php } ?>

</div>

</div>
</div>

</body>
</html>