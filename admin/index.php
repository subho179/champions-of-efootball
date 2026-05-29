<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';


// TOTAL PLAYERS
$total_players = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM players")
);


// TOTAL FIXTURES
$total_fixtures = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM fixtures")
);


// COMPLETED MATCHES
$completed_matches = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM fixtures WHERE match_status='completed'")
);


// PENDING MATCHES
$pending_matches = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM fixtures WHERE match_status='pending'")
);


// TOP SCORER
$top_scorer_query = mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goals_for DESC

LIMIT 1"

);

$top_scorer = mysqli_fetch_assoc($top_scorer_query);



// MOST GOALS CONCEDED
$top_conceded_query = mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goals_against DESC

LIMIT 1"

);

$top_conceded = mysqli_fetch_assoc($top_conceded_query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Dashboard</title>

    <link rel="stylesheet" href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:35px;
            font-size:38px;
        }

        /* WELCOME BOX */

        .welcome-box{
            background:linear-gradient(135deg,#ff9900,#ff6600);
            color:black;
            padding:30px;
            border-radius:20px;
            margin-bottom:35px;
        }

        .welcome-box h2{
            font-size:32px;
            margin-bottom:10px;
        }

        .welcome-box p{
            font-size:16px;
            font-weight:bold;
        }

        /* CARDS */

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:40px;
        }

        .card{
            background:#171717;
            padding:25px;
            border-radius:18px;
            box-shadow:0 0 20px rgba(255,153,0,0.08);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h3{
            color:#ff9900;
            margin-bottom:12px;
            font-size:18px;
        }

        .card p{
            font-size:34px;
            font-weight:bold;
        }

        .card small{
            color:#aaa;
            font-size:14px;
        }

        /* GRID */

        .dashboard-grid{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:25px;
        }

        @media(max-width:1000px){

            .dashboard-grid{
                grid-template-columns:1fr;
            }

        }

        /* PANELS */

        .panel{
            background:#171717;
            border-radius:18px;
            padding:25px;
            box-shadow:0 0 20px rgba(255,153,0,0.06);
        }

        .panel h2{
            color:#ff9900;
            margin-bottom:20px;
            font-size:24px;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#ff9900;
            color:black;
            padding:14px;
            font-size:14px;
        }

        table td{
            padding:14px;
            text-align:center;
            border-bottom:1px solid #2b2b2b;
        }

        table tr:hover{
            background:#1f1f1f;
        }

        /* LEADERBOARD */

        .leaderboard-item{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:14px 0;
            border-bottom:1px solid #2b2b2b;
        }

        .leaderboard-item:last-child{
            border-bottom:none;
        }

        .rank{
            color:#ff9900;
            font-weight:bold;
            margin-right:10px;
        }

        .points{
            color:#4dff88;
            font-weight:bold;
        }

.quick-actions-section{

    margin-top:40px;

}

.quick-actions-section h2{

    color:#ff9900;

    margin-bottom:20px;

    font-family:'Orbitron',sans-serif;

}

.quick-actions-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(180px,1fr));

    gap:20px;

}

.quick-action-card{

    text-decoration:none;

    color:white;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid rgba(255,153,0,.08);

    border-radius:20px;

    padding:25px;

    text-align:center;

    transition:.3s;

    display:flex;

    flex-direction:column;

    gap:10px;

    font-size:30px;

}

.quick-action-card span{

    font-size:14px;

    font-weight:700;

}

