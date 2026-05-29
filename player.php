<?php

include 'assets/db.php';
include 'includes/rank-system.php';
include 'includes/flag-system.php';



if(!isset($_GET['player'])){

    die("Player Not Found");

}



$player_name =
mysqli_real_escape_string(
$conn,
$_GET['player']
);



$player = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT * FROM players
WHERE player_name='$player_name'"

)

);



if(!$player){

    die("Player Not Found");

}



/* PLAYER STATS */

$player_id = $player['id'];



$stats = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT * FROM standings
WHERE player_id='$player_id'"

)

);



$wins = $stats['wins'] ?? 0;
$losses = $stats['losses'] ?? 0;
$draws = $stats['draws'] ?? 0;

$goals_scored = $stats['goals_for'] ?? 0;
$goals_conceded = $stats['goals_against'] ?? 0;

$points = $stats['points'] ?? 0;



/* MATCHES */

$total_matches =
$wins + $losses + $draws;



/* WIN RATE */

$win_rate =
$total_matches > 0

? round(($wins / $total_matches) * 100)

: 0;



/* GOALS PER MATCH */

$goals_per_match =
$total_matches > 0

? round($goals_scored / $total_matches,1)

: 0;



/* RANK */

$rank = getRank($points);



/* FORM */

$form = [];



$form_query = mysqli_query(

$conn,

"SELECT * FROM fixtures

WHERE

match_status='completed'

AND (

home_player_id='$player_id'

OR

away_player_id='$player_id'

)

ORDER BY id DESC

LIMIT 5"

);



while($match = mysqli_fetch_assoc($form_query)){

    $isHome =
    $match['home_player_id']
    == $player_id;



    $playerScore =
    $isHome
    ? $match['home_score']
    : $match['away_score'];



    $opponentScore =
    $isHome
    ? $match['away_score']
    : $match['home_score'];



    if($playerScore > $opponentScore){

        $form[] = "W";

    }
    elseif($playerScore < $opponentScore){

        $form[] = "L";

    }
    else{

        $form[] = "D";

    }

}



/* STREAK */

$streak = 0;

$streak_type = "";



if(count($form) > 0){

    $streak_type = $form[0];



    foreach($form as $result){

        if($result == $streak_type){

            $streak++;

        }
        else{

            break;

        }

    }

}



/* MATCH HISTORY */

$history = mysqli_query(

$conn,

"SELECT fixtures.*,

p1.player_name AS home_player,
p1.team_name AS home_team,

p2.player_name AS away_player,
p2.team_name AS away_team,

mvp.player_name AS mvp_name

FROM fixtures

JOIN players p1
ON fixtures.home_player_id = p1.id

JOIN players p2
ON fixtures.away_player_id = p2.id

LEFT JOIN players mvp
ON fixtures.mvp_player_id = mvp.id

WHERE

fixtures.match_status='completed'

AND (

fixtures.home_player_id='$player_id'

OR

fixtures.away_player_id='$player_id'

)

ORDER BY fixtures.id DESC

LIMIT 5"

);

$mvpCountQuery = mysqli_query(

$conn,

"SELECT COUNT(*) as total
FROM fixtures
WHERE mvp_player_id = '$player_id'"

);

$mvpCount =
mysqli_fetch_assoc($mvpCountQuery)['total'];

?>

<!DOCTYPE html>
<html>

<head>

<title>

<?php echo $player['player_name']; ?>

- COE Profile

</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">



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



