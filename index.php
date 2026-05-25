<?php
include __DIR__ . '/assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="icon"
      type="image/x-icon"
      href="favicon.ico">
    
    <title>
        Champions of eFootball
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

    width:100%;

}



        /* HERO */

        .hero{

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            text-align:center;

            padding:40px;

            position:relative;
			
            width:100%;
            
			max-width:100%;
            
			overflow:hidden;
        }



        /* GLOW EFFECT */

        .hero::before{

            content:"";

            position:absolute;

            width:500px;

            height:500px;

            background:#ff9900;

            filter:blur(180px);

            opacity:0.15;

            border-radius:50%;

            top:10%;

            z-index:-1;

        }



        .hero-content{

            max-width:950px;

        }



        /* TITLE */

        .hero h1{

            font-size:90px;

            line-height:1.1;

            margin-bottom:25px;

            text-transform:uppercase;

            letter-spacing:3px;

        }



        .hero h1 span{

            color:#ff9900;

            text-shadow:
            0 0 15px #ff9900,
            0 0 35px #ff6600;

        }



        /* SUBTITLE */

        .hero p{

            font-size:24px;

            color:#bdbdbd;

            line-height:1.7;

            margin-bottom:40px;

        }



        /* BUTTONS */

        .hero-buttons{

            display:flex;

            justify-content:center;

            gap:25px;

            flex-wrap:wrap;

        }



        .btn-primary{

            background:
            linear-gradient(
                135deg,
                #ff9900,
                #ff6600
            );

            color:black;

            padding:18px 34px;

            border-radius:14px;

            text-decoration:none;

            font-weight:bold;

            font-size:18px;

            transition:0.3s;

            box-shadow:
            0 0 20px rgba(255,153,0,0.45);

        }



        .btn-primary:hover{

            transform:translateY(-4px);

            box-shadow:
            0 0 35px rgba(255,153,0,0.9);

        }



        .btn-secondary{

            border:2px solid #ff9900;

            color:#ff9900;

            padding:18px 34px;

            border-radius:14px;

            text-decoration:none;

            font-weight:bold;

            font-size:18px;

            transition:0.3s;

        }



        .btn-secondary:hover{

            background:#ff9900;

            color:black;

            box-shadow:
            0 0 30px rgba(255,153,0,0.8);

        }



        /* LIVE TAG */

        .live-badge{

            display:inline-block;

            background:rgba(255,153,0,0.15);

            border:1px solid rgba(255,153,0,0.4);

            color:#ff9900;

            padding:12px 22px;

            border-radius:40px;

            margin-bottom:25px;

            font-weight:bold;

            backdrop-filter:blur(10px);

        }



        /* MOBILE */

        @media(max-width:900px){

            .hero h1{

                font-size:55px;

            }

            .hero p{

                font-size:19px;

            }

        }
        /* GLOBAL MOBILE FIX */

html,
body{

    width:100%;

    overflow-x:hidden;

}



*{

    max-width:100%;

}

/* HERO BUTTONS */

.hero-buttons{

    display:flex;

    gap:25px;

    justify-content:center;

    flex-wrap:wrap;

    margin-top:50px;

}



/* BUTTON */

.hero-btn{

    display:inline-block;

    padding:18px 38px;

    border-radius:18px;

    text-decoration:none;

    font-size:22px;

    font-weight:bold;

    transition:0.3s;

}



/* PRIMARY */

.hero-btn-primary{

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ff6600
    );

    color:black;

    box-shadow:
    0 0 30px rgba(255,153,0,0.45);

}



/* SECONDARY */

.hero-btn-secondary{

    border:
    2px solid #ff9900;

    color:#ff9900;

    background:transparent;

}



/* HOVER */

.hero-btn:hover{

    transform:translateY(-4px);

}



/* MOBILE */

@media(max-width:768px){

    .hero-btn{

        width:100%;

        text-align:center;

        font-size:20px;

    }

}

    </style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<!-- HERO SECTION -->

