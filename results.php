<?php
include __DIR__ . '/assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Results
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



/* RESULTS SECTION */

.results-section{

    padding:0 60px 120px;

}



/* GRID */

.results-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(340px,1fr));

    gap:30px;

}



/* CARD */

.result-card{

    background:
    rgba(18,18,18,0.8);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:28px;

    padding:38px;

    position:relative;

    overflow:hidden;

    backdrop-filter:blur(14px);

    transition:0.4s;

}



/* GLOW */

.result-card::before{

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

.result-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 40px rgba(255,153,0,0.12);

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

    font-weight:bold;

    margin-bottom:30px;

}



/* MATCH */

.result-match{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

}



/* PLAYER */

.result-player{

    width:40%;

    text-align:center;

    font-size:24px;

    font-weight:bold;

    line-height:1.5;

}



/* SCORE */

.result-score{

    font-size:48px;

    font-weight:bold;

    color:#ff9900;

    text-shadow:
    0 0 18px rgba(255,153,0,0.7);

}



/* STATUS */

.result-status{

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



/* DRAW */

.draw{

    color:#ffcc00;

    font-weight:bold;

}



/* MOBILE */

@media(max-width:768px){

    .page-header h1{

        font-size:42px;

    }

    .results-section{

        padding:0 25px 80px;

    }

    .result-player{

        font-size:18px;

    }

    .result-score{

        font-size:34px;

    }

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
p2.player_name AS away_player

FROM fixtures

JOIN players p1
ON fixtures.home_player_id = p1.id

JOIN players p2
ON fixtures.away_player_id = p2.id

WHERE match_status='completed'

ORDER BY fixtures.id DESC"

);

?>



<!-- RESULTS -->

<section class="results-section">

<div class="results-grid">

<?php

while($row = mysqli_fetch_assoc($results)){

?>

<div class="result-card">


    <!-- ROUND -->

    <div class="result-round">

        ROUND

        <?php echo $row['round_no']; ?>

    </div>



    <!-- MATCH -->

    <div class="result-match">

        <div class="result-player">

            <?php echo $row['home_player']; ?>

        </div>



        <div class="result-score">

            <?php echo $row['home_score']; ?>

            -

            <?php echo $row['away_score']; ?>

        </div>



        <div class="result-player">

            <?php echo $row['away_player']; ?>

        </div>

    </div>



    <!-- STATUS -->

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