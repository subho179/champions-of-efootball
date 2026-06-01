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
            font-family:'Exo 2',sans-serif;
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

    padding:120px 25px 80px;

    position:relative;

    overflow:hidden;

}

/* MAIN GLOW */

.hero::before{

    content:"";

    position:absolute;

    width:700px;

    height:700px;

    background:#ff9900;

    filter:blur(220px);

    opacity:.12;

    border-radius:50%;

    left:50%;

    top:-150px;

    transform:translateX(-50%);

    animation:arenaGlow 6s ease-in-out infinite;

}

@keyframes arenaGlow{

    0%,100%{

        opacity:.10;

        transform:
        translateX(-50%)
        scale(1);

    }

    50%{

        opacity:.18;

        transform:
        translateX(-50%)
        scale(1.12);

    }

}

/* CONTENT */

.hero-content{

    max-width:1100px;

    width:100%;

    z-index:2;

}

/* BADGE */

.live-badge{

    display:inline-block;

    padding:12px 24px;

    border-radius:999px;

    background:rgba(255,153,0,0.12);

    border:1px solid rgba(255,153,0,0.25);

    color:#ff9900;

    font-weight:700;

    margin-bottom:30px;

    backdrop-filter:blur(10px);

}

/* TITLE */

.hero-title{

    font-size:82px;

    line-height:1;

    text-transform:uppercase;

    font-family:'Orbitron',sans-serif;

    margin-bottom:30px;

    letter-spacing:2px;

}

.hero-title{

    animation:
    titleReveal 1s ease forwards;

}

@keyframes titleReveal{

    from{

        opacity:0;

        transform:
        translateY(40px);

    }

    to{

        opacity:1;

        transform:
        translateY(0);

    }

}

.hero-title span{

    position:relative;

    overflow:hidden;

}

.hero-title span{

    display:inline;

    color:#ff9900;

    background:none !important;

    box-shadow:none !important;

    text-shadow:
    0 0 10px rgba(255,153,0,.8),
    0 0 20px rgba(255,153,0,.8),
    0 0 40px rgba(255,102,0,.6),
    0 0 80px rgba(255,102,0,.4);

    animation:orangePulse 3s ease-in-out infinite;

}

@keyframes orangePulse{

    0%,100%{

        text-shadow:
        0 0 15px #ff9900,
        0 0 35px #ff6600,
        0 0 60px rgba(255,153,0,.5);

    }

    50%{

        text-shadow:
        0 0 25px #ff9900,
        0 0 55px #ff6600,
        0 0 100px rgba(255,153,0,.8);

    }

}

.hero-title{

    position:relative;
    z-index:2;

}

.hero-content{

    position:relative;
    z-index:2;

}

.hero-title::after{

    content:"";

    position:absolute;

    left:50%;
    top:55%;

    width:500px;
    height:150px;

    transform:translate(-50%,-50%);

    background:radial-gradient(
        ellipse,
        rgba(255,153,0,.18) 0%,
        rgba(255,153,0,.08) 40%,
        transparent 80%
    );

    filter:blur(50px);

    z-index:-1;

    animation:titleSpotlight 4s ease-in-out infinite;

}

@keyframes titleSpotlight{

    0%,100%{

        opacity:.6;

    }

    50%{

        opacity:1;

    }

}

/* SUBTITLE */

.hero-subtitle{

    max-width:750px;

    margin:0 auto;

    font-size:21px;

    color:#bdbdbd;

    line-height:1.8;

}

/* STATS */

.hero-stats{

    display:flex;

    justify-content:center;

    gap:15px;

    flex-wrap:wrap;

    margin:45px 0;

}

.hero-stat{

    padding:12px 18px;

    font-size:15px;

    border-radius:16px;

    background:rgba(255,153,0,0.08);

    border:1px solid rgba(255,153,0,0.15);

    backdrop-filter:blur(10px);

    font-weight:700;

}

.hero-stat{

    transition:.35s;

}

.hero-stat:hover{

    transform:
    translateY(-6px);

    border-color:
    rgba(255,153,0,.4);

    box-shadow:
    0 0 25px rgba(255,153,0,.18);

}

/* BUTTONS */

.hero-buttons{

    display:flex;

    justify-content:center;

    gap:20px;

    flex-wrap:wrap;
    align-items:center;

}