<section class="hero">

    <div class="hero-content">


        <!-- LIVE BADGE -->

        <div class="live-badge">

            ⚡ INDIA'S FUTURE OF eFOOTBALL ESPORTS

        </div>



        <!-- TITLE -->

        <h1>

            CHAMPIONS OF

            <span>

                eFOOTBALL

            </span>

        </h1>



        <!-- SUBTITLE -->

        <p>

            India’s futuristic competitive
            eFootball league platform featuring
            dynamic leagues, live standings,
            BO3 playoffs, advanced stats,
            and elite esports competition.

        </p>



        <!-- BUTTONS -->

        <div class="hero-buttons">

    <a href="register.php"
    class="hero-btn hero-btn-primary">

    Join Tournament

    </a>



    <a href="fixtures.php"
    class="hero-btn hero-btn-secondary">

    Upcoming Fixtures

    </a>

	</div>

    </div>

</section>

<?php

// TOTAL PLAYERS

$total_players = mysqli_num_rows(

mysqli_query($conn,
"SELECT * FROM players")

);


// TOTAL MATCHES

$total_matches = mysqli_num_rows(

mysqli_query($conn,
"SELECT * FROM fixtures")

);


// COMPLETED MATCHES

$completed_matches = mysqli_num_rows(

mysqli_query($conn,

"SELECT * FROM fixtures
 WHERE match_status='completed'")

);


// TOP SCORER

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

);

?>



<!-- STATS SECTION -->

<section class="stats-section">

    <div class="section-title">

        ⚡ LIVE LEAGUE STATS

    </div>



    <div class="stats-grid">


        <!-- PLAYERS -->

        <div class="stat-card">

            <div class="stat-icon">
                👥
            </div>

            <div class="stat-number">

                <?php echo $total_players; ?>

            </div>

            <div class="stat-label">
                Registered Players
            </div>

        </div>



        <!-- MATCHES -->

        <div class="stat-card">

            <div class="stat-icon">
                ⚽
            </div>

            <div class="stat-number">

                <?php echo $total_matches; ?>

            </div>

            <div class="stat-label">
                Total Fixtures
            </div>

        </div>



        <!-- COMPLETED -->

        <div class="stat-card">

            <div class="stat-icon">
                ✅
            </div>

            <div class="stat-number">

                <?php echo $completed_matches; ?>

            </div>

            <div class="stat-label">
                Completed Matches
            </div>

        </div>



        <!-- TOP SCORER -->

        <div class="stat-card">

            <div class="stat-icon">
                🏆
            </div>

            <div class="stat-number">

                <?php

                if($top_scorer){

                    echo $top_scorer['goals_for'];

                }else{

                    echo 0;

                }

                ?>

            </div>

            <div class="stat-label">

                Top Scorer Goals

            </div>

        </div>

    </div>

</section>



<style>

/* STATS SECTION */

.stats-section{

    padding:120px 60px;

    position:relative;

}



/* SECTION TITLE */

.section-title{

    text-align:center;

    font-size:42px;

    font-weight:bold;

    margin-bottom:70px;

    color:white;

    letter-spacing:2px;

}

.section-title::after{

    content:"";

    display:block;

    width:120px;

    height:4px;

    background:#ff9900;

    margin:18px auto;

    border-radius:10px;

    box-shadow:
    0 0 20px #ff9900;

}



/* GRID */

.stats-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:30px;

}



/* CARD */

.stat-card{

    background:
    rgba(20,20,20,0.75);

    border:
    1px solid rgba(255,153,0,0.15);

    border-radius:24px;

    padding:45px 30px;

    text-align:center;

    backdrop-filter:blur(14px);

    transition:0.4s;

    position:relative;

    overflow:hidden;

}



/* GLOW */

.stat-card::before{

    content:"";

    position:absolute;

    width:180px;

    height:180px;

    background:#ff9900;

    filter:blur(90px);

    opacity:0.08;

    top:-40px;

    right:-40px;

}



/* HOVER */

.stat-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.6);

    box-shadow:
    0 0 35px rgba(255,153,0,0.15);

}



/* ICON */

.stat-icon{

    font-size:52px;

    margin-bottom:25px;

}



/* NUMBER */

.stat-number{

    font-size:58px;

    font-weight:bold;

    color:#ff9900;

    margin-bottom:15px;

    text-shadow:
    0 0 20px rgba(255,153,0,0.5);

}



/* LABEL */

.stat-label{

    font-size:18px;

    color:#bdbdbd;

    letter-spacing:1px;

}



