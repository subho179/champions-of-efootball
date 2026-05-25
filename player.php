<?php

include 'assets/db.php';



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

$wins = $player['wins'] ?? 0;
$losses = $player['losses'] ?? 0;
$draws = $player['draws'] ?? 0;
$goals_scored = $player['goals_scored'] ?? 0;
$goals_conceded = $player['goals_conceded'] ?? 0;
$points = $player['points'] ?? 0;

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

    min-height:100vh;

    overflow-x:hidden;

}



/* CONTAINER */

.profile-container{

    width:100%;

    max-width:1200px;

    margin:60px auto;

    padding:20px;

}



/* PROFILE CARD */

.profile-card{

    background:
    rgba(18,18,18,0.88);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:30px;

    padding:40px;

    backdrop-filter:blur(14px);

    overflow:hidden;

    position:relative;

}



/* GLOW */

.profile-card::before{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    background:#ff9900;

    filter:blur(140px);

    opacity:0.08;

    top:-80px;

    right:-80px;

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
    0 0 30px rgba(255,153,0,0.35);

}



/* INFO */

.profile-info h1{

    font-size:48px;

    margin-bottom:12px;

}



.team-name{

    font-size:24px;

    color:#ff9900;

    margin-bottom:10px;

}



.favorite-team{

    color:#bdbdbd;

    font-size:18px;

}



/* STATS */

.stats-grid{

    margin-top:50px;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(180px,1fr));

    gap:25px;

}



/* CARD */

.stat-card{

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:22px;

    padding:30px;

    text-align:center;

    transition:0.3s;

}



.stat-card:hover{

    transform:translateY(-5px);

    border-color:
    rgba(255,153,0,0.3);

}



/* VALUE */

.stat-value{

    font-size:42px;

    font-weight:bold;

    color:#ff9900;

    margin-bottom:10px;

}



/* LABEL */

.stat-label{

    color:#bdbdbd;

    font-size:16px;

}



/* MOBILE */

@media(max-width:768px){

    .profile-top{

        flex-direction:column;

        text-align:center;

    }



    .profile-info h1{

        font-size:36px;

    }



    .profile-image img{

        width:150px;

        height:150px;

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

<img src="<?php
echo $player['profile_pic'];
?>">

</div>



<div class="profile-info">

<h1>

<?php
echo $player['player_name'];
?>

</h1>



<div class="team-name">

<?php
echo $player['team_name'];
?>

</div>



<div class="favorite-team">

Favorite Nation:
<b>

<?php
echo $player['favorite_team'];
?>

</b>

</div>

</div>

</div>



<div class="stats-grid">



<div class="stat-card">

<div class="stat-value">

<?php echo $wins; ?>

</div>

<div class="stat-label">

Wins

</div>

</div>



<div class="stat-card">

<div class="stat-value">

<?php echo $losses; ?>

</div>

<div class="stat-label">

Losses

</div>

</div>



<div class="stat-card">

<div class="stat-value">

<?php echo $draws; ?>

</div>

<div class="stat-label">

Draws

</div>

</div>



<div class="stat-card">

<div class="stat-value">

<?php echo $goals_scored; ?>

</div>

<div class="stat-label">

Goals Scored

</div>

</div>



<div class="stat-card">

<div class="stat-value">

<?php echo $goals_conceded; ?>

</div>

<div class="stat-label">

Goals Conceded

</div>

</div>



<div class="stat-card">

<div class="stat-value">

<?php echo $points; ?>

</div>

<div class="stat-label">

Points

</div>

</div>

</div>

</div>

</div>

</body>
</html>