.hero-btn{
    min-width:240px;
    max-width:320px;
    width:auto;
    text-align:center;
    flex:0 0 auto;
}

.hero-btn{

    padding:18px 34px;

    border-radius:18px;

    text-decoration:none;

    font-weight:bold;

    font-size:18px;

    transition:.3s;

}

.hero-btn-primary{

    background:linear-gradient(
    135deg,
    #ff9900,
    #ff6600);

    color:black;

    box-shadow:
    0 0 30px rgba(255,153,0,0.4);

}

.hero-btn-secondary{

    border:2px solid #ff9900;

    color:#ff9900;

}

.hero-btn:hover{

    transform:translateY(-5px);

}

.hero-btn{

    position:relative;

    overflow:hidden;

}

.hero-btn::before{

    content:"";

    position:absolute;

    top:0;

    left:-100%;

    width:100%;

    height:100%;

    background:

    linear-gradient(
    90deg,
    transparent,
    rgba(255,255,255,.25),
    transparent
    );

    transition:.6s;

}

.hero-btn:hover::before{

    left:100%;

}

.scroll-indicator{

    margin-top:60px;

    display:flex;

    flex-direction:column;

    align-items:center;

    gap:12px;

}

.scroll-line{

    width:2px;

    height:45px;

    background:linear-gradient(
        to bottom,
        #ff9900,
        transparent
    );

}

.scroll-indicator i{

    color:#ff9900;

    font-size:24px;

    animation:bounceArrow 2s infinite;

    text-shadow:
    0 0 15px rgba(255,153,0,.8);

}

@keyframes bounceArrow{

    0%,100%{

        transform:translateY(0);

    }

    50%{

        transform:translateY(10px);

    }

}

.hero-highlights{

    display:flex;

    flex-wrap:wrap;

    justify-content:center;

    gap:12px;

    margin:35px 0;

}

.hero-highlights span{

    padding:10px 16px;

    background:rgba(255,153,0,.08);

    border:1px solid rgba(255,153,0,.15);

    border-radius:999px;

    font-size:14px;

    color:#ddd;

}

.hero::after{

    content:"";

    position:absolute;

    inset:0;

    background:

    radial-gradient(
        circle at center,
        rgba(255,153,0,.08),
        transparent 70%
    );

    animation:heroPulse 6s ease-in-out infinite;

}

@keyframes heroPulse{

    0%,100%{

        opacity:.5;

    }

    50%{

        opacity:1;

    }

}

/* MOBILE */

@media(max-width:768px){

    .hero{

        min-height:85vh;

        padding:100px 20px 60px;

    }

    .hero-title{

        font-size:48px;

    }

    .hero-subtitle{

        font-size:16px;

    }

    .hero-stats{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:12px;

    margin:35px 0;

}

/* mobile hero fix */
.hero-stats{

        display:grid;

        grid-template-columns:1fr 1fr;

        gap:12px;

        margin:30px 0;

    }

    .hero-stat{

        width:auto;

        padding:12px 10px;

        font-size:13px;

        border-radius:14px;

        text-align:center;

    }

}	

  .hero-buttons{

    display:flex;

    flex-direction:column;

    gap:15px;

}

.hero-btn{

    width:100%;

    padding:16px 20px;

    font-size:18px;

}

}

@media(max-width:768px){

    .coe-hub{

        bottom:15px;

        right:15px;

    }

    .hub-toggle{

        width:58px;

        height:58px;

    }

}

.hero{

    min-height:90vh;

    padding:90px 20px 40px;

}

.hero-title{

    font-size:42px;

    line-height:1;

    margin-bottom:20px;

}

.hero-subtitle{

    font-size:16px;

    line-height:1.7;

    margin-bottom:20px;

}

    </style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>

<!-- HERO SECTION -->

<section class="hero">

    <div class="hero-content">

        <div class="live-badge">
            ⚡ INDIA'S FUTURE OF eFOOTBALL ESPORTS
        </div>

        <h1 class="hero-title">
            CHAMPIONS OF
            <span>eFOOTBALL</span>
        </h1>

        <p class="hero-subtitle">
            India's premier competitive eFootball platform featuring
            elite leagues, MVP awards, advanced player rankings,
            live standings and championship playoffs.
        </p>

       <div class="hero-highlights">

    <span>👥 Players</span>
    <span>⚽ Fixtures</span>
    <span>🏆 MVP Awards</span>
    <span>🔥 Live Season</span>