/* MOBILE */

@media(max-width:768px){

    .stats-section{

        padding:90px 25px;

    }

    .section-title{

        font-size:32px;

    }

    .stat-number{

        font-size:46px;

    }

}

</style>

</body>
<?php

$recent_results = mysqli_query($conn,

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

LIMIT 6"

);

?>



<!-- RECENT RESULTS -->

<section class="results-section">

    <div class="section-title">

        🔥 RECENT RESULTS

    </div>



    <div class="results-grid">


        <?php

        while($row = mysqli_fetch_assoc($recent_results)){

        ?>



        <div class="result-card">


            <!-- ROUND -->

            <div class="round-badge">

                ROUND

                <?php echo $row['round_no']; ?>

            </div>



            <!-- PLAYERS -->

            <div class="match-players">


                <div class="player">

                    <?php echo $row['home_player']; ?>

                </div>



                <div class="vs">

                    VS

                </div>



                <div class="player">

                    <?php echo $row['away_player']; ?>

                </div>

            </div>



            <!-- SCORE -->

            <div class="score-box">

                <?php echo $row['home_score']; ?>

                <span>-</span>

                <?php echo $row['away_score']; ?>

            </div>



            <!-- WINNER -->

            <div class="winner-text">

                <?php

                if($row['home_score']
                > $row['away_score']){

                    echo $row['home_player']
                    ." WON";

                }

                elseif($row['away_score']
                > $row['home_score']){

                    echo $row['away_player']
                    ." WON";

                }

                else{

                    echo "DRAW MATCH";

                }

                ?>

            </div>

        </div>



        <?php } ?>

    </div>

</section>



<style>

/* RESULTS SECTION */

.results-section{

    padding:120px 60px;

}



/* GRID */

.results-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:30px;

}



/* CARD */

.result-card{

    background:
    rgba(18,18,18,0.78);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:24px;

    padding:35px;

    backdrop-filter:blur(14px);

    position:relative;

    overflow:hidden;

    transition:0.4s;

}



/* GLOW */

.result-card::before{

    content:"";

    position:absolute;

    width:180px;

    height:180px;

    background:#ff9900;

    filter:blur(100px);

    opacity:0.08;

    top:-40px;

    right:-40px;

}



/* HOVER */

.result-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.45);

    box-shadow:
    0 0 35px rgba(255,153,0,0.12);

}



/* ROUND */

.round-badge{

    display:inline-block;

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:10px 18px;

    border-radius:30px;

    font-size:13px;

    font-weight:bold;

    margin-bottom:28px;

}



/* PLAYERS */

.match-players{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

}



.player{

    width:40%;

    font-size:22px;

    font-weight:bold;

    text-align:center;

}



.vs{

    color:#ff9900;

    font-size:18px;

    font-weight:bold;

}



/* SCORE */

.score-box{

    text-align:center;

    font-size:58px;

    font-weight:bold;

    color:#ff9900;

    margin-bottom:22px;

    text-shadow:
    0 0 20px rgba(255,153,0,0.55);

}

.score-box span{

    margin:0 12px;

}



/* WINNER */

.winner-text{

    text-align:center;

    color:#bdbdbd;

    font-size:16px;

    letter-spacing:1px;

}



/* MOBILE */

@media(max-width:768px){

    .results-section{

        padding:90px 25px;

    }

    .score-box{

        font-size:42px;

    }

    .player{

        font-size:18px;

    }

}

</style>

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

?>



<!-- LEADERBOARD SECTION -->

<section class="leaderboard-section">

    <div class="section-title">

        🏆 TOP LEADERBOARD

    </div>



    <div class="leaderboard-container">


        <?php

        $rank = 1;

        while($row = mysqli_fetch_assoc($leaders)){

        ?>



        <div class="leaderboard-card">


            <!-- RANK -->

            <div class="leader-rank">

                #<?php echo $rank; ?>

            </div>



            <!-- PLAYER -->

            <div class="leader-info">

                <div class="leader-name">

                    <?php echo $row['player_name']; ?>

                </div>

                <div class="leader-stats">

                    W:
                    <?php echo $row['wins']; ?>

                    • GD:
                    <?php echo $row['goal_difference']; ?>

                </div>

            </div>



            <!-- POINTS -->

            <div class="leader-points">

                <?php echo $row['points']; ?>

                <span>PTS</span>

            </div>

        </div>



        <?php

        $rank++;

        }

        ?>

    </div>

