<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';




// SUBMIT PLAYOFF RESULT

if(isset($_POST['submit_result'])){

    $match_id = $_POST['match_id'];

    $home_score = $_POST['home_score'];

    $away_score = $_POST['away_score'];



    // GET MATCH

    $match = mysqli_fetch_assoc(

    mysqli_query($conn,

    "SELECT * FROM playoff_matches
     WHERE id='$match_id'")

    );



    $winner_id = null;

    if($home_score > $away_score){

        $winner_id = $match['home_player_id'];

    }

    elseif($away_score > $home_score){

        $winner_id = $match['away_player_id'];

    }



    // UPDATE MATCH

    mysqli_query($conn,

    "UPDATE playoff_matches SET

    home_score='$home_score',
    away_score='$away_score',
    winner_id='$winner_id',
    match_status='completed'

    WHERE id='$match_id'"

    );



    // SERIES INFO

    $stage = $match['stage'];

    $series_group = $match['series_group'];



    // COUNT WINS

    $wins = [];

    $series_matches = mysqli_query($conn,

    "SELECT * FROM playoff_matches

    WHERE stage='$stage'
    AND series_group='$series_group'
    AND match_status='completed'"

    );



    while($m = mysqli_fetch_assoc($series_matches)){

        if($m['winner_id']){

            if(!isset($wins[$m['winner_id']])){

                $wins[$m['winner_id']] = 0;

            }

            $wins[$m['winner_id']]++;

        }

    }



    // CHECK SERIES WINNER

    foreach($wins as $player => $count){

        if($count >= 2){

            advanceWinner(
                $player,
                $stage,
                $series_group,
                $conn
            );
        }

    }



    header("Location: playoff-results.php");

}





// ADVANCE FUNCTION

function advanceWinner(
    $winner_id,
    $stage,
    $series_group,
    $conn
){

    // SEMI → FINAL

    if($stage == 'semi'){


        // CHECK IF FINAL EXISTS

        $check = mysqli_num_rows(

        mysqli_query($conn,

        "SELECT * FROM playoff_matches
         WHERE stage='final'")

        );


        if($check == 0){

            // STORE TEMPORARY WINNER

            mysqli_query($conn,

            "INSERT INTO playoff_matches

            (stage, series_group, match_no,
             home_player_id)

            VALUES

            ('final', 1, 1, '$winner_id')"

            );

        }

        else{

            // UPDATE FINAL OPPONENT

            $final = mysqli_fetch_assoc(

            mysqli_query($conn,

            "SELECT * FROM playoff_matches
             WHERE stage='final'
             LIMIT 1")

            );



            $home = $final['home_player_id'];



            // DELETE TEMP FINAL

            mysqli_query($conn,

            "DELETE FROM playoff_matches
             WHERE stage='final'"

            );



            // CREATE FULL BO3 FINAL

            for($i = 1; $i <= 3; $i++){

                mysqli_query($conn,

                "INSERT INTO playoff_matches

                (stage, series_group, match_no,
                 home_player_id, away_player_id)

                VALUES

                ('final', 1, '$i',
                 '$home', '$winner_id')"

                );

            }

        }

    }




    // QUARTER → SEMI

    elseif($stage == 'quarter'){


        $semi_group =
        ($series_group <= 2) ? 1 : 2;



        $existing = mysqli_query($conn,

        "SELECT * FROM playoff_matches

        WHERE stage='semi'
        AND series_group='$semi_group'

        LIMIT 1"

        );



        if(mysqli_num_rows($existing) == 0){

            mysqli_query($conn,

            "INSERT INTO playoff_matches

            (stage, series_group, match_no,
             home_player_id)

            VALUES

            ('semi', '$semi_group', 1,
             '$winner_id')"

            );

        }

        else{

            $semi = mysqli_fetch_assoc($existing);

            $home = $semi['home_player_id'];



            mysqli_query($conn,

            "DELETE FROM playoff_matches

            WHERE stage='semi'
            AND series_group='$semi_group'"

            );



            for($i = 1; $i <= 3; $i++){

                mysqli_query($conn,

                "INSERT INTO playoff_matches

                (stage, series_group, match_no,
                 home_player_id, away_player_id)

                VALUES

                ('semi', '$semi_group', '$i',
                 '$home', '$winner_id')"

                );

            }

        }

    }




    // FINAL → CHAMPION

    elseif($stage == 'final'){


        mysqli_query($conn,

        "UPDATE tournament_settings SET

        champion_id='$winner_id'

        WHERE id=1"

        );

    }

}

?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Playoff Results
</title>

<link rel="stylesheet"
      href="../includes/layout.css">

<style>

.page-title{
    color:#ff9900;
    margin-bottom:30px;
    font-size:38px;
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
    background:#1f1f1f;
    padding:18px;
    border-radius:12px;
    margin-bottom:15px;
}

.score-input{
    width:70px;
    padding:10px;
    background:#222;
    border:1px solid #333;
    border-radius:8px;
    color:white;
    text-align:center;
}

.submit-btn{
    background:#ff9900;
    color:black;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

.completed{
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
🏆 Playoff Results
</h1>



<?php

$series = mysqli_query($conn,

"SELECT playoff_matches.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM playoff_matches

LEFT JOIN players p1
ON playoff_matches.home_player_id = p1.id

LEFT JOIN players p2
ON playoff_matches.away_player_id = p2.id

ORDER BY stage, series_group, match_no"

);


$current = "";

while($row = mysqli_fetch_assoc($series)){

    $title =
    strtoupper($row['stage'])
    ." #"
    .$row['series_group'];



    if($current != $title){

        if($current != ""){

            echo "</div>";

        }

        echo "<div class='series-box'>";

        echo "<div class='series-title'>
              $title
              </div>";

        $current = $title;

    }

?>

<div class="match">

<strong>

Game <?php echo $row['match_no']; ?>

</strong>

<br><br>

<?php echo $row['home_player']; ?>

VS

<?php echo $row['away_player']; ?>

<br><br>


<?php

if($row['match_status'] == 'pending'){

?>

<form method="POST">

<input type="hidden"
       name="match_id"
       value="<?php echo $row['id']; ?>">


<input type="number"
       name="home_score"
       class="score-input"
       required>

-

<input type="number"
       name="away_score"
       class="score-input"
       required>


<button type="submit"
        name="submit_result"
        class="submit-btn">

Submit

</button>

</form>

<?php } else { ?>

<div class="completed">

<?php echo $row['home_score']; ?>

-

<?php echo $row['away_score']; ?>

✅ Completed

</div>

<?php } ?>

</div>

<?php } ?>

</div>

</div>

</body>
</html>