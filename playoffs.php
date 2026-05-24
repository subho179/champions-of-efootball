<?php
include __DIR__ . '/assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Playoffs
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



/* PLAYOFF SECTION */

.playoff-section{

    padding:0 60px 120px;

}



/* GRID */

.playoff-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(360px,1fr));

    gap:35px;

}



/* CARD */

.playoff-card{

    background:
    linear-gradient(
        135deg,
        rgba(20,20,20,0.88),
        rgba(10,10,10,0.95)
    );

    border:
    1px solid rgba(255,153,0,0.14);

    border-radius:30px;

    padding:40px;

    position:relative;

    overflow:hidden;

    backdrop-filter:blur(16px);

    transition:0.4s;

}



/* GLOW */

.playoff-card::before{

    content:"";

    position:absolute;

    width:240px;

    height:240px;

    background:#ff9900;

    filter:blur(120px);

    opacity:0.08;

    top:-70px;

    right:-70px;

}



/* HOVER */

.playoff-card:hover{

    transform:
    translateY(-10px)
    scale(1.02);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 45px rgba(255,153,0,0.15);

}



/* STAGE */

.playoff-stage{

    display:inline-block;

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:12px 22px;

    border-radius:40px;

    font-size:14px;

    font-weight:bold;

    margin-bottom:35px;

    letter-spacing:1px;

}



/* MATCH */

.playoff-match{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

}



/* PLAYER */

.playoff-player{

    width:40%;

    text-align:center;

    font-size:24px;

    font-weight:bold;

    line-height:1.5;

}



/* VS */

.playoff-vs{

    font-size:34px;

    color:#ff9900;

    text-shadow:
    0 0 20px rgba(255,153,0,0.8);

}



/* SCORE */

.playoff-score{

    text-align:center;

    font-size:42px;

    font-weight:bold;

    color:#ff9900;

    margin-bottom:25px;

    text-shadow:
    0 0 18px rgba(255,153,0,0.7);

}



/* STATUS */

.playoff-status{

    text-align:center;

    color:#bdbdbd;

    font-size:15px;

    letter-spacing:1px;

}



/* WINNER */

.winner{

    color:#4dff88;

    font-weight:bold;

}



/* PENDING */

.pending{

    color:#ffcc00;

    font-weight:bold;

}



/* MOBILE */

@media(max-width:768px){

    .page-header h1{

        font-size:42px;

    }

    .playoff-section{

        padding:0 25px 80px;

    }

    .playoff-player{

        font-size:18px;

    }

    .playoff-score{

        font-size:30px;

    }

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<!-- HEADER -->

<section class="page-header">

<h1>

CHAMPIONSHIP

<span>

PLAYOFFS

</span>

</h1>

<p>

The ultimate BO3 battles for
India’s eFootball crown.

</p>

</section>



<?php

$playoffs = mysqli_query($conn,

"SELECT playoff_matches.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM playoff_matches

LEFT JOIN players p1
ON playoff_matches.home_player_id = p1.id

LEFT JOIN players p2
ON playoff_matches.away_player_id = p2.id

ORDER BY playoff_matches.id ASC"

);

?>



<!-- PLAYOFFS -->

<section class="playoff-section">

<div class="playoff-grid">

<?php

while($row = mysqli_fetch_assoc($playoffs)){

?>

<div class="playoff-card">


    <!-- STAGE -->

    <div class="playoff-stage">

        <?php echo strtoupper($row['stage']); ?>

        • BO3

    </div>



    <!-- MATCH -->

    <div class="playoff-match">

        <div class="playoff-player">

            <?php echo $row['home_player'] ?? 'TBD'; ?>

        </div>



        <div class="playoff-vs">

            ⚔️

        </div>



        <div class="playoff-player">

            <?php echo $row['away_player'] ?? 'TBD'; ?>

        </div>

    </div>



    <!-- SCORE -->

    <div class="playoff-score">

        <?php echo $row['home_wins'] ?? 0; ?>

        -

        <?php echo $row['away_wins'] ?? 0; ?>

    </div>



    <!-- STATUS -->

    <div class="playoff-status">

        <?php

        if($row['match_status'] == 'completed'){

            echo "<span class='winner'>
                  ✅ Series Completed
                  </span>";

        }else{

            echo "<span class='pending'>
                  🔥 Upcoming Battle
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