<?php
include __DIR__ . '/assets/db.php';
include 'includes/rank-system.php';
include 'includes/flag-system.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Standings
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

    font-family:'Orbitron',sans-serif;

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



/* TABLE */

.table-section{

    padding:0 60px 120px;
}

.table-wrapper{

    overflow-x:auto;

    border-radius:26px;

    border:
    1px solid rgba(255,153,0,0.12);

    background:
    rgba(18,18,18,0.82);
}

table{

    width:100%;

    border-collapse:collapse;
}



/* HEADER */

table th{

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:22px;

    font-family:'Orbitron',sans-serif;

    font-size:15px;
}



/* CELLS */

table td{

    padding:22px;

    text-align:center;

    border-bottom:
    1px solid rgba(255,255,255,0.05);
}



/* PLAYER */

.player-link{

    color:white;

    text-decoration:none;

    font-weight:700;

    transition:0.3s;
}

.player-link:hover{

    color:#ff9900;
}



/* FLAG */

.country-flag{

    width:28px;

    height:20px;

    object-fit:cover;

    border-radius:4px;

    margin-right:8px;

    vertical-align:middle;
}



/* RANK BADGE */

.rank-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    padding:10px 20px;

    border-radius:999px;

    font-size:13px;

    font-weight:700;

    text-transform:uppercase;
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
    0 0 18px rgba(179,84,255,0.45);
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
    0 0 16px rgba(255,183,0,0.28);
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
    0 0 14px rgba(255,255,255,0.12);
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
    0 0 14px rgba(255,140,80,0.18);
}



/* MOVEMENT */

.move{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:8px 14px;

    border-radius:999px;

    font-size:12px;

    font-weight:700;

    min-width:70px;
}

.move.up{

    background:
    rgba(0,255,120,0.12);

    color:#4dff88;
}

.move.down{

    background:
    rgba(255,70,70,0.12);

    color:#ff6b6b;
}

.move.same{

    background:
    rgba(255,255,255,0.08);

    color:#d0d0d0;
}

.move.new{

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;
}



/* COUNTER */

.counter{

    color:#ff9900;

    font-family:'Orbitron',sans-serif;

    font-size:20px;
}



/* ROWS */

tbody tr{

    transition:0.35s;

    animation:
    rowReveal 0.8s ease forwards;

    opacity:0;

    transform:translateY(20px);
}

tbody tr:hover{

    background:
    rgba(255,153,0,0.05);

    transform:
    scale(1.01);
}



/* TOP 3 GLOW */

tbody tr:nth-child(1){

    background:
    linear-gradient(
    90deg,
    rgba(255,183,0,0.08),
    transparent
    );
}

tbody tr:nth-child(2){

    background:
    linear-gradient(
    90deg,
    rgba(220,220,220,0.06),
    transparent
    );
}

tbody tr:nth-child(3){

    background:
    linear-gradient(
    90deg,
    rgba(255,120,60,0.06),
    transparent
    );
}



/* STAGGER */

tbody tr:nth-child(1){animation-delay:0.05s;}
tbody tr:nth-child(2){animation-delay:0.1s;}
tbody tr:nth-child(3){animation-delay:0.15s;}
tbody tr:nth-child(4){animation-delay:0.2s;}
tbody tr:nth-child(5){animation-delay:0.25s;}
tbody tr:nth-child(6){animation-delay:0.3s;}



/* ANIMATION */

@keyframes rowReveal{

    to{

        opacity:1;

        transform:translateY(0);

    }

}



/* MOBILE */

.mobile-standings{

    display:none;
}



/* MOBILE VIEW */

