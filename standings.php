<?php
include __DIR__ . '/assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Standings
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



/* PAGE TITLE */

.page-header{

    text-align:center;

    padding:100px 20px 70px;

}

.page-header h1{

    font-size:64px;

    color:white;

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



/* TOP 3 */

.top-three{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));

    gap:30px;

    padding:0 60px 100px;

}



/* PODIUM CARD */

.podium-card{

    background:
    rgba(18,18,18,0.78);

    border:
    1px solid rgba(255,153,0,0.15);

    border-radius:28px;

    padding:45px 30px;

    text-align:center;

    position:relative;

    overflow:hidden;

    backdrop-filter:blur(14px);

    transition:0.4s;

}



/* GLOW */

.podium-card::before{

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

.podium-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 45px rgba(255,153,0,0.15);

}



/* POSITION */

.podium-rank{

    font-size:60px;

    margin-bottom:20px;

}



/* NAME */

.podium-name{

    font-size:30px;

    font-weight:bold;

    margin-bottom:20px;

}



/* POINTS */

.podium-points{

    font-size:48px;

    color:#ff9900;

    font-weight:bold;

    margin-bottom:15px;

    text-shadow:
    0 0 18px rgba(255,153,0,0.6);

}



/* STATS */

.podium-stats{

    color:#bdbdbd;

    line-height:1.8;

}



/* TABLE SECTION */

.table-section{

    padding:0 60px 120px;

}



/* TABLE */

.table-wrapper{

    overflow-x:auto;

    border-radius:24px;

    border:
    1px solid rgba(255,153,0,0.1);

    backdrop-filter:blur(14px);

}



table{

    width:100%;

    border-collapse:collapse;

    background:
    rgba(18,18,18,0.8);

}



table th{

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:22px;

    font-size:15px;

    letter-spacing:1px;

}



table td{

    padding:22px;

    text-align:center;

    border-bottom:
    1px solid rgba(255,255,255,0.05);

}



/* ROW HOVER */

table tr:hover{

    background:
    rgba(255,153,0,0.04);

}



/* RANK */

.rank{

    color:#ff9900;

    font-weight:bold;

    font-size:18px;

}



/* PLAYER */

.player-name{

    font-weight:bold;

}



/* POINTS */

.points{

    color:#ff9900;

    font-weight:bold;

}



/* MOBILE */

@media(max-width:768px){

    .page-header h1{

        font-size:42px;

    }

    .top-three{

        padding:0 25px 70px;

    }

    .table-section{

        padding:0 20px 80px;

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

            STANDINGS

        </span>

    </h1>

    <p>

        Elite rankings of India’s
        competitive eFootball league.

    </p>

</section>



<?php

$top_three = mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY
points DESC,
goal_difference DESC,
goals_for DESC

LIMIT 3"

);

?>



<!-- TOP 3 -->

<section class="top-three">

<?php

$rank = 1;

while($row = mysqli_fetch_assoc($top_three)){

?>

<div class="podium-card">

    <div class="podium-rank">

        <?php

        if($rank == 1){

            echo "🥇";

        }
        elseif($rank == 2){

            echo "🥈";

        }
        else{

            echo "🥉";

        }

        ?>

    </div>



    <div class="podium-name">

        <?php echo $row['player_name']; ?>

    </div>



    <div class="podium-points">

        <?php echo $row['points']; ?>

    </div>



    <div class="podium-stats">

        Wins:
        <?php echo $row['wins']; ?>

        <br>

        GD:
        <?php echo $row['goal_difference']; ?>

        <br>

        Goals:
        <?php echo $row['goals_for']; ?>

    </div>

</div>

<?php

$rank++;

}

?>

</section>



<?php

$table = mysqli_query($conn,

"SELECT standings.*,
        players.player_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY
points DESC,
goal_difference DESC,
goals_for DESC"

);

?>



<!-- TABLE -->

<section class="table-section">

<div class="table-wrapper">

<table>

<tr>

<th>#</th>
<th>Player</th>
<th>P</th>
<th>W</th>
<th>D</th>
<th>L</th>
<th>GF</th>
<th>GA</th>
<th>GD</th>
<th>PTS</th>

</tr>



<?php

$rank = 1;

while($row = mysqli_fetch_assoc($table)){

?>

<tr>

<td class="rank">

<?php echo $rank; ?>

</td>

<td class="player-name">

<?php echo $row['player_name']; ?>

</td>

<td>

<?php echo $row['played']; ?>

</td>

<td>

<?php echo $row['wins']; ?>

</td>

<td>

<?php echo $row['draws']; ?>

</td>

<td>

<?php echo $row['losses']; ?>

</td>

<td>

<?php echo $row['goals_for']; ?>

</td>

<td>

<?php echo $row['goals_against']; ?>

</td>

<td>

<?php echo $row['goal_difference']; ?>

</td>

<td class="points">

<?php echo $row['points']; ?>

</td>

</tr>

<?php

$rank++;

}

?>

</table>

</div>

</section>

</body>
</html>