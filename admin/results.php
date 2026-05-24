<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';


// SUBMIT RESULT
if(isset($_POST['submit_result'])){

    $fixture_id = $_POST['fixture_id'];

    $home_score = $_POST['home_score'];
    $away_score = $_POST['away_score'];

    // UPDATE FIXTURE

    mysqli_query($conn,

    "UPDATE fixtures SET

    home_score='$home_score',
    away_score='$away_score',
    match_status='completed'

    WHERE id='$fixture_id'

    ");




    // RESET STANDINGS

    mysqli_query($conn,

    "UPDATE standings SET

    played = 0,
    wins = 0,
    draws = 0,
    losses = 0,
    goals_for = 0,
    goals_against = 0,
    goal_difference = 0,
    points = 0

    ");




    // GET ALL COMPLETED MATCHES

    $matches = mysqli_query($conn,

    "SELECT * FROM fixtures
     WHERE match_status='completed'"

    );



    while($match = mysqli_fetch_assoc($matches)){

        $home_id = $match['home_player_id'];
        $away_id = $match['away_player_id'];

        $home_goals = $match['home_score'];
        $away_goals = $match['away_score'];



        // PLAYED

        mysqli_query($conn,

        "UPDATE standings SET played = played + 1
         WHERE player_id='$home_id'"

        );

        mysqli_query($conn,

        "UPDATE standings SET played = played + 1
         WHERE player_id='$away_id'"

        );



        // GOALS

        mysqli_query($conn,

        "UPDATE standings SET

        goals_for = goals_for + $home_goals,
        goals_against = goals_against + $away_goals

        WHERE player_id='$home_id'"

        );



        mysqli_query($conn,

        "UPDATE standings SET

        goals_for = goals_for + $away_goals,
        goals_against = goals_against + $home_goals

        WHERE player_id='$away_id'"

        );



        // RESULTS

        if($home_goals > $away_goals){

            // HOME WIN

            mysqli_query($conn,

            "UPDATE standings SET

            wins = wins + 1,
            points = points + 3

            WHERE player_id='$home_id'"

            );



            mysqli_query($conn,

            "UPDATE standings SET

            losses = losses + 1

            WHERE player_id='$away_id'"

            );

        }


        elseif($home_goals < $away_goals){

            // AWAY WIN

            mysqli_query($conn,

            "UPDATE standings SET

            wins = wins + 1,
            points = points + 3

            WHERE player_id='$away_id'"

            );



            mysqli_query($conn,

            "UPDATE standings SET

            losses = losses + 1

            WHERE player_id='$home_id'"

            );

        }


        else{

            // DRAW

            mysqli_query($conn,

            "UPDATE standings SET

            draws = draws + 1,
            points = points + 1

            WHERE player_id='$home_id'"

            );



            mysqli_query($conn,

            "UPDATE standings SET

            draws = draws + 1,
            points = points + 1

            WHERE player_id='$away_id'"

            );

        }



        // GOAL DIFFERENCE

        mysqli_query($conn,

        "UPDATE standings SET

        goal_difference = goals_for - goals_against"

        );

    }



    header("Location: results.php");

}

?>
<!DOCTYPE html>
<html>

<head>

    <title>COE Results System</title>

    <link rel="stylesheet" href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:30px;
            font-size:38px;
        }

        .table-container{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#171717;
            border-radius:15px;
            overflow:hidden;
        }

        table th{
            background:#ff9900;
            color:black;
            padding:18px;
        }

        table td{
            padding:18px;
            text-align:center;
            border-bottom:1px solid #2b2b2b;
        }

        table tr:hover{
            background:#1f1f1f;
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
            font-weight:bold;
            cursor:pointer;
        }

        .submit-btn:hover{
            background:#ffb733;
        }

        .completed{
            color:#4dff88;
            font-weight:bold;
        }

        .pending{
            color:#ffcc00;
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
            ⚽ Results Management
        </h1>


        <div class="table-container">

            <table>

                <tr>

                    <th>ID</th>
                    <th>Round</th>
                    <th>Match</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

                <?php

                $fixtures = mysqli_query($conn,

                "SELECT fixtures.*,

                p1.player_name AS home_player,
                p2.player_name AS away_player

                FROM fixtures

                JOIN players p1
                ON fixtures.home_player_id = p1.id

                JOIN players p2
                ON fixtures.away_player_id = p2.id

                ORDER BY round_no ASC"

                );



                while($row = mysqli_fetch_assoc($fixtures)){

                ?>

                <tr>

                    <td>
                        <?php echo $row['id']; ?>
                    </td>

                    <td>
                        Round <?php echo $row['round_no']; ?>
                    </td>

                    <td>

                        <?php echo $row['home_player']; ?>

                        VS

                        <?php echo $row['away_player']; ?>

                    </td>

                    <td>

                        <?php

                        if($row['match_status'] == 'completed'){

                            echo $row['home_score']
                            ." - ".
                            $row['away_score'];

                        }

                        else{

                        ?>

                        <form method="POST"
                              style="display:flex;
                                     justify-content:center;
                                     align-items:center;
                                     gap:10px;">

                            <input type="hidden"
                                   name="fixture_id"
                                   value="<?php echo $row['id']; ?>">


                            <input type="number"
                                   name="home_score"
                                   class="score-input"
                                   required>


                            <span>-</span>


                            <input type="number"
                                   name="away_score"
                                   class="score-input"
                                   required>

                    </td>

                    <td>

                        <span class="pending">

                            Pending

                        </span>

                    </td>

                    <td>

                        <button type="submit"
                                name="submit_result"
                                class="submit-btn">

                            Submit

                        </button>

                        </form>

                    </td>

                    <?php } ?>


                    <?php

                    if($row['match_status'] == 'completed'){

                    ?>

                    <td>

                        <span class="completed">

                            Completed

                        </span>

                    </td>

                    <td>

                        ✅ Result Added

                    </td>

                    <?php } ?>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>