</div>

        <div class="hero-buttons">

            <a href="register.php"
               class="hero-btn hero-btn-primary">

                Join Tournament

            </a>

            <a href="standings.php"
               class="hero-btn hero-btn-secondary">

                View Standings
		
            </a>
	   

        </div>

<div class="scroll-indicator">

    <div class="scroll-line"></div>

    <i class="fas fa-angle-down"></i>

</div>

    </div>

</section>

<!-- LIVE SHOWCASE -->

<?php

/* UPCOMING / FEATURED MATCH */

$featured_match = mysqli_query($conn,"
SELECT
f.*,
p1.player_name AS home_name,
p1.team_name AS home_country,
p2.player_name AS away_name,
p2.team_name AS away_country
FROM fixtures f
JOIN players p1 ON f.home_player_id = p1.id
JOIN players p2 ON f.away_player_id = p2.id
WHERE match_status='pending'
ORDER BY round_no ASC, id ASC
LIMIT 1
");

$featured = mysqli_fetch_assoc($featured_match);


/* LATEST RESULT */

$latest_result = mysqli_query($conn,"
SELECT
f.*,
p1.player_name AS home_name,
p2.player_name AS away_name,
mvp.player_name AS mvp_name
FROM fixtures f
JOIN players p1 ON f.home_player_id = p1.id
JOIN players p2 ON f.away_player_id = p2.id
LEFT JOIN players mvp ON f.mvp_player_id = mvp.id
WHERE f.match_status='completed'
ORDER BY f.id DESC
LIMIT 1
");

$result = mysqli_fetch_assoc($latest_result);


/* LEAGUE LEADER */

$leader_query = mysqli_query($conn,"
SELECT
s.*,
p.player_name,
p.team_name
FROM standings s
JOIN players p ON s.player_id = p.id
ORDER BY s.points DESC,
s.goal_difference DESC
LIMIT 1
");

$leader = mysqli_fetch_assoc($leader_query);


/* PLAYOFF FEATURE */

$playoff_query = mysqli_query($conn,"
SELECT *
FROM playoff_matches
ORDER BY id DESC
LIMIT 1
");

$playoff = mysqli_fetch_assoc($playoff_query);

?>

<section class="showcase-section">

    <div class="showcase-slider">

        <div class="slider-progress">

            <div class="slider-progress-fill"></div>

        </div>

        <div class="showcase-track">

            <!-- FEATURED MATCH -->

            <div class="showcase-slide active">

                <div class="slide-badge">

                    ⚽ FEATURED MATCH

                </div>

                <h2>

                    <?= strtoupper($featured['home_name']) ?>

                    <span>VS</span>

                    <?= strtoupper($featured['away_name']) ?>

                </h2>

                <p>

                    Round <?= $featured['round_no']; ?>

                </p>

                <a href="fixtures.php"
                   class="slide-btn">

                    View Fixtures

                </a>

            </div>


            <!-- LATEST RESULT -->

            <div class="showcase-slide">

                <div class="slide-badge">

                    🏆 LATEST RESULT

                </div>

                <h2>

                    <?= $result['home_score']; ?>

                    -

                    <?= $result['away_score']; ?>

                </h2>

                <p>FINAL SCORE</p>

                <a href="results.php"
                   class="slide-btn">

                    View Results

                </a>

            </div>


            <!-- LEAGUE LEADER -->

            <div class="showcase-slide">

                <div class="slide-badge">

                    📊 LEAGUE LEADER

                </div>

                <h2>

                    <?= strtoupper($leader['player_name']); ?>

                </h2>

                <p>

                    <?= $leader['points']; ?> Points
                    •
                    GD <?= $leader['goal_difference']; ?>

                </p>

                <a href="standings.php"
                   class="slide-btn">

                    View Standings

                </a>

            </div>


            <!-- PLAYOFFS -->

            <div class="showcase-slide">

                <div class="slide-badge">

                    🔥 PLAYOFFS

                </div>

                <h2>

                    <?= strtoupper($playoff['stage']); ?>

                </h2>

                <p>

                    Series Group
                    <?= $playoff['series_group']; ?>

                </p>

                <a href="playoffs.php"
                   class="slide-btn">

                    View Playoffs

                </a>

            </div>

        </div>

        <button class="slider-arrow prev">

            ❮

        </button>

        <button class="slider-arrow next">

            ❯

        </button>

        <div class="slider-counter">

            01 / 04

        </div>

    </div>

</section>

<style>

/* SHOWCASE */

.showcase-section{

    padding:40px 20px 100px;

}

.showcase-slider{

    max-width:1200px;

    margin:auto;

    position:relative;

}

.showcase-slide{

    display:none;

    text-align:center;

    padding:70px 30px;

    border-radius:30px;

    background:
    rgba(18,18,18,.75);

    border:
    1px solid rgba(255,153,0,.15);

    box-shadow:
    0 0 0 1px rgba(255,153,0,.08),
    0 0 60px rgba(255,153,0,.06),
    0 20px 50px rgba(0,0,0,.45);

    backdrop-filter:blur(16px);

    position:relative;

    overflow:hidden;

}

.showcase-slide.active{

    display:block;

    animation:
    slideFade .6s ease;

}

@keyframes slideFade{

    from{

        opacity:0;

        transform:
        translateY(20px);

    }

    to{

        opacity:1;

        transform:
        translateY(0);

    }

}

.slide-badge{

    display:inline-block;

    padding:12px 22px;

    border-radius:999px;

    background:
    rgba(255,153,0,.1);

    color:#ff9900;

    font-weight:700;

    margin-bottom:25px;

}

.showcase-slide h2{

    font-size:64px;

    margin-bottom:15px;

    font-family:'Orbitron',sans-serif;

}

.showcase-slide h2 span{

    color:#ff9900;

}

.showcase-slide p{

    color:#bdbdbd;

    font-size:20px;

    margin-bottom:35px;

}

.slide-btn{

    display:inline-block;

    padding:16px 30px;

    border-radius:16px;

    text-decoration:none;

    font-weight:700;

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ff6600);

    color:black;

}

.showcase-slide::before{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    background:#ff9900;

    filter:blur(140px);

    opacity:.08;

    top:-50px;

    right:-50px;

}

@media(max-width:768px){

    .showcase-slide{

        padding:50px 20px;

    }

    .showcase-slide h2{

        font-size:36px;

    }

    .showcase-slide p{

        font-size:16px;

    }

}

.slider-progress{

    width:100%;
    height:4px;

    background:
    rgba(255,255,255,.08);

    border-radius:999px;

    margin-bottom:20px;

    overflow:hidden;

}

.slider-progress-fill{

    width:0%;

    height:100%;

    background:
    linear-gradient(
        90deg,
        #ff9900,
        #ff6600
    );

    animation:
    sliderProgress 5s linear infinite;

}

@keyframes sliderProgress{

    from{
        width:0%;
    }

    to{
        width:100%;
    }

}

.slider-arrow{

    position:absolute;

    top:50%;

    transform:
    translateY(-50%);

    width:60px;
    height:60px;

    border:none;

    border-radius:50%;

    cursor:pointer;

    color:white;

    font-size:28px;

    background:
    rgba(255,153,0,.08);

    border:
    1px solid rgba(255,153,0,.15);

    backdrop-filter:blur(10px);

    transition:.3s;

    z-index:10;

}

.slider-arrow:hover{

    transform:
    translateY(-50%)
    scale(1.08);

    background:
    rgba(255,153,0,.18);

}

.prev{

    left:-30px;

}

.next{

    right:-30px;

}

.slider-counter{

    position:absolute;

    right:30px;

    bottom:25px;

    color:#888;

    font-weight:700;

    letter-spacing:2px;

}

</style>

<?php

/* LEAGUE LEADER */

$leader = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT s.*, p.player_name
FROM standings s
JOIN players p ON s.player_id = p.id
ORDER BY s.points DESC, s.goal_difference DESC
LIMIT 1
"));

/* TOP SCORER */

$top_scorer = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT s.goals_for, p.player_name
FROM standings s
JOIN players p ON s.player_id = p.id
ORDER BY s.goals_for DESC
LIMIT 1
"));

/* MVP LEADER */

$mvp = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT
COUNT(*) as total_mvps,
p.player_name
FROM fixtures f
JOIN players p ON f.mvp_player_id = p.id
WHERE f.mvp_player_id IS NOT NULL
GROUP BY f.mvp_player_id
ORDER BY total_mvps DESC
LIMIT 1
"));

?>



<!-- STATS SECTION -->

<section class="stats-section">

    <div class="section-title">

         LIVE LEAGUE STATS

    </div>



    <div class="stats-grid">


   <div class="stat-card">

    <div class="stat-icon">🏆</div>

    <div class="stat-number">
        <?= strtoupper($leader['player_name']); ?>
    </div>

    <div class="stat-label">
        League Leader • <?= $leader['points']; ?> PTS
    </div>

</div>


<div class="stat-card">

    <div class="stat-icon">⚽</div>

    <div class="stat-number">
        <?= strtoupper($top_scorer['player_name']); ?>
    </div>

    <div class="stat-label">
        <?= $top_scorer['goals_for']; ?> Goals
    </div>

</div>


<div class="stat-card">

    <div class="stat-icon">👑</div>

    <div class="stat-number">

        <?= !empty($mvp['player_name'])
            ? strtoupper($mvp['player_name'])
            : 'N/A'; ?>

    </div>

    <div class="stat-label">

        <?= !empty($mvp['total_mvps'])
            ? $mvp['total_mvps'].' MVP Awards'
            : 'No MVP Yet'; ?>

    </div>

</div>


<div class="stat-card">

    <div class="stat-icon">🔥</div>

    <div class="stat-number">
        SEASON 1
    </div>

    <div class="stat-label">
        LIVE NOW
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

    font-size:32px;

    font-weight:800;

    color:#ff9900;

    margin-bottom:12px;

    word-break:break-word;

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

        font-size:20px;

    }

}

/* HUB */

.coe-hub{

    position:fixed;

    bottom:30px;

    right:30px;

    z-index:9999;

}



/* BUTTON */

.hub-toggle{

    width:78px;

    height:78px;

    border-radius:50%;

    border:none;

    cursor:pointer;

    background:

    linear-gradient(
    135deg,
    #ff9900,
    #ffb300
    );

    display:flex;

    align-items:center;

    justify-content:center;

    box-shadow:

    0 0 18px rgba(255,153,0,0.45),
    0 0 40px rgba(255,153,0,0.18);

    transition:0.35s;

    animation:
    hubPulse 3s infinite;

}



/* LOGO */

.hub-toggle img{

    width:62px;

    height:62px;

    object-fit:contain;

    transform:scale(1.15);

}



/* HOVER */

.hub-toggle:hover{

    transform:scale(1.08);

    box-shadow:

    0 0 28px rgba(255,153,0,0.7),
    0 0 55px rgba(255,153,0,0.28);

}



/* MENU */

.hub-menu{

    position:absolute;

    bottom:95px;

    right:85px;

    display:flex;

    flex-direction:column;

    align-items:flex-end;

    display:flex;

    flex-direction:column;

    gap:14px;

    opacity:0;

    visibility:hidden;

    transform:
    translateY(20px);

    transition:0.35s;

}



/* ACTIVE */

.hub-menu.active{

    opacity:1;

    visibility:visible;

    transform:
    translateY(0);

}



/* ITEMS */

.hub-item{

    min-width:220px;

    padding:15px 20px;

    border-radius:18px;

    text-decoration:none;

    color:white;

    font-weight:700;

    background:
    rgba(18,18,18,0.92);

    border:
    1px solid rgba(255,153,0,0.1);

    backdrop-filter:blur(16px);

    transition:0.3s;

    box-shadow:
    0 0 14px rgba(255,153,0,0.05);

    cursor:pointer;

    display:flex;

    align-items:center;

    justify-content:center;

    text-align:center;

}



/* HOVER */

.hub-item:hover{

    transform:translateX(-6px);

    border-color:
    rgba(255,153,0,0.35);

    color:#ffb300;

    box-shadow:
    0 0 22px rgba(255,153,0,0.15);

}



/* PULSE */

@keyframes hubPulse{

    0%{

        transform:scale(1);

    }

    50%{

        transform:scale(1.04);

    }

    100%{

        transform:scale(1);

    }

}

.hub-menu{

    right:75px;

    bottom:75px;

}

.hub-item{

    width:180px;

    font-size:14px;

}

/* MOBILE */

@media(max-width:768px){

    .coe-hub{

        bottom:20px;

        right:20px;

    }

    .hub-toggle{

        width:64px;

        height:64px;

    }

    .hub-toggle img{

    width:50px;

    height:50px;

    transform:scale(1.1);

}

    .hub-item{

        min-width:180px;

        font-size:14px;

    }

}

/* MODAL */

.hub-modal{

    position:fixed;

    inset:0;

    background:
    rgba(0,0,0,0.72);

    backdrop-filter:blur(12px);

    z-index:99999;

    display:flex;

    align-items:center;

    justify-content:center;

    opacity:0;

    visibility:hidden;

    transition:0.35s;

}



/* ACTIVE */

.hub-modal.active{

    opacity:1;

    visibility:visible;

}



/* BOX */

.hub-modal-box{

    width:90%;

    max-width:1100px;

    height:85vh;

    border-radius:26px;

    overflow:hidden;

    background:
    rgba(12,12,12,0.96);

    border:
    1px solid rgba(255,153,0,0.18);

    box-shadow:
    0 0 50px rgba(255,153,0,0.12);

    display:flex;

    flex-direction:column;

    transform:scale(0.9);

    transition:0.35s;

}



/* SCALE */

.hub-modal.active .hub-modal-box{

    transform:scale(1);

}



/* TOP */

.hub-modal-top{

    height:72px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 24px;

    border-bottom:
    1px solid rgba(255,255,255,0.06);

}



/* TITLE */

.hub-modal-title{

    font-size:24px;

    font-weight:800;

    color:#ffb300;

}



/* ACTIONS */

.hub-modal-actions{

    display:flex;

    align-items:center;

    gap:14px;

}



/* FULL PAGE */

#hubFullPage{

    text-decoration:none;

    padding:10px 16px;

    border-radius:12px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-weight:700;

}



