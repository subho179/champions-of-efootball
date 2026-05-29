<?php

include 'assets/db.php';
include 'includes/rank-system.php';
include 'includes/flag-system.php';



$top_players = mysqli_query(

$conn,

"SELECT

players.*,
standings.points,
standings.wins,
standings.losses,
standings.draws

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY standings.points DESC

LIMIT 3"

);

?>

<section class="top-players-section">

<div class="section-title">

TOP PLAYER

</div>



<div class="top-players-grid">

<?php

$position = 1;

while($player = mysqli_fetch_assoc($top_players)){

$total_matches =
$player['wins']
+
$player['losses']
+
$player['draws'];



$win_rate =
$total_matches > 0

? round(($player['wins'] / $total_matches) * 100)

: 0;



$rank = getRank($player['points']);

?>



<div class="top-player-card">



<!-- POSITION -->

<div class="top-position">

<?php

if($position==1){

    echo "🥇";

}
elseif($position==2){

    echo "🥈";

}
else{

    echo "🥉";

}

?>

</div>



<!-- IMAGE -->

<div class="top-player-image">

<img src="<?php echo $player['profile_pic']; ?>">

</div>



<!-- NAME -->

<div class="top-player-name">

<?php echo $player['player_name']; ?>

</div>



<!-- TEAM -->

<div class="top-player-team">

<?php echo getFlag($player['team_name']); ?>

<?php echo strtoupper($player['team_name']); ?>

</div>



<!-- RANK -->

<div class="top-rank-badge <?php echo $rank['class']; ?>">

<?php echo $rank['icon']; ?>

<?php echo strtoupper($rank['name']); ?>

</div>



<!-- MINI RING -->

<div class="mini-ring-wrapper">

<svg class="mini-ring" viewBox="0 0 120 120">

<circle
class="mini-ring-bg"
cx="60"
cy="60"
r="52">
</circle>

<circle
class="mini-ring-fill"
cx="60"
cy="60"
r="52"

style="--progress:
<?php echo $win_rate; ?>;">

</circle>

</svg>



<div class="mini-ring-content">

<?php echo $win_rate; ?>%

</div>

</div>



<!-- POINTS -->

<div class="top-player-points">

<?php echo $player['points']; ?> PTS

</div>

</div>

<?php

$position++;

}

?>

</div>

</section>



<style>

/* SECTION */

.top-players-section{

    margin-top:100px;

    padding:20px;

}



/* TITLE */

.section-title{

    text-align:center;

    font-size:42px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

    margin-bottom:50px;

    letter-spacing:4px;

}



/* GRID */

.top-players-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:30px;

}



/* CARD */

.top-player-card{

    position:relative;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:24px;

    padding:26px 22px;

    text-align:center;

    overflow:hidden;

    transition:0.35s;

    backdrop-filter:blur(14px);

    min-height:auto;

}



/* HOVER */

.top-player-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.28);

    box-shadow:
    0 0 35px rgba(255,153,0,0.15);

}



/* GLOW */

.top-player-card::before{

    content:"";

    position:absolute;

    width:240px;

    height:240px;

    background:#ff9900;

    filter:blur(140px);

    opacity:0.05;

    top:-100px;

    right:-100px;

}



/* POSITION */

.top-position{

    font-size:34px;

    margin-bottom:20px;

}



/* IMAGE */

.top-player-image img{

    width:120px;

    height:120px;

    border-radius:50%;

    object-fit:cover;

    border:
    4px solid #ff9900;

    box-shadow:
    0 0 20px rgba(255,153,0,0.3);

}



/* NAME */

.top-player-name{

    margin-top:20px;

    font-size:28px;

    font-family:'Orbitron',sans-serif;

}



/* TEAM */

.top-player-team{

    margin-top:10px;

    color:#ff9900;

    font-weight:700;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    font-size:18px;

}

.top-player-team img{

    width:28px;

    height:20px;

    object-fit:cover;

    border-radius:4px;

}


/* BADGE */

/* RANK BADGE */

.top-rank-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    padding:10px 20px;

    border-radius:999px;

    margin-top:18px;

    font-size:13px;

    font-weight:700;

    text-transform:uppercase;

    position:relative;

    overflow:hidden;

    border:1px solid transparent;

}



/* ELITE */

.elite-rank{

    background:

    linear-gradient(
    135deg,
    #2f1147,
    #4f1f73
    );

    color:#f1c4ff;

    box-shadow:

    0 0 18px rgba(179,84,255,0.45),
    inset 0 0 12px rgba(255,255,255,0.04);

}



/* GOLD */

.gold-rank{

    background:

    linear-gradient(
    135deg,
    #3f2c00,
    #6b4b00
    );

    color:#ffd54d;

    box-shadow:

    0 0 16px rgba(255,183,0,0.28),
    inset 0 0 10px rgba(255,255,255,0.03);

}



/* SILVER */

.silver-rank{

    background:

    linear-gradient(
    135deg,
    #2e2e36,
    #4a4a58
    );

    color:#e6e6e6;

    box-shadow:

    0 0 14px rgba(255,255,255,0.12),
    inset 0 0 8px rgba(255,255,255,0.04);

}



/* BRONZE */

.bronze-rank{

    background:

    linear-gradient(
    135deg,
    #3f2415,
    #6a3c22
    );

    color:#ffb78d;

    box-shadow:

    0 0 14px rgba(255,140,80,0.18),
    inset 0 0 8px rgba(255,255,255,0.03);

}



/* MINI RING */

.mini-ring-wrapper{

    margin-top:30px;

    position:relative;

    width:140px;

    height:140px;

    margin-left:auto;

    margin-right:auto;

}



/* SVG */

.mini-ring{

    width:140px;

    height:140px;

    transform:rotate(-90deg);

}



/* BG */

.mini-ring-bg{

    fill:none;

    stroke:rgba(255,255,255,0.06);

    stroke-width:8;

}



/* FILL */

.mini-ring-fill{

    fill:none;

    stroke:#ff9900;

    stroke-width:8;

    stroke-linecap:round;

    stroke-dasharray:327;

    stroke-dashoffset:327;

    animation:
    miniRingAnimation 2s ease forwards;

}



/* CONTENT */

.mini-ring-content{

    position:absolute;

    inset:0;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:28px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

}



/* POINTS */

.top-player-points{

    margin-top:25px;

    font-size:20px;

    font-family:'Orbitron',sans-serif;

    color:#ffffff;

}



/* ANIMATION */

@keyframes miniRingAnimation{

    to{

        stroke-dashoffset:
        calc(327 - (327 * var(--progress)) / 100);

    }

}



/* MOBILE */

@media(max-width:768px){

    .section-title{

        font-size:30px;

    }

}

</style>