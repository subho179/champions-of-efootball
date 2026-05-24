<?php
include __DIR__ . '/assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Statistics
</title>

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    background:
    radial-gradient(circle at top,
    #1a1a1a,
    #050505);

    color:white;

    overflow-x:hidden;

}



/* HEADER */

.page-header{

    text-align:center;

    padding:100px 20px 70px;

}

.page-header h1{

    font-size:64px;

    margin-bottom:20px;

    text-transform:uppercase;

}

.page-header h1 span{

    color:#ff9900;

    text-shadow:
    0 0 20px #ff9900;

}

.page-header p{

    color:#bdbdbd;

    font-size:20px;

}



/* STATS SECTION */

.stats-section{

    padding:0 60px 120px;

}



/* GRID */

.stats-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:30px;

}



/* CARD */

.stat-card{

    background:
    rgba(18,18,18,0.8);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:28px;

    padding:40px;

    position:relative;

    overflow:hidden;

    backdrop-filter:blur(14px);

    transition:0.4s;

    text-align:center;

}



/* GLOW */

.stat-card::before{

    content:"";

    position:absolute;

    width:220px;

    height:220px;

    background:#ff9900;

    filter:blur(120px);

    opacity:0.08;

    top:-60px;

    right:-60px;

}



/* HOVER */

.stat-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 40px rgba(255,153,0,0.12);

}



/* ICON */

.stat-icon{

    font-size:58px;

    margin-bottom:25px;

}



/* TITLE */

.stat-title{

    font-size:22px;

    color:#ff9900;

    margin-bottom:25px;

    font-weight:bold;

}



/* PLAYER */

.stat-player{

    font-size:30px;

    font-weight:bold;

    margin-bottom:20px;

}



/* VALUE */

.stat-value{

    font-size:52px;

    color:#ff9900;

    font-weight:bold;

    text-shadow:
    0 0 20px rgba(255,153,0,0.7);

}



/* MOBILE */

@media(max-width:768px){

    .page-header h1{

        font-size:42px;

    }

    .stats-section{

        padding:0 25px 80px;

    }

    .stat-player{

        font-size:24px;

    }

    .stat-value{

        font-size:40px;

    }

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<!-- HEADER -->

<section class="page-header">

<h1>

LEAGUE

<span>

STATISTICS

</span>

</h1>

<p>

Advanced analytics from India’s
elite eFootball competition.

</p>

</section>



<?php

// TOP GOAL SCORER

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

) ?? [];



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

) ?? [];



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

) ?? [];



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

) ?? [];



// BEST GOAL DIFFERENCE

$best_gd = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY goal_difference DESC

LIMIT 1"

)

) ?? [];

?>



<!-- STATS -->

<section class="stats-section">

<div class="stats-grid">



<!-- TOP SCORER -->

<div class="stat-card">

    <div class="stat-icon">
        ⚽
    </div>

    <div class="stat-title">
        TOP GOAL SCORER
    </div>

    <div class="stat-player">

        <?php echo $top_scorer['player_name'] ?? 'N/A'; ?>

    </div>

    <div class="stat-value">

        <?php echo $top_scorer['goals_for'] ?? 0; ?>

    </div>

</div>



<!-- BEST DEFENSE -->

<div class="stat-card">

    <div class="stat-icon">
        🛡️
    </div>

    <div class="stat-title">
        BEST DEFENSE
    </div>

    <div class="stat-player">

        <?php echo $best_defense['player_name'] ?? 'N/A'; ?>

    </div>

    <div class="stat-value">

        <?php echo $best_defense['goals_against'] ?? 0; ?>

    </div>

</div>



<!-- MOST WINS -->

<div class="stat-card">

    <div class="stat-icon">
        🏆
    </div>

    <div class="stat-title">
        MOST WINS
    </div>

    <div class="stat-player">

        <?php echo $most_wins['player_name'] ?? 'N/A'; ?>

    </div>

    <div class="stat-value">

        <?php echo $most_wins['wins'] ?? 0; ?>

    </div>

</div>



<!-- MOST LOSSES -->

<div class="stat-card">

    <div class="stat-icon">
        💀
    </div>

    <div class="stat-title">
        MOST LOSSES
    </div>

    <div class="stat-player">

        <?php echo $most_losses['player_name'] ?? 'N/A'; ?>

    </div>

    <div class="stat-value">

        <?php echo $most_losses['losses'] ?? 0; ?>

    </div>

</div>



<!-- BEST GOAL DIFFERENCE -->

<div class="stat-card">

    <div class="stat-icon">
        📈
    </div>

    <div class="stat-title">
        BEST GOAL DIFFERENCE
    </div>

    <div class="stat-player">

        <?php echo $best_gd['player_name'] ?? 'N/A'; ?>

    </div>

    <div class="stat-value">

        <?php echo $best_gd['goal_difference'] ?? 0; ?>

    </div>

</div>

</div>

</section>

</body>
</html>