/* CLOSE */

#closeHubModal{

    width:42px;

    height:42px;

    border:none;

    border-radius:50%;

    background:
    rgba(255,255,255,0.08);

    color:white;

    cursor:pointer;

    font-size:18px;

}



/* IFRAME */

#hubFrame{

    flex:1;

    width:100%;

    border:none;

    background:#000;

}



/* BUTTON FIX */

.hub-item{

    cursor:pointer;

}

</style>

<!-- COE HUB -->

<div class="coe-hub">

    <button class="hub-toggle"
    id="hubToggle">

        <img src="assets/images/coe-hub.png">

    </button>



    <div class="hub-menu"
    id="hubMenu">

        <a href="news.php"
        class="hub-item">

             News

        </a>



       <button
class="hub-item open-hub-page"
data-title="Roadmap"
data-page="roadmap-modal.php">

 Roadmap

</button>



       <button
class="hub-item open-hub-page"
data-title="Changelog"
data-page="changelog-modal.php">

 Changelog

</button>

    </div>

</div>


<!-- HUB MODAL -->

<div class="hub-modal"
id="hubModal">

    <div class="hub-modal-box">

        <!-- TOP BAR -->

        <div class="hub-modal-top">

            <div class="hub-modal-title"
            id="hubModalTitle">

                Changelog

            </div>



            <div class="hub-modal-actions">

                <a href="#"
                target="_blank"
                id="hubFullPage">

                    ↗ Full Page

                </a>



                <button id="closeHubModal">

                    ✕

                </button>

            </div>

        </div>



        <!-- CONTENT -->

        <iframe
        id="hubFrame"
        src="">
        </iframe>

    </div>