</section>



<style>

/* LEADERBOARD */

.leaderboard-section{

    padding:120px 60px;

}



/* CONTAINER */

.leaderboard-container{

    max-width:1000px;

    margin:auto;

}



/* CARD */

.leaderboard-card{

    background:
    rgba(18,18,18,0.78);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:22px;

    padding:28px 35px;

    margin-bottom:22px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    backdrop-filter:blur(14px);

    transition:0.35s;

    position:relative;

    overflow:hidden;

}



/* GLOW */

.leaderboard-card::before{

    content:"";

    position:absolute;

    width:160px;

    height:160px;

    background:#ff9900;

    filter:blur(100px);

    opacity:0.07;

    top:-40px;

    right:-40px;

}



/* HOVER */

.leaderboard-card:hover{

    transform:translateY(-6px);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 35px rgba(255,153,0,0.12);

}



/* RANK */

.leader-rank{

    font-size:34px;

    font-weight:bold;

    color:#ff9900;

    width:90px;

    text-shadow:
    0 0 18px rgba(255,153,0,0.5);

}



/* INFO */

.leader-info{

    flex:1;

}



.leader-name{

    font-size:24px;

    font-weight:bold;

    margin-bottom:10px;

}



.leader-stats{

    color:#a8a8a8;

    font-size:15px;

}



/* POINTS */

.leader-points{

    font-size:42px;

    font-weight:bold;

    color:#ff9900;

    text-shadow:
    0 0 20px rgba(255,153,0,0.55);

}



.leader-points span{

    font-size:15px;

    color:#ccc;

    margin-left:5px;

}



/* MOBILE */

@media(max-width:768px){

    .leaderboard-section{

        padding:90px 20px;

    }

    .leaderboard-card{

        flex-direction:column;

        gap:20px;

        text-align:center;

    }

    .leader-rank{

        width:auto;

    }

}

</style>

<?php

$upcoming = mysqli_query($conn,

"SELECT fixtures.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM fixtures

JOIN players p1
ON fixtures.home_player_id = p1.id

JOIN players p2
ON fixtures.away_player_id = p2.id

WHERE match_status='pending'

ORDER BY round_no ASC

LIMIT 6"

);

?>



<!-- FIXTURES PREVIEW -->

<section class="fixtures-section">

    <div class="section-title">

        ⚔️ UPCOMING FIXTURES

    </div>



    <div class="fixtures-grid">


        <?php

        while($row = mysqli_fetch_assoc($upcoming)){

        ?>



        <div class="fixture-card">


            <!-- ROUND -->

            <div class="fixture-round">

                ROUND

                <?php echo $row['round_no']; ?>

            </div>



            <!-- MATCH -->

            <div class="fixture-match">


                <div class="fixture-player">

                    <?php echo $row['home_player']; ?>

                </div>



                <div class="fixture-vs">

                    VS

                </div>



                <div class="fixture-player">

                    <?php echo $row['away_player']; ?>

                </div>

            </div>



            <!-- STATUS -->

            <div class="fixture-status">

                ⏳ Match Pending

            </div>

        </div>



        <?php } ?>

    </div>

</section>



<style>

/* FIXTURES SECTION */

.fixtures-section{

    padding:120px 60px;

}



/* GRID */

.fixtures-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:30px;

}



/* CARD */

.fixture-card{

    background:
    rgba(18,18,18,0.78);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:24px;

    padding:35px;

    text-align:center;

    backdrop-filter:blur(14px);

    transition:0.4s;

    position:relative;

    overflow:hidden;

}



/* GLOW EFFECT */

.fixture-card::before{

    content:"";

    position:absolute;

    width:180px;

    height:180px;

    background:#ff9900;

    filter:blur(100px);

    opacity:0.07;

    top:-40px;

    right:-40px;

}



/* HOVER */

.fixture-card:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(255,153,0,0.5);

    box-shadow:
    0 0 35px rgba(255,153,0,0.12);

}



/* ROUND */