@media(max-width:768px){

    .table-section{

        display:none;
    }

    .page-header h1{

        font-size:42px;
    }

    .mobile-standings{

        display:flex;

        flex-direction:column;

        gap:20px;

        padding:20px;
    }

    .mobile-card{

        background:
        rgba(18,18,18,0.92);

        border:
        1px solid rgba(255,153,0,0.12);

        border-radius:24px;

        padding:20px;

        transition:0.35s;
    }

    .mobile-card:hover{

        transform:
        translateY(-4px);
    }

    .mobile-card:nth-child(1){

        box-shadow:
        0 0 25px rgba(255,183,0,0.15);
    }

    .mobile-card:nth-child(2){

        box-shadow:
        0 0 25px rgba(255,255,255,0.10);
    }

    .mobile-card:nth-child(3){

        box-shadow:
        0 0 25px rgba(255,120,60,0.10);
    }

    .mobile-top{

        display:flex;

        justify-content:space-between;

        align-items:center;

        margin-bottom:18px;
    }

    .mobile-left{

        display:flex;

        align-items:center;

        gap:14px;
    }

    .mobile-position{

        font-size:34px;
    }

    .mobile-player{

        display:flex;

        align-items:center;

        gap:12px;
    }

    .mobile-player-name{

        font-size:22px;

        font-weight:700;
    }

    .mobile-stats{

        display:grid;

        grid-template-columns:
        repeat(5,1fr);

        gap:10px;
    }

    .mobile-stat{

        background:
        rgba(255,255,255,0.03);

        border-radius:16px;

        padding:14px 10px;

        text-align:center;
    }

    .mobile-stat span{

        display:block;

        color:#888;

        font-size:11px;

        margin-bottom:6px;
    }

    .mobile-stat strong{

        font-size:18px;

        color:#ff9900;

        font-family:'Orbitron',sans-serif;
    }

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>

<section class="page-header">

<h1>

LEAGUE
<span>STANDINGS</span>

</h1>

<p>

Elite rankings of India’s
competitive eFootball league.

</p>

</section>

<?php

$table = mysqli_query($conn,

"SELECT standings.*,

players.player_name,
players.team_name

FROM standings

JOIN players
ON standings.player_id = players.id

ORDER BY
points DESC,
goal_difference DESC,
goals_for DESC"

);

?>



<!-- DESKTOP TABLE -->

<section class="table-section">

<div class="table-wrapper">

<table>

<thead>

<tr>

<th>#</th>
<th>Player</th>
<th>Rank</th>
<th>Trend</th>
<th>P</th>
<th>W</th>
<th>D</th>
<th>L</th>
<th>GF</th>
<th>GA</th>
<th>GD</th>
<th>PTS</th>

</tr>

</thead>

<tbody>

<?php

$position = 1;

mysqli_data_seek($table,0);

while($row = mysqli_fetch_assoc($table)){

$playerRank = getRank($row['points']);

$previous =
$row['previous_position'];

$current =
$position;

if($previous == 0){

    $movement =
    '<span class="move new">NEW</span>';

}
else{

    $difference =
    $previous - $current;

    if($difference > 0){

        $movement =
        '<span class="move up">↑ +'.$difference.'</span>';

    }
    elseif($difference < 0){

        $movement =
        '<span class="move down">↓ '.abs($difference).'</span>';

    }
    else{

        $movement =
        '<span class="move same">—</span>';

    }

}

?>

<tr>

<td>

<?php

if($position == 1){

echo "🥇";

}
elseif($position == 2){

echo "🥈";

}
elseif($position == 3){

echo "🥉";

}
else{

echo "#".$position;

}

?>

</td>

<td>

<a href="player.php?player=<?php
echo urlencode($row['player_name']);
?>"

class="player-link">

<?php echo getFlag($row['team_name']); ?>

<?php echo $row['player_name']; ?>

</a>

</td>

<td>

<div class="rank-badge <?php
echo $playerRank['class'];
?>">

<?php echo $playerRank['icon']; ?>

<?php echo strtoupper($playerRank['name']); ?>

</div>

</td>

<td>

<?php echo $movement; ?>

</td>

<td><?php echo $row['played']; ?></td>
<td><?php echo $row['wins']; ?></td>
<td><?php echo $row['draws']; ?></td>
<td><?php echo $row['losses']; ?></td>
<td><?php echo $row['goals_for']; ?></td>
<td><?php echo $row['goals_against']; ?></td>
<td><?php echo $row['goal_difference']; ?></td>

<td>

<span class="counter"

data-target="<?php echo $row['points']; ?>">

0

</span>

</td>

</tr>

<?php

$position++;

}

?>

</tbody>

</table>

</div>

</section>



<!-- MOBILE STANDINGS -->

<section class="mobile-standings">

<?php

mysqli_data_seek($table,0);

$position = 1;

while($row = mysqli_fetch_assoc($table)){

$playerRank = getRank($row['points']);

$previous =
$row['previous_position'];

$current =
$position;

if($previous == 0){

    $movement =
    '<span class="move new">NEW</span>';

}
else{

    $difference =
    $previous - $current;

    if($difference > 0){

        $movement =
        '<span class="move up">↑ +'.$difference.'</span>';

    }
    elseif($difference < 0){

        $movement =
        '<span class="move down">↓ '.abs($difference).'</span>';

    }
    else{

        $movement =
        '<span class="move same">—</span>';

    }

}

?>

<div class="mobile-card">

<div class="mobile-top">

<div class="mobile-left">

<div class="mobile-position">

<?php

if($position == 1){

echo "🥇";

}
elseif($position == 2){

echo "🥈";

}
elseif($position == 3){

echo "🥉";

}
else{

echo "#".$position;

}

?>

</div>

<a href="player.php?player=<?php
echo urlencode($row['player_name']);
?>"

class="player-link mobile-player">

<?php echo getFlag($row['team_name']); ?>

<div>

<div class="mobile-player-name">

<?php echo $row['player_name']; ?>

</div>

<div class="rank-badge <?php
echo $playerRank['class'];
?>">

<?php echo $playerRank['icon']; ?>

<?php echo strtoupper($playerRank['name']); ?>

</div>

</div>

</a>

<?php echo $movement; ?>

</div>

</div>

<div class="mobile-stats">

<div class="mobile-stat">

<span>PTS</span>

<strong>

<?php echo $row['points']; ?>

</strong>

</div>

<div class="mobile-stat">

<span>W</span>

<strong>

<?php echo $row['wins']; ?>

</strong>

</div>

<div class="mobile-stat">

<span>D</span>

<strong>

<?php echo $row['draws']; ?>

</strong>

</div>

<div class="mobile-stat">

<span>L</span>

<strong>

<?php echo $row['losses']; ?>

</strong>

</div>

<div class="mobile-stat">

<span>GD</span>

<strong>

<?php echo $row['goal_difference']; ?>

</strong>

</div>

</div>

</div>

<?php

$position++;

}

?>

</section>



<script>

const counters =
document.querySelectorAll('.counter');

counters.forEach(counter => {

    counter.innerText = '0';

    const updateCounter = () => {

        const target =
        +counter.getAttribute('data-target');

        const current =
        +counter.innerText;

        const increment =
        target / 40;

        if(current < target){

            counter.innerText =
            `${Math.ceil(current + increment)}`;

            setTimeout(updateCounter,40);

        }
        else{

            counter.innerText = target;

        }

    };

    updateCounter();

});

</script>

</body>
</html>	