</div>

<script>

const hubToggle =
document.getElementById("hubToggle");

const hubMenu =
document.getElementById("hubMenu");



/* TOGGLE MENU */

hubToggle.onclick = () => {

    hubMenu.classList.toggle("active");

};



/* MODAL */

const modal =
document.getElementById("hubModal");

const frame =
document.getElementById("hubFrame");

const modalTitle =
document.getElementById("hubModalTitle");

const fullPage =
document.getElementById("hubFullPage");



/* OPEN MODAL */

document
.querySelectorAll(".open-hub-page")

.forEach(button => {

    button.onclick = () => {

        const page =
        button.dataset.page;

        const title =
        button.dataset.title;

        frame.src = page;

        modalTitle.innerText = title;

        if(page=="changelog-modal.php"){

    fullPage.href="changelog.php";

}
else if(page=="roadmap-modal.php"){

    fullPage.href="roadmap.php";

}
else{

    fullPage.href=page;

}

        modal.classList.add("active");

    };

});



/* CLOSE MODAL */

document
.getElementById("closeHubModal")

.onclick = () => {

    modal.classList.remove("active");

    frame.src = "";

};


const slides =
document.querySelectorAll(
'.showcase-slide'
);

const counter =
document.querySelector(
'.slider-counter'
);

let current = 0;