body{

    font-family:'Exo 2',sans-serif;

    background:
    radial-gradient(circle at top,
    #161616,
    #050505);

    color:white;

    min-height:100vh;

    overflow-x:hidden;

}



h1,h2,h3{

    font-family:'Orbitron',sans-serif;

}



/* CONTAINER */

.profile-container{

    width:100%;

    max-width:1250px;

    margin:60px auto;

    padding:20px;

}



/* CARD */

.profile-card{

    background:
    rgba(18,18,18,0.9);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:30px;

    padding:45px;

    backdrop-filter:blur(18px);

    position:relative;

    overflow:hidden;

}



/* GLOW */

.profile-card::before{

    content:"";

    position:absolute;

    width:400px;

    height:400px;

    background:#ff9900;

    filter:blur(180px);

    opacity:0.05;

    top:-120px;

    right:-120px;

}



/* TOP */

.profile-top{

    display:flex;

    gap:40px;

    align-items:center;

    flex-wrap:wrap;

}



/* IMAGE */

.profile-image img{

    width:180px;

    height:180px;

    border-radius:50%;

    object-fit:cover;

    border:
    4px solid #ff9900;

    box-shadow:
    0 0 35px rgba(255,153,0,0.35);

}



/* INFO */

.profile-info h1{

    font-size:62px;

    letter-spacing:2px;

}



/* RANK */

.rank-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:10px 18px;

    border-radius:30px;

    margin-top:15px;

    font-size:14px;

    font-weight:700;

}



.bronze-rank{

    background:#3a2a1d;

    color:#ffb27a;

}



.silver-rank{

    background:#2d2d35;

    color:#d8d8d8;

}



.gold-rank{

    background:#3d2d00;

    color:#ffd700;

}



.elite-rank{

    background:#2b1045;

    color:#d78cff;

    box-shadow:
    0 0 20px rgba(215,140,255,0.35);

}



/* TEAM */

.team-name{

    font-size:28px;

    color:#ff9900;

    margin-top:18px;

    font-weight:700;

}



/* FAVORITE */

.favorite-team{

    margin-top:10px;

    color:#bdbdbd;

    font-size:18px;

}



/* FLAGS */

.country-flag{

    width:28px;

    height:20px;

    object-fit:cover;

    border-radius:4px;

    margin-right:8px;

    vertical-align:middle;

}



/* STATS */

.stats-grid{

    margin-top:55px;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(180px,1fr));

    gap:22px;

}



.stat-card{

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:24px;

    padding:30px;

    text-align:center;

    transition:0.3s;

}



.stat-card:hover{

    transform:translateY(-6px);

    border-color:
    rgba(255,153,0,0.25);

}



.stat-value{

    font-size:42px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

}



.stat-label{

    margin-top:10px;

    color:#a9a9a9;

}



/* PERFORMANCE */

.performance-panel{

    margin-top:80px;

    display:flex;

    justify-content:center;

}



/* RING */

.performance-card{

    width:320px;

    height:320px;

    border-radius:50%;

    position:relative;

    display:flex;

    align-items:center;

    justify-content:center;

    background:

    radial-gradient(
    circle at center,
    rgba(255,255,255,0.03),
    rgba(255,255,255,0.01)
    );

    border:
    1px solid rgba(255,153,0,0.08);

}



/* ROTATING OUTER */

.performance-card::before{

    content:"";

    position:absolute;

    width:100%;

    height:100%;

    border-radius:50%;

    background:

    conic-gradient(

    from 0deg,

    transparent 0deg,
    rgba(255,153,0,0.04) 60deg,
    rgba(255,153,0,0.25) 120deg,
    rgba(255,153,0,0.04) 180deg,
    transparent 250deg

    );

    animation:
    rotateGlow 14s linear infinite;

    opacity:0.9;

}



/* INNER */