.fixture-round{

    display:inline-block;

    background:
    rgba(255,153,0,0.12);

    color:#ff9900;

    padding:10px 18px;

    border-radius:30px;

    font-size:13px;

    font-weight:bold;

    margin-bottom:28px;

}



/* MATCH */

.fixture-match{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

}



/* PLAYER */

.fixture-player{

    width:40%;

    font-size:22px;

    font-weight:bold;

}



/* VS */

.fixture-vs{

    color:#ff9900;

    font-size:20px;

    font-weight:bold;

    text-shadow:
    0 0 15px rgba(255,153,0,0.7);

}



/* STATUS */

.fixture-status{

    color:#bdbdbd;

    font-size:16px;

    letter-spacing:1px;

}



/* MOBILE */

@media(max-width:768px){

    .fixtures-section{

        padding:90px 25px;

    }

    .fixture-player{

        font-size:18px;

    }

}

</style>

<?php

$playoff_preview = mysqli_query($conn,

"SELECT playoff_matches.*,

p1.player_name AS home_player,
p2.player_name AS away_player

FROM playoff_matches

LEFT JOIN players p1
ON playoff_matches.home_player_id = p1.id

LEFT JOIN players p2
ON playoff_matches.away_player_id = p2.id

GROUP BY stage, series_group

ORDER BY id ASC

LIMIT 4"

);

?>



<!-- PLAYOFF PREVIEW -->

<section class="playoff-section">

    <div class="section-title">

        🏆 PLAYOFF BATTLES

    </div>



    <div class="playoff-grid">


        <?php

        while($row = mysqli_fetch_assoc($playoff_preview)){

        ?>



        <div class="playoff-card">


            <!-- STAGE -->

            <div class="playoff-stage">

                <?php

                echo strtoupper($row['stage']);

                ?>

                • BO3

            </div>



            <!-- PLAYERS -->

            <div class="playoff-match">

                <div class="playoff-player">

                    <?php echo $row['home_player']; ?>

                </div>



                <div class="playoff-vs">

                    ⚔️

                </div>



                <div class="playoff-player">

                    <?php echo $row['away_player']; ?>

                </div>

            </div>



            <!-- STATUS -->

            <div class="playoff-status">

                <?php

                if($row['match_status']
                == 'completed'){

                    echo "✅ Series Active";

                }else{

                    echo "🔥 Upcoming Battle";

                }

                ?>

            </div>

        </div>



        <?php } ?>

    </div>

</section>



<style>

/* PLAYOFF SECTION */

.playoff-section{

    padding:120px 60px;

    position:relative;

}



/* GRID */

.playoff-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:30px;

}



/* CARD */

.playoff-card{

    background:
    linear-gradient(
        135deg,
        rgba(30,30,30,0.82),
        rgba(12,12,12,0.88)
    );

    border:
    1px solid rgba(255,153,0,0.14);

    border-radius:28px;

    padding:40px 30px;

    text-align:center;

    position:relative;

    overflow:hidden;

    transition:0.4s;

    backdrop-filter:blur(16px);

}



/* GOLD GLOW */