function showSlide(index){

    slides.forEach(slide => {

        slide.classList.remove(
            'active'
        );

    });

    slides[index]
    .classList
    .add('active');

    counter.textContent =
    String(index + 1)
    .padStart(2,'0')
    +
    ' / ' +
    String(slides.length)
    .padStart(2,'0');

}

function nextSlide(){

    current++;

    if(current >= slides.length){

        current = 0;

    }

    showSlide(current);

}

function prevSlide(){

    current--;

    if(current < 0){

        current =
        slides.length - 1;

    }

    showSlide(current);

}

document
.querySelector('.next')
.addEventListener(
'click',
nextSlide
);

document
.querySelector('.prev')
.addEventListener(
'click',
prevSlide
);

setInterval(
nextSlide,
5000
);

showSlide(0);


</script>


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

LIMIT 3"

);

?>



<!-- RECENT RESULTS -->

<section class="results-section">

    <div class="section-title">

        RECENT RESULTS

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
    translateY(-12px) scale(1.02);

    border-color:
    rgba(255,153,0,0.55);

    box-shadow:
    0 0 45px rgba(255,153,0,0.18);

}

.result-card::after{

    content:"";

    position:absolute;

    inset:0;

    background:linear-gradient(
        135deg,
        rgba(255,153,0,.08),
        transparent 60%
    );

    pointer-events:none;

}