.quick-action-card:hover{

    transform:translateY(-4px);

    border-color:
    rgba(255,153,0,.35);

    box-shadow:
    0 0 25px rgba(255,153,0,.15);

}

    </style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<div class="main-content">

    <?php include __DIR__ . '/../includes/topbar.php'; ?>

    <div class="content">

        <!-- WELCOME -->

        <div class="welcome-box">

            <h2>
                🏆 Champions of eFootball
            </h2>

            <p>
                The Champions of Champions
            </p>

        </div>


        <!-- PAGE TITLE -->

        <h1 class="page-title">
            Dashboard Overview
        </h1>


        <!-- CARDS -->

        <div class="cards">

            <!-- TOTAL PLAYERS -->

            <div class="card">

                <h3>Total Players</h3>

                <p>
                    <?php echo $total_players; ?>
                </p>

            </div>


            <!-- TOTAL FIXTURES -->

            <div class="card">

                <h3>Total Fixtures</h3>

                <p>
                    <?php echo $total_fixtures; ?>
                </p>

            </div>


            <!-- COMPLETED MATCHES -->

            <div class="card">

                <h3>Completed Matches</h3>

                <p>
                    <?php echo $completed_matches; ?>
                </p>

            </div>


            <!-- PENDING MATCHES -->

            <div class="card">

                <h3>Pending Matches</h3>

                <p>
                    <?php echo $pending_matches; ?>
                </p>

            </div>


            <!-- TOP SCORER -->

            <div class="card">

                <h3>⚽ Top Scorer</h3>

                <p style="font-size:22px;">

                    <?php
                    if($top_scorer){
                        echo $top_scorer['player_name'];
                    } else {
                        echo "N/A";
                    }
                    ?>

                </p>

                <small>

                    Goals:
                    <?php
                    if($top_scorer){
                        echo $top_scorer['goals_for'];
                    } else {
                        echo 0;
                    }
                    ?>

                </small>

            </div>


            <!-- MOST GOALS CONCEDED -->

            <div class="card">

                <h3>🥅 Most Conceded</h3>

                <p style="font-size:22px;">

                    <?php
                    if($top_conceded){
                        echo $top_conceded['player_name'];
                    } else {
                        echo "N/A";
                    }
                    ?>

                </p>

                <small>

                    Goals Against:
                    <?php
                    if($top_conceded){
                        echo $top_conceded['goals_against'];
                    } else {
                        echo 0;
                    }
                    ?>

                </small>

            </div>

        </div>


        <!-- DASHBOARD GRID -->

        <div class="dashboard-grid">

            <!-- RECENT RESULTS -->

            <div class="panel">

                <h2>
                    ⚽ Recent Results
                </h2>

                <table>

                    <tr>

                        <th>Round</th>
                        <th>Match</th>
                        <th>Score</th>

                    </tr>

                    <?php

                    $results = mysqli_query($conn,

                    "SELECT fixtures.*,

                    p1.player_name AS home_player,
                    p2.player_name AS away_player

                    FROM fixtures

                    JOIN players p1
                    ON fixtures.home_player_id = p1.id

                    JOIN players p2
                    ON fixtures.away_player_id = p2.id

                    WHERE match_status='completed'

                    ORDER BY fixtures.id DESC
                    LIMIT 5"

                    );

                    while($row = mysqli_fetch_assoc($results)){

                    ?>

                    <tr>

                        <td>
                            Round <?php echo $row['round_no']; ?>
                        </td>

                        <td>

                            <?php echo $row['home_player']; ?>

                            VS

                            <?php echo $row['away_player']; ?>

                        </td>

                        <td>

                            <?php echo $row['home_score']; ?>

                            -

                            <?php echo $row['away_score']; ?>

                        </td>

                    </tr>

                    <?php } ?>

                </table>

            </div>


            <!-- TOP 5 LEADERBOARD -->

            <div class="panel">

                <h2>
                    🏅 Top 5 Leaderboard
                </h2>

                <?php

                $leaders = mysqli_query($conn,

                "SELECT standings.*,
                        players.player_name

                FROM standings

                JOIN players
                ON standings.player_id = players.id

                ORDER BY
                points DESC,
                goal_difference DESC,
                goals_for DESC

                LIMIT 5"

                );

                $rank = 1;

                while($leader = mysqli_fetch_assoc($leaders)){

                ?>

                <div class="leaderboard-item">

                    <div>

                        <span class="rank">
                            #<?php echo $rank; ?>
                        </span>

                        <?php echo $leader['player_name']; ?>

                    </div>

                    <div class="points">

                        <?php echo $leader['points']; ?> pts

                    </div>

                </div>

                <?php

                $rank++;

                }

                ?>

            </div>

        </div>

    </div>

</div>

<div class="quick-actions-section">

    <h2>Quick Actions</h2>

    <div class="quick-actions-grid">

        <a href="news.php" class="quick-action-card">
            📰
            <span>News Panel</span>
        </a>

        <a href="changelog.php" class="quick-action-card">
            📜
            <span>Changelog</span>
        </a>

        <a href="roadmap.php" class="quick-action-card">
            🛣
            <span>Roadmap</span>
        </a>

        <a href="fixtures.php" class="quick-action-card">
            ⚽
            <span>Fixtures</span>
        </a>

        <a href="players.php" class="quick-action-card">
            👥
            <span>Players</span>
        </a>

        <a href="standings.php" class="quick-action-card">
            🏆
            <span>Standings</span>
        </a>

    </div>

</div>

</body>
</html>