.performance-card::after{

    content:"";

    position:absolute;

    inset:14px;

    border-radius:50%;

    background:
    radial-gradient(circle,
    #101010,
    #070707);

}



/* RING GLOW */

.performance-ring-glow{

    position:absolute;

    width:260px;

    height:260px;

    border-radius:50%;

    overflow:hidden;

    isolation:isolate;

    box-shadow:

    0 0 30px rgba(255,153,0,0.14),
    0 0 60px rgba(255,153,0,0.06);

    animation:
    pulseGlow 2.5s ease-in-out infinite;

}



/* SVG */

.progress-ring{

    position:relative;

    width:260px;

    height:260px;

    transform:rotate(-90deg);

    z-index:2;

    border-radius:50%;

    overflow:hidden;

    isolation:isolate;

}



/* CIRCLE */

.progress-ring circle{

    fill:none;

    stroke-width:10;

    stroke-linecap:round;

}



/* BG */

.progress-bg{

    stroke:rgba(255,255,255,0.05);

}



/* FILL */

.progress-fill{

    stroke:#ff9900;

    stroke-width:10;

    fill:none;

    stroke-linecap:round;

    stroke-dasharray:754;

    stroke-dashoffset:754;

    filter:
    drop-shadow(0 0 8px rgba(255,153,0,0.7))
    drop-shadow(0 0 18px rgba(255,153,0,0.45));

    animation:
    progressAnimation 2.5s ease forwards;

}



/* CONTENT */

.performance-content{

    position:absolute;

    z-index:5;

    text-align:center;

}



/* PERCENT */

.performance-percent{

    font-size:74px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

    text-shadow:

    0 0 12px rgba(255,153,0,0.5),
    0 0 32px rgba(255,153,0,0.35);

}



/* LABEL */

.performance-label{

    margin-top:12px;

    letter-spacing:4px;

    color:#9d9d9d;

}



/* ANALYTICS */

.analytics-grid{

    margin-top:60px;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:22px;

}



.analytics-card{

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:24px;

    padding:28px;

    text-align:center;

    position:relative;

    overflow:hidden;

    transition:0.3s;

}



.analytics-card:hover{

    transform:translateY(-6px);

    border-color:
    rgba(255,153,0,0.25);

}



.analytics-card::before{

    content:"";

    position:absolute;

    width:180px;

    height:180px;

    background:#ff9900;

    filter:blur(120px);

    opacity:0.05;

    top:-80px;

    right:-80px;

}



.analytics-value{

    position:relative;

    z-index:2;

    font-size:38px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

}



.analytics-label{

    position:relative;

    z-index:2;

    margin-top:10px;

    color:#9c9c9c;

}



/* FORM */

.form-display{

    display:flex;

    justify-content:center;

    gap:10px;

    margin-top:18px;

}



.form-item{

    width:42px;

    height:42px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-weight:700;

}



.form-win{

    background:#14381e;

    color:#4dff88;

}



.form-loss{

    background:#401515;

    color:#ff6666;

}



.form-draw{

    background:#4a3d0d;

    color:#ffd000;

}



/* HISTORY */

.match-history{

    margin-top:70px;

}



.match-history h2{

    color:#ff9900;

    margin-bottom:30px;

    font-size:34px;

}



/* HISTORY CARD */

.history-card{

    background:
    linear-gradient(
    135deg,
    rgba(255,255,255,0.03),
    rgba(255,153,0,0.02)
    );

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:28px;

    padding:26px;

    margin-bottom:22px;

    transition:0.3s;

}



.history-card:hover{

    transform:translateY(-4px);

    border-color:
    rgba(255,153,0,0.22);

    box-shadow:
    0 0 35px rgba(255,153,0,0.08);

}



/* TOP */

.history-top{

    display:flex;

    align-items:center;

    gap:14px;

    margin-bottom:22px;

}



/* RESULT */

.history-result{

    width:54px;

    height:54px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:20px;

    font-weight:800;

}



/* MAIN */

.history-main{

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    text-align:center;

    gap:16px;

}



/* PLAYER */

.history-player{

    display:flex;

    align-items:center;

    gap:12px;

    font-size:34px;

    font-weight:700;

}



/* SCORE */

.history-score{

    font-size:68px;

    line-height:1;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

    text-shadow:
    0 0 18px rgba(255,153,0,0.25);

}



.history-score span{

    margin:0 14px;

    color:white;

}



/* FOOTER */

.history-footer{

    margin-top:24px;

    display:flex;

    justify-content:center;

}



/* MVP */

.history-mvp{

    padding:10px 18px;

    border-radius:14px;

    background:
    rgba(255,255,255,0.04);

    border:
    1px solid rgba(255,153,0,0.08);

    font-size:15px;

    color:#d7d7d7;

}



.history-mvp b{

    color:#ffcc66;

}


.win-result{

    background:#12391f;

    color:#4dff88;

}



.loss-result{

    background:#401515;

    color:#ff6666;

}



.draw-result{

    background:#4d3d10;

    color:#ffd000;

}



.history-details{

    flex:1;

    margin-left:25px;

    font-size:18px;

    font-weight:600;

}



.history-score{

    font-size:30px;

    color:#ff9900;

    font-family:'Orbitron',sans-serif;

}



/* ANIMATION */

@keyframes rotateGlow{

    from{

        transform:
        rotate(0deg)
        scale(1);

    }

    50%{

        transform:
        rotate(180deg)
        scale(1.03);

    }

    to{

        transform:
        rotate(360deg)
        scale(1);

    }

}



@keyframes pulseGlow{

    0%{

        transform:scale(1);

        opacity:0.6;

    }

    50%{

        transform:scale(1.04);

        opacity:1;

    }

    100%{

        transform:scale(1);

        opacity:0.6;

    }

}



@keyframes progressAnimation{

    to{

        stroke-dashoffset:
        calc(754 - (754 * var(--progress)) / 100);

    }

}



/* MOBILE */

@media(max-width:768px){

    .profile-top{

        flex-direction:column;

        text-align:center;

    }


    .profile-info h1{

        font-size:42px;

    }



    .profile-image img{

        width:150px;

        height:150px;

    }



    /* SIMPLE MOBILE PERFORMANCE */

    .performance-card{

        width:220px;

        height:220px;

    }



    .performance-card::before{

        display:none;

    }



    .performance-card::after{

        inset:16px;

    }



    .performance-ring-glow{

        display:none;

    }



    .progress-ring{

        width:220px;

        height:220px;

        transform:none;

    }



    .progress-ring circle{

        display:none;

    }



    .progress-bg{

        stroke-width:8;

    }



.progress-fill{

    display:none;

}



    .performance-percent{

        font-size:48px;

    }



    .performance-label{

        font-size:14px;

        letter-spacing:3px;

    }



    .history-card{

        flex-direction:column;

        gap:15px;

        text-align:center;

    }



    .history-details{

        margin-left:0;

    }

}

/* HISTORY TOP */

.history-top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:18px;

}