.round-badge{

    box-shadow:0 0 20px rgba(255,153,0,.18);

}

.score-box{

    animation:scoreGlow 3s infinite;

}

@keyframes scoreGlow{

    0%,100%{
        text-shadow:0 0 20px rgba(255,153,0,.45);
    }

    50%{
        text-shadow:0 0 40px rgba(255,153,0,.9);
    }

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

LIMIT 4"

);

?>

<!-- BEST WIN PERCENTAGE -->

<?php include 'top-players.php'; ?>


<!-- FIXTURES PREVIEW -->

<section class="fixtures-section">

    <div class="section-title">

        UPCOMING FIXTURES

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

                 Match Pending

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

        PLAYOFF BATTLES

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

        COE

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


<style>
.fade-up{opacity:0;transform:translateY(40px);transition:.8s cubic-bezier(.22,.61,.36,1);}
.fade-up.show{opacity:1;transform:none;}
.fixture-vs{animation:vsPulse 2s infinite;}
.playoff-vs{animation:battlePulse 2.5s infinite;}
.stat-card,.result-card,.fixture-card,.playoff-card{animation:cardFloat 6s ease-in-out infinite;}
@keyframes cardFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes vsPulse{0%,100%{transform:scale(1)}50%{transform:scale(1.12)}}
@keyframes battlePulse{0%,100%{transform:scale(1)}50%{transform:scale(1.18)}}
</style>

<script>
document.addEventListener('DOMContentLoaded',()=>{
const sections=document.querySelectorAll('.stats-section,.results-section,.fixtures-section,.playoff-section');
sections.forEach(el=>el.classList.add('fade-up'));
const obs=new IntersectionObserver(entries=>{
 entries.forEach(e=>{
   if(e.isIntersecting){e.target.classList.add('show');}
 });
},{threshold:.15});
sections.forEach(el=>obs.observe(el));
});
</script>

<style>
.top-player-card::after{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);
transition:.8s;
}
.top-player-card:hover::after{left:100%;}

.fixture-card{
background:linear-gradient(135deg,rgba(20,20,20,.95),rgba(10,10,10,.95));
}
.fixture-vs{
font-size:42px!important;
font-weight:900;
color:#ff9900;
}

.playoff-card::after{
content:'';
position:absolute;
inset:0;
background:radial-gradient(circle at top right,rgba(255,153,0,.08),transparent 60%);
pointer-events:none;
}
</style>
</body>
</html>