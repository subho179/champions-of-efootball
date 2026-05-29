<?php
include __DIR__ . '/assets/db.php';
include 'includes/rank-system.php';
include 'includes/flag-system.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Results
</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">



<!-- FUTURISTIC FONTS -->

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Exo+2:wght@400;500;600;700&display=swap"
rel="stylesheet">



<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}



/* BODY */

body{

    font-family:'Exo 2',sans-serif;

    background:
    radial-gradient(circle at top,
    #1a1a1a,
    #050505);

    color:white;

    overflow-x:hidden;

}



/* TITLES */

h1,h2,h3,
.score-number,
.score-dash{

    font-family:'Orbitron',sans-serif;

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

    letter-spacing:2px;

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



/* SECTION */

.results-section{

    padding:0 60px 120px;

}



/* GRID */

.results-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:30px;

}



/* CARD */

.result-card{

    background:
    rgba(18,18,18,0.82);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:30px;

    padding:40px;

    position:relative;

    overflow:hidden;

    backdrop-filter:blur(14px);

    transition:0.4s;

}



/* GLOW */

.result-card::before{

    content:"";

    position:absolute;

    width:240px;

    height:240px;

    background:#ff9900;

    filter:blur(130px);

    opacity:0.08;

    top:-80px;

    right:-80px;

}



/* HOVER */

.result-card:hover{

    transform:translateY(-8px);

    border-color:
    rgba(255,153,0,0.4);

    box-shadow:
    0 0 35px rgba(255,153,0,0.12);

}



/* ROUND */

.result-round{

    display:inline-block;

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:10px 18px;

    border-radius:30px;

    font-size:13px;

    font-weight:700;

    margin-bottom:35px;

}



/* MATCH */

.result-match{

    display:grid;

    grid-template-columns:
    1fr auto 1fr;

    align-items:center;

    gap:20px;

    margin-bottom:35px;

}



/* PLAYER */

.result-player{

    font-size:28px;

    font-weight:700;

    text-align:center;

    overflow-wrap:anywhere;

}



/* SCORE BOX */

.score-box{

    display:flex;

    align-items:center;

    justify-content:center;

    gap:16px;

}



/* SCORE */

.score-number{

    font-size:72px;

    font-weight:800;

    color:#ff9900;

    min-width:80px;

    text-align:center;

    text-shadow:
    0 0 18px rgba(255,153,0,0.6);

}



/* DASH */

.score-dash{

    font-size:52px;

    color:#ff9900;

}



/* STATUS */

.result-status{

    text-align:center;

    font-size:17px;

    letter-spacing:1px;

}



/* WIN */

.winner{

    color:#4dff88;

    font-weight:700;

}



/* DRAW */

.draw{

    color:#ffd000;

    font-weight:700;

}



/* RANK BADGE */

.rank-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:6px;

    margin-top:12px;

    padding:7px 14px;

    border-radius:30px;

    font-size:12px;

    font-weight:700;

}



/* BRONZE */

.bronze-rank{

    background:#3a2a1d;

    color:#ffb27a;

}



/* SILVER */

.silver-rank{

    background:#2d2d35;

    color:#d8d8d8;

}



/* GOLD */

.gold-rank{

    background:#3d2d00;

    color:#ffd700;

}



/* ELITE */

.elite-rank{

    background:#2b1045;

    color:#d78cff;

    box-shadow:
    0 0 20px rgba(215,140,255,0.4);

}



/* MOBILE */

@media(max-width:768px){

    .page-header h1{

        font-size:40px;

    }



    .results-section{

        padding:0 20px 80px;

    }



    .results-grid{

        grid-template-columns:1fr;

    }



    .result-card{

        padding:28px 18px;

    }



    .result-match{

        gap:10px;

    }



    .result-player{

        font-size:20px;

    }



    .score-number{

        font-size:46px;

        min-width:45px;

    }



    .score-dash{

        font-size:30px;

    }

}

.country-flag{

    width:28px;

    height:20px;

    object-fit:cover;

    border-radius:4px;

    margin-right:8px;

    vertical-align:middle;

    box-shadow:
    0 0 10px rgba(255,255,255,0.15);

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<!-- HEADER -->

<section class="page-header">

<h1>

MATCH

<span>

RESULTS

</span>

</h1>

<p>

Completed battles from India’s
elite eFootball competition.

</p>

</section>



<?php

$results = mysqli_query($conn,

"SELECT fixtures.*,

p1.player_name AS home_player,
p2.player_name AS away_player,

p1.team_name AS home_team,
p2.team_name AS away_team,

s1.points AS home_points,
s2.points AS away_points

FROM fixtures

JOIN players p1
ON fixtures.home_player_id = p1.id

JOIN players p2
ON fixtures.away_player_id = p2.id

LEFT JOIN standings s1
ON s1.player_id = p1.id

LEFT JOIN standings s2
ON s2.player_id = p2.id

WHERE match_status='completed'

ORDER BY fixtures.id DESC"

);

?>



<!-- RESULTS -->

<section class="results-section">

<div class="results-grid">

<?php

while($row = mysqli_fetch_assoc($results)){

$homeRank = getRank($row['home_points'] ?? 0);
$awayRank = getRank($row['away_points'] ?? 0);

?>

<div class="result-card">



<div class="result-round">

ROUND <?php echo $row['round_no']; ?>

</div>



<div class="result-match">



<div class="result-player">

<?php
echo getFlag($row['home_team']);
?>

<?php echo $row['home_player']; ?>

<br>

<div class="rank-badge <?php
echo $homeRank['class'];
?>">

<?php echo $homeRank['icon']; ?>

<?php echo strtoupper($homeRank['name']); ?>

</div>

</div>



<div class="score-box">

<span class="score-number">

<?php echo $row['home_score']; ?>

</span>

<span class="score-dash">

-

</span>

<span class="score-number">

<?php echo $row['away_score']; ?>

</span>

</div>



<div class="result-player">

<?php
echo getFlag($row['away_team']);
?>

<?php echo $row['away_player']; ?>

<br>

<div class="rank-badge <?php
echo $awayRank['class'];
?>">

<?php echo $awayRank['icon']; ?>

<?php echo strtoupper($awayRank['name']); ?>

</div>

</div>

</div>



<div class="result-status">

<?php

if($row['home_score']
> $row['away_score']){

echo "<span class='winner'>"
.$row['home_player']
." WON</span>";

}

elseif($row['away_score']
> $row['home_score']){

echo "<span class='winner'>"
.$row['away_player']
." WON</span>";

}

else{

echo "<span class='draw'>
DRAW MATCH
</span>";

}

?>

</div>

</div>

<?php } ?>

</div>

</section>

</body>
</html>