.playoff-card::before{

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

.playoff-card:hover{

    transform:
    translateY(-10px)
    scale(1.02);

    border-color:
    rgba(255,153,0,0.55);

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

    margin-bottom:32px;

    letter-spacing:1px;

}



/* MATCH */

.playoff-match{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:38px;

}



/* PLAYER */

.playoff-player{

    width:40%;

    font-size:24px;

    font-weight:bold;

    line-height:1.4;

}



/* VS */

.playoff-vs{

    font-size:34px;

    color:#ff9900;

    text-shadow:
    0 0 20px rgba(255,153,0,0.8);

}



/* STATUS */

.playoff-status{

    color:#d0d0d0;

    font-size:16px;

    letter-spacing:1px;

}



/* MOBILE */

@media(max-width:768px){

    .playoff-section{

        padding:90px 25px;

    }

    .playoff-player{

        font-size:18px;

    }

}

</style>

<!-- FOOTER -->

<footer class="footer">


    <!-- LOGO -->

    <div class="footer-logo">

        🏆 COE

    </div>



    <!-- TEXT -->

    <p class="footer-text">

        Champions of eFootball —
        India’s futuristic esports league platform.

    </p>



 <!-- SOCIAL ICONS -->

<div class="social-links">


    <!-- DISCORD -->

    <a href="https://discord.gg/YOURSERVER"
       class="social-icon discord"
       target="_blank">

       <i class="fab fa-discord"></i>

    </a>



    <!-- INSTAGRAM -->

    <a href="https://www.instagram.com/champions_of_efootball?igsh=OW5kNDZrcGd4Zmgw"
       class="social-icon instagram"
       target="_blank">

       <i class="fab fa-instagram"></i>

    </a>



    <!-- YOUTUBE -->

    <a href="https://youtube.com"
       class="social-icon youtube"
       target="_blank">

       <i class="fab fa-youtube"></i>

    </a>



    <!-- WHATSAPP -->

    <a href="https://wa.me/91XXXXXXXXXX"
       class="social-icon whatsapp"
       target="_blank">

       <i class="fab fa-whatsapp"></i>

    </a>



    <!-- GITHUB -->

    <a href="https://github.com"
       class="social-icon github"
       target="_blank">

       <i class="fab fa-github"></i>

    </a>

</div>



    <!-- COPYRIGHT -->

    <div class="footer-bottom">

        © <?php echo date("Y"); ?>

        Champions of eFootball.
        All Rights Reserved.

    </div>

</footer>



<style>

/* FOOTER */

.footer{

    margin-top:120px;

    padding:70px 20px 40px;

    text-align:center;

    background:
    linear-gradient(
        to top,
        rgba(255,153,0,0.06),
        rgba(0,0,0,0.95)
    );

    border-top:
    1px solid rgba(255,153,0,0.12);

}



/* LOGO */

.footer-logo{

    font-size:42px;

    font-weight:bold;

    color:#ff9900;

    margin-bottom:20px;

    text-shadow:
    0 0 20px rgba(255,153,0,0.7);

}



/* TEXT */

.footer-text{

    color:#bdbdbd;

    max-width:650px;

    margin:auto;

    line-height:1.8;

    font-size:18px;

    margin-bottom:45px;

}



/* SOCIALS */

.social-links{

    display:flex;

    justify-content:center;

    gap:22px;

    flex-wrap:wrap;

    margin-bottom:45px;

}



/* ICON */

.social-icon{

    width:68px;

    height:68px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    text-decoration:none;

    font-size:30px;

    transition:0.35s;

    position:relative;

    overflow:hidden;

    border:
    1px solid rgba(255,255,255,0.08);

}



/* DISCORD */

.discord{

    background:
    rgba(88,101,242,0.12);

    color:#5865F2;

    box-shadow:
    0 0 20px rgba(88,101,242,0.2);

}



/* INSTAGRAM */

.instagram{

    background:
    rgba(255,0,120,0.12);

    color:#ff4da6;

    box-shadow:
    0 0 20px rgba(255,0,120,0.2);

}



/* YOUTUBE */

.youtube{

    background:
    rgba(255,0,0,0.12);

    color:#ff3333;

    box-shadow:
    0 0 20px rgba(255,0,0,0.2);

}



/* WHATSAPP */

.whatsapp{

    background:
    rgba(37,211,102,0.12);

    color:#25D366;

    box-shadow:
    0 0 20px rgba(37,211,102,0.2);

}

/* GITHUB */

.github{

    background:
    rgba(255,255,255,0.08);

    color:white;

    box-shadow:
    0 0 20px rgba(255,255,255,0.12);

}

/* HOVER */

.social-icon:hover{

    transform:
    translateY(-8px)
    scale(1.1);

}



/* GLOW */

.social-icon::before{

    content:"";

    position:absolute;

    width:100%;

    height:100%;

    background:
    rgba(255,255,255,0.08);

    top:-100%;

    left:0;

    transition:0.4s;

}



/* SHINE */

.social-icon:hover::before{

    top:0;

}



/* COPYRIGHT */

.footer-bottom{

    color:#777;

    font-size:15px;

    border-top:
    1px solid rgba(255,255,255,0.06);

    padding-top:25px;

}



/* MOBILE */

@media(max-width:768px){

    .footer-logo{

        font-size:34px;

    }

    .footer-text{

        font-size:16px;

    }

    .social-icon{

        width:58px;

        height:58px;

        font-size:24px;

    }

}

</style>

</html>