/* ROUND */

.match-round{

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:8px 14px;

    border-radius:14px;

    font-size:13px;

    font-weight:700;

}



/* MAIN */

.history-main{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

}



/* PLAYER */

.history-player{

    display:flex;

    align-items:center;

    gap:10px;

    font-size:20px;

    font-weight:700;

}



/* SCORE */

.history-score{

    font-size:38px;

    font-family:'Orbitron',sans-serif;

    color:#ff9900;

    text-shadow:
    0 0 14px rgba(255,153,0,0.25);

}



.history-score span{

    margin:0 10px;

    color:#ffffff;

}



/* FOOTER */

.history-footer{

    margin-top:20px;

    padding-top:18px;

    border-top:
    1px solid rgba(255,255,255,0.06);

}



/* MVP */

.history-mvp{

    font-size:15px;

    color:#cfcfcf;

}



.history-mvp b{

    color:#ffcc66;

}



/* HOVER */

.history-card{

    transition:0.3s;

}



.history-card:hover{

    transform:translateY(-4px);

    border-color:
    rgba(255,153,0,0.25);

    box-shadow:
    0 0 25px rgba(255,153,0,0.08);

}

@media(max-width:768px){

    .history-player{

        font-size:24px;

    }

    .history-score{

        font-size:48px;

    }

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<div class="profile-container">

<div class="profile-card">



<div class="profile-top">



<div class="profile-image">

<img src="<?php echo $player['profile_pic']; ?>">

</div>



<div class="profile-info">

<h1>

<?php echo $player['player_name']; ?>

</h1>



<div class="rank-badge <?php echo $rank['class']; ?>">

<?php echo $rank['icon']; ?>

<?php echo strtoupper($rank['name']); ?>

PLAYER

</div>



<div class="team-name">

<?php echo getFlag($player['team_name']); ?>

<?php echo strtoupper($player['team_name']); ?>

</div>



<div class="favorite-team">

Favorite Nation:
<b>

<?php echo getFlag($player['favorite_team']); ?>

<?php echo $player['favorite_team']; ?>

</b>

</div>

</div>

</div>



<!-- STATS -->

<div class="stats-grid">

<div class="stat-card">
<div class="stat-value"><?php echo $wins; ?></div>
<div class="stat-label">Wins</div>
</div>

<div class="stat-card">
<div class="stat-value"><?php echo $losses; ?></div>
<div class="stat-label">Losses</div>
</div>

<div class="stat-card">
<div class="stat-value"><?php echo $draws; ?></div>
<div class="stat-label">Draws</div>
</div>

<div class="stat-card">
<div class="stat-value"><?php echo $goals_scored; ?></div>
<div class="stat-label">Goals</div>
</div>

<div class="stat-card">
<div class="stat-value"><?php echo $goals_conceded; ?></div>
<div class="stat-label">Conceded</div>
</div>

<div class="stat-card">
<div class="stat-value"><?php echo $points; ?></div>
<div class="stat-label">Points</div>
</div>

<div class="stat-card">

<div class="stat-value">

<?php echo $mvpCount; ?>

</div>

<div class="stat-label">

 MVP Awards

</div>

</div>

</div>



<!-- PERFORMANCE -->

<div class="performance-panel">

<div class="performance-card">

<div class="performance-ring-glow"></div>

<svg class="progress-ring">



<circle
class="progress-bg"
cx="130"
cy="130"
r="120">
</circle>

<circle
class="progress-fill"
cx="130"
cy="130"
r="120"

style="--progress:
<?php echo $win_rate; ?>;">

</circle>

</svg>



<div class="performance-content">

<div class="performance-percent">

<?php echo $win_rate; ?>%

</div>

<div class="performance-label">

WIN RATE

</div>

</div>

</div>

</div>



<!-- ANALYTICS -->

<div class="analytics-grid">



<div class="analytics-card">

<div class="analytics-value">

<?php

if($streak_type=="W"){

    echo "🔥 ".$streak;

}
elseif($streak_type=="L"){

    echo "❌ ".$streak;

}
else{

    echo "🤝 ".$streak;

}

?>

</div>

<div class="analytics-label">

CURRENT STREAK

</div>

</div>



<div class="analytics-card">

<div class="analytics-value">

<?php echo $goals_per_match; ?>

</div>

<div class="analytics-label">

GOALS PER MATCH

</div>

</div>



<div class="analytics-card">

<div class="analytics-value">

FORM

</div>



<div class="form-display">

<?php

foreach($form as $f){

$class = "";



if($f=="W"){

    $class = "form-win";

}
elseif($f=="L"){

    $class = "form-loss";

}
else{

    $class = "form-draw";

}

?>

<div class="form-item <?php echo $class; ?>">

<?php echo $f; ?>

</div>

<?php } ?>

</div>

</div>

</div>



<!-- MATCH HISTORY -->

<div class="match-history">

<h2>

Recent Matches

</h2>



<?php

while($match = mysqli_fetch_assoc($history)){

$isHome =
$match['home_player_id']
== $player_id;



$playerScore =
$isHome
? $match['home_score']
: $match['away_score'];



$opponentScore =
$isHome
? $match['away_score']
: $match['home_score'];



$opponent =
$isHome
? $match['away_player']
: $match['home_player'];


if($playerScore > $opponentScore){

    $result = "W";
    $resultClass = "win-result";

}
elseif($playerScore < $opponentScore){

    $result = "L";
    $resultClass = "loss-result";

}
else{

    $result = "D";
    $resultClass = "draw-result";

}

?>

<div class="history-card">

<div class="history-top">

<div class="history-result <?php echo $resultClass; ?>">

<?php echo $result; ?>

</div>

<div class="match-round">

🏟 ROUND <?php echo $match['round_no']; ?>

</div>

</div>



<div class="history-main">

<div class="history-player">

<span>

vs

</span>

<?php

echo getFlag(

$isHome
? $match['away_team']
: $match['home_team']

);

?>

<span>

<?php echo $opponent; ?>

</span>

</div>


<div class="history-score">

<?php echo $playerScore; ?>

<span>-</span>

<?php echo $opponentScore; ?>

</div>

</div>



<div class="history-footer">

<div class="history-mvp">

🏆 MVP:
<b>

<?php

echo $match['mvp_name']
?? 'Not Selected';

?>

</b>

</div>

</div>

</div>

<?php } ?>

</body>
</html>