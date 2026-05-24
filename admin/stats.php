<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';

error_reporting(0);


// TOP SCORER
$top_scorer = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goals_for DESC

LIMIT 1"

)

);


// MOST CONCEDED
$most_conceded = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goals_against DESC

LIMIT 1"

)

);


// BEST DEFENSE
$best_defense = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goals_against ASC

LIMIT 1"

)

);


// HIGHEST GD
$highest_gd = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goal_difference DESC

LIMIT 1"

)

);


// MOST WINS
$most_wins = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY wins DESC

LIMIT 1"

)

);


// MOST LOSSES
$most_losses = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY losses DESC

LIMIT 1"

)

);


// MOST DRAWS
$most_draws = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY draws DESC

LIMIT 1"

)

);


// HIGHEST SCORING MATCH
$highest_match = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT fixtures.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM fixtures

JOIN players p1
ON fixtures.home_player_id = p1.id

JOIN players p2
ON fixtures.away_player_id = p2.id

WHERE match_status='completed'

ORDER BY (home_score + away_score) DESC

LIMIT 1"

)

);

?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Statistics</title>

    <link rel="stylesheet" href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:35px;
            font-size:38px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:20px;
        }

        .stat-card{
            background:#171717;
            padding:25px;
            border-radius:18px;
            box-shadow:0 0 20px rgba(255,153,0,0.08);
            transition:0.3s;
        }

        .stat-card:hover{
            transform:translateY(-5px);
        }

        .stat-card h2{
            color:#ff9900;
            margin-bottom:15px;
            font-size:22px;
        }

        .player-name{
            font-size:26px;
            font-weight:bold;
            margin-bottom:10px;
        }

        .stat-value{
            color:#4dff88;
            font-size:18px;
            font-weight:bold;
        }

        .match-box{
            font-size:20px;
            font-weight:bold;
            margin-top:10px;
        }

    </style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<div class="main-content">

    <?php include __DIR__ . '/../includes/topbar.php'; ?>

    <div class="content">

        <h1 class="page-title">
            📊 Tournament Statistics
        </h1>

        <div class="stats-grid">


            <!-- TOP SCORER -->

            <div class="stat-card">

                <h2>⚽ Top Scorer</h2>

                <div class="player-name">
                    <?php echo $top_scorer['player_name']; ?>
                </div>

                <div class="stat-value">
                    Goals: <?php echo $top_scorer['goals_for']; ?>
                </div>

            </div>


            <!-- MOST CONCEDED -->

            <div class="stat-card">

                <h2>🥅 Most Conceded</h2>

                <div class="player-name">
                    <?php echo $most_conceded['player_name']; ?>
                </div>

                <div class="stat-value">
                    Goals Against: <?php echo $most_conceded['goals_against']; ?>
                </div>

            </div>


            <!-- BEST DEFENSE -->

            <div class="stat-card">

                <h2>🧱 Best Defense</h2>

                <div class="player-name">
                    <?php echo $best_defense['player_name']; ?>
                </div>

                <div class="stat-value">
                    Goals Against: <?php echo $best_defense['goals_against']; ?>
                </div>

            </div>


            <!-- HIGHEST GD -->

            <div class="stat-card">

                <h2>🔥 Highest GD</h2>

                <div class="player-name">
                    <?php echo $highest_gd['player_name']; ?>
                </div>

                <div class="stat-value">
                    GD: <?php echo $highest_gd['goal_difference']; ?>
                </div>

            </div>


            <!-- MOST WINS -->

            <div class="stat-card">

                <h2>🏅 Most Wins</h2>

                <div class="player-name">
                    <?php echo $most_wins['player_name']; ?>
                </div>

                <div class="stat-value">
                    Wins: <?php echo $most_wins['wins']; ?>
                </div>

            </div>


            <!-- MOST LOSSES -->

            <div class="stat-card">

                <h2>😬 Most Losses</h2>

                <div class="player-name">
                    <?php echo $most_losses['player_name']; ?>
                </div>

                <div class="stat-value">
                    Losses: <?php echo $most_losses['losses']; ?>
                </div>

            </div>


            <!-- MOST DRAWS -->

            <div class="stat-card">

                <h2>🤝 Most Draws</h2>

                <div class="player-name">
                    <?php echo $most_draws['player_name']; ?>
                </div>

                <div class="stat-value">
                    Draws: <?php echo $most_draws['draws']; ?>
                </div>

            </div>


            <!-- HIGHEST SCORING MATCH -->

            <div class="stat-card">

                <h2>🎯 Highest Scoring Match</h2>

                <div class="match-box">

                    <?php

                    echo $highest_match['home_player']
                    ." "
                    .$highest_match['home_score']

                    ." - "

                    .$highest_match['away_score']
                    ." "

                    .$highest_match['away_player'];

                    ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>