<?php
include __DIR__ . '/assets/db.php';

function getSeries($conn,$stage,$group){
    $sql="SELECT pm.*, p1.player_name home_name, p2.player_name away_name
          FROM playoff_matches pm
          LEFT JOIN players p1 ON pm.home_player_id=p1.id
          LEFT JOIN players p2 ON pm.away_player_id=p2.id
          WHERE pm.stage='$stage' AND pm.series_group=$group
          ORDER BY pm.match_no ASC";
    $q=mysqli_query($conn,$sql);

    $rows=[]; $homeWins=0; $awayWins=0;
    $home='TBD'; $away='TBD';

    while($r=mysqli_fetch_assoc($q)){
        $rows[]=$r;
        $home=$r['home_name'] ?: 'TBD';
        $away=$r['away_name'] ?: 'TBD';

        if(!empty($r['winner_id'])){
            if($r['winner_id']==$r['home_player_id']) $homeWins++;
            if($r['winner_id']==$r['away_player_id']) $awayWins++;
        }
    }

    $winner='';
    if($homeWins>=2) $winner=$home;
    if($awayWins>=2) $winner=$away;

    return compact('rows','home','away','homeWins','awayWins','winner');
}

$quarters=[];
for($i=1;$i<=4;$i++){
    $quarters[$i]=getSeries($conn,'quarter',$i);
}
$playoffFormat = 8;
$quarterExists=false;
foreach($quarters as $q){
    if(!empty($q['rows'])){$quarterExists=true;break;}
}

$sf1=getSeries($conn,'semi',1);
$sf2=getSeries($conn,'semi',2);
$final=getSeries($conn,'final',1);

$champion='';
if($final['homeWins']>=2) $champion=$final['home'];
if($final['awayWins']>=2) $champion=$final['away'];


$showQuarterBracket = $quarterExists;
$heroMode=$quarterExists ? 'quarter' : 'semi';
if($sf1['winner'] && $sf2['winner']) $heroMode='final';
if($champion) $heroMode='champion';


function seriesStatus($winsA,$winsB,$target=2){
    if($winsA >= $target || $winsB >= $target) return 'Series Complete';
    $played = $winsA + $winsB;
    if($played == 0) return 'Series Not Started';
    if($played == 1) return 'Game 2 Pending';
    if($played == 2) return 'Game 3 Decider';
    return 'Live';
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>COE Playoffs 2.0</title>
<style>
:root{
--bg:#060606;
--surface:#101010;
--surface2:#151515;
--orange:#ff9900;
--orangeSoft:rgba(255,153,0,.18);
--text:#fff;
--muted:#bbb;
--success:#52ff9a;
}
*{box-sizing:border-box}
body{
margin:0;
background:
radial-gradient(circle at top,rgba(255,153,0,.08),transparent 40%),
linear-gradient(180deg,#080808,#050505);
color:var(--text);
font-family:Arial,sans-serif;
overflow-x:hidden;
}
a{text-decoration:none;color:inherit}
.container{max-width:1400px;margin:auto;padding:0 20px 90px}
.hero{
position:relative;
padding:140px 20px 100px;
text-align:center;
overflow:hidden;
}
.hero::before{
content:'🏆';
position:absolute;
top:20px;
left:50%;
transform:translateX(-50%);
font-size:240px;
opacity:.04;
pointer-events:none;
}
.hero::after{
content:'';
position:absolute;
width:560px;
height:560px;
background:radial-gradient(circle,var(--orangeSoft),transparent 70%);
top:-140px;
left:50%;
transform:translateX(-50%);
filter:blur(40px);
}
.hero-inner{position:relative;z-index:1}
.hero-label{
display:inline-flex;
align-items:center;
gap:10px;
padding:10px 18px;
border-radius:999px;
background:rgba(255,153,0,.08);
border:1px solid rgba(255,153,0,.16);
color:#ffd699;
font-weight:700;
letter-spacing:.6px;
text-transform:uppercase;
}
.hero h1{
margin:18px 0 10px;
font-size:clamp(42px,8vw,88px);
line-height:1;
text-transform:uppercase;
}
.hero h1 span{color:var(--orange);text-shadow:0 0 22px rgba(255,153,0,.35)}
.hero p{color:var(--muted);font-size:18px;margin:0}
.final-showcase{
margin:34px auto 0;
max-width:980px;
padding:28px;
border-radius:32px;
background:linear-gradient(135deg,rgba(255,255,255,.03),rgba(255,255,255,.015));
border:1px solid rgba(255,153,0,.18);
backdrop-filter:blur(16px);
box-shadow:0 24px 80px rgba(0,0,0,.45);
}
.final-kicker{
display:inline-flex;
align-items:center;
gap:10px;
padding:8px 14px;
border-radius:999px;
background:rgba(255,153,0,.12);
border:1px solid rgba(255,153,0,.22);
color:#ffd699;
font-weight:800;
letter-spacing:1px;
text-transform:uppercase;
font-size:12px;
}
.final-title{
font-size:clamp(30px,5vw,54px);
font-weight:900;
margin:18px 0 24px;
letter-spacing:.5px;
}
.final-title .vs{
color:var(--orange);
margin:0 14px;
text-shadow:0 0 18px rgba(255,153,0,.35);
}
.final-scoreboard{
display:grid;
grid-template-columns:1fr auto 1fr;
align-items:center;
gap:22px;
}
.final-player{
display:flex;
align-items:center;
justify-content:center;
gap:12px;
padding:18px 20px;
border-radius:22px;
background:rgba(255,255,255,.03);
border:1px solid rgba(255,255,255,.06);
font-weight:800;
font-size:24px;
}
.final-player .flag{font-size:32px}
.final-score{
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
min-width:140px;
padding:12px 10px;
border-radius:22px;
background:rgba(255,153,0,.08);
border:1px solid rgba(255,153,0,.18);
box-shadow:0 0 26px rgba(255,153,0,.12);
}
.final-score .numbers{
font-size:clamp(34px,6vw,56px);
font-weight:900;
color:var(--orange);
line-height:1;
text-shadow:0 0 20px rgba(255,153,0,.35);
}
.final-score .status{
margin-top:8px;
font-size:11px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
}
.section-title{
display:flex;
align-items:center;
gap:12px;
font-size:32px;
font-weight:800;
margin:10px 0 24px;
}
.section-title .accent{color:var(--orange)}
.bracket-shell{
position:relative;
padding:28px;
border-radius:32px;
background:linear-gradient(135deg,rgba(255,255,255,.02),rgba(255,255,255,.01));
border:1px solid rgba(255,153,0,.14);
overflow:hidden;
}
.bracket-shell::before{
content:'';
position:absolute;
inset:-20% auto auto 60%;
width:360px;
height:360px;
background:radial-gradient(circle,rgba(255,153,0,.12),transparent 70%);
filter:blur(20px);
pointer-events:none;
}
.bracket{
position:relative;
display:grid;
grid-template-columns:420px 320px 420px;
justify-content:center;
align-items:center;
gap:40px;

}
.round{
display:flex;
flex-direction:column;
gap:18px;
position:relative;
z-index:1;
}
.match-card{
position:relative;
padding:24px;
border-radius:24px;
background:
linear-gradient(
135deg,
rgba(255,255,255,.03),
rgba(255,255,255,.01)
);
border:1px solid rgba(255,153,0,.15);
backdrop-filter:blur(12px);
overflow:hidden;
transition:.35s ease;
}

.match-card:hover{
transform:translateY(-6px);
border-color:rgba(255,153,0,.45);
box-shadow:
0 0 25px rgba(255,153,0,.15),
0 0 50px rgba(255,153,0,.08);
}

.match-card::before{
content:'';
position:absolute;
top:-80px;
right:-80px;
width:180px;
height:180px;
background:
radial-gradient(
circle,
rgba(255,153,0,.12),
transparent 70%
);
}

.match-card.live{
border-color:rgba(255,153,0,.45);
box-shadow:0 0 40px rgba(255,153,0,.18);
}
.match-header{
display:flex;
align-items:center;
justify-content:space-between;
margin-bottom:14px;
}
.match-stage{
font-size:11px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
}
.match-badge{
padding:6px 10px;
border-radius:999px;
background:rgba(255,153,0,.12);
border:1px solid rgba(255,153,0,.22);
color:#ffd699;
font-size:11px;
font-weight:800;
letter-spacing:1px;
text-transform:uppercase;
}
.match-badge.live{
background:rgba(255,153,0,.18);
border-color:rgba(255,153,0,.32);
}
.player-row{
display:flex;
align-items:center;
justify-content:space-between;
gap:14px;
padding:10px 0;
border-top:1px solid rgba(255,255,255,.06);
}
.player-row:first-of-type{border-top:none}
.player-row .left{
display:flex;
align-items:center;
gap:10px;
min-width:0;
}
.player-row .flag{font-size:22px}
.player-row .name{
font-size:20px;
font-weight:800;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}
.player-row .series-score{
min-width:44px;
text-align:center;
font-size:22px;
font-weight:900;
color:var(--orange);
}
.player-row.winner .name{color:#fff}
.player-row.winner .series-score{text-shadow:0 0 16px rgba(255,153,0,.35)}
.connector{
display:none;
}

.final-card{
padding:40px;
border-radius:32px;
text-align:center;

background:
linear-gradient(
135deg,
rgba(255,153,0,.16),
rgba(255,153,0,.05)
);

border:1px solid rgba(255,153,0,.25);

box-shadow:
0 0 60px rgba(255,153,0,.18);

min-height:280px;

display:flex;
align-items:center;
justify-content:center;
}

.final-card .inner{
text-align:center;
}
.final-card .label{
font-size:11px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
margin-bottom:10px;
}
.final-card .trophy{
font-size:56px;
margin-bottom:10px;
animation:trophyFloat 3s ease-in-out infinite;
}
.final-card .players{
font-size:26px;
font-weight:900;
line-height:1.2;
}
.final-card .players .vs{
display:block;
font-size:14px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
margin:6px 0;
}
.final-card .score{
margin-top:12px;
font-size:40px;
font-weight:900;
color:var(--orange);
text-shadow:0 0 18px rgba(255,153,0,.35);
}
.final-card .status{
margin-top:8px;
font-size:11px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
}
.advance-banner{
margin:28px 0 36px;
padding:18px 20px;
border-radius:22px;
background:linear-gradient(135deg,rgba(82,255,154,.10),rgba(82,255,154,.04));
border:1px solid rgba(82,255,154,.22);
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:14px;
}
.advance-item{
display:flex;
align-items:center;
justify-content:center;
gap:12px;
padding:12px 14px;
border-radius:18px;
background:rgba(255,255,255,.02);
border:1px solid rgba(255,255,255,.06);
font-weight:800;
text-align:center;
}
.advance-item .arrow{color:var(--success);font-size:22px}
.series-center{margin-top:10px}
.series-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:24px;
}
.series{
position:relative;
padding:28px;
border-radius:28px;
background:linear-gradient(135deg,#121212,#090909);
border:1px solid rgba(255,153,0,.16);
box-shadow:0 12px 34px rgba(0,0,0,.28);
transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;
overflow:hidden;
}
.series::before{
content:'';
position:absolute;
top:-70px;
right:-70px;
width:180px;
height:180px;
background:radial-gradient(circle,rgba(255,153,0,.18),transparent 70%);
filter:blur(16px);
}
.series:hover{
transform:translateY(-8px);
box-shadow:0 18px 44px rgba(0,0,0,.34);
border-color:rgba(255,153,0,.28);
}
.series.live{
border-color:rgba(255,153,0,.45);
box-shadow:0 0 48px rgba(255,153,0,.16);
}
.series-header{
display:flex;
align-items:center;
justify-content:space-between;
gap:12px;
margin-bottom:22px;
}
.series-title{
font-size:14px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
}
.series-badge{
padding:6px 10px;
border-radius:999px;
background:rgba(255,153,0,.12);
border:1px solid rgba(255,153,0,.22);
color:#ffd699;
font-size:11px;
font-weight:800;
letter-spacing:1px;
text-transform:uppercase;
}
.series-badge.live{
background:rgba(255,153,0,.18);
border-color:rgba(255,153,0,.32);
}
.series-player{
display:flex;
align-items:center;
justify-content:space-between;
gap:14px;
padding:14px 0;
border-top:1px solid rgba(255,255,255,.06);
}
.series-player:first-of-type{border-top:none}
.series-player .left{
display:flex;
align-items:center;
gap:12px;
min-width:0;
}
.series-player .flag{font-size:26px}
.series-player .name{
font-size:22px;
font-weight:900;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}
.series-player .series-score{
min-width:44px;
text-align:center;
font-size:24px;
font-weight:900;
color:var(--orange);
}
.series-player.winner .name{color:#fff}
.series-player.winner .series-score{text-shadow:0 0 18px rgba(255,153,0,.35)}
.series-footer{
display:flex;
align-items:center;
justify-content:space-between;
gap:10px;
margin-top:20px;
padding-top:16px;
border-top:1px solid rgba(255,255,255,.08);
}
.advance-tag{
display:inline-flex;
align-items:center;
gap:8px;
padding:10px 14px;
border-radius:999px;
background:rgba(82,255,154,.10);
border:1px solid rgba(82,255,154,.22);
color:var(--success);
font-weight:800;
font-size:12px;
letter-spacing:1px;
text-transform:uppercase;
}
.live-tag{
display:inline-flex;
align-items:center;
gap:8px;
padding:10px 14px;
border-radius:999px;
background:rgba(255,153,0,.12);
border:1px solid rgba(255,153,0,.22);
color:#ffd699;
font-weight:800;
font-size:12px;
letter-spacing:1px;
text-transform:uppercase;
}
.series-footer .record{
font-size:13px;
color:#cfcfcf;
font-weight:700;
}
.timeline{
margin-top:70px;
padding:28px;
border-radius:28px;
background:linear-gradient(135deg,rgba(255,255,255,.02),rgba(255,255,255,.01));
border:1px solid rgba(255,153,0,.14);
}
.timeline-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:18px;
}
.timeline-item{
padding:18px;
border-radius:22px;
background:linear-gradient(135deg,#121212,#090909);
border:1px solid rgba(255,153,0,.14);
}
.timeline-item .game{
font-size:12px;
font-weight:800;
letter-spacing:2px;
text-transform:uppercase;
color:#ffd699;
margin-bottom:10px;
}
.timeline-item .winner{
font-size:20px;
font-weight:900;
}
.timeline-item .status{
margin-top:6px;
font-size:13px;
color:#cfcfcf;
}
.timeline-item.pending .winner{color:#ffd699}
.champion{
position:relative;
margin-top:80px;
padding:54px 28px;
border-radius:36px;
background:linear-gradient(135deg,rgba(255,153,0,.14),rgba(255,153,0,.05));
border:1px solid rgba(255,153,0,.28);
text-align:center;
overflow:hidden;
}
.champion::before{
content:'';
position:absolute;
inset:-30% auto auto 50%;
width:420px;
height:420px;
transform:translateX(-50%);
background:radial-gradient(circle,rgba(255,153,0,.22),transparent 70%);
filter:blur(24px);
pointer-events:none;
}
.champion .content{
position:relative;
z-index:1;
}
.champion .trophy{
font-size:96px;
margin-bottom:12px;
animation:trophyFloat 3s ease-in-out infinite;
}
.champion h2{
margin:0;
font-size:18px;
letter-spacing:3px;
text-transform:uppercase;
color:#ffd699;
}
.champion h1{
margin:12px 0 10px;
font-size:clamp(42px,8vw,76px);
line-height:1;
}
.champion p{
margin:0;
color:#cfcfcf;
font-size:16px;
}
@keyframes trophyFloat{
50%{transform:translateY(-8px)}
}
@media(max-width:1024px){
.bracket{
grid-template-columns:1fr;
min-height:auto;
}
.connector{display:none}
.series-grid,.timeline-grid{
grid-template-columns:1fr;
}
.final-showcase{
padding:24px;
}
.final-scoreboard{
grid-template-columns:1fr;
}
.final-player{
justify-content:center;
}
.final-score{
min-width:0;
width:100%;
}
}
@media(max-width:768px){
.hero{
padding:120px 16px 80px;
}
.hero::before{
font-size:160px;
top:40px;
}
.hero p{
font-size:16px;
}
.section-title{
font-size:26px;
}
.final-showcase{
padding:20px;
}
.final-title{
font-size:clamp(28px,7vw,42px);
}
.final-player{
font-size:20px;
padding:16px;
}
.final-player .flag{
font-size:28px;
}
.final-score .numbers{
font-size:44px;
}
.bracket-shell,.timeline,.champion{
padding:22px;
}
.match-card,.series{
padding:22px;
}
.player-row .name,.series-player .name{
font-size:18px;
}
.player-row .series-score,.series-player .series-score{
font-size:20px;
}
.final-card .players{
font-size:22px;
}
.final-card .score{
font-size:34px;
}
.timeline-item .winner{
font-size:18px;
}
}

.bracket-svg{
position:absolute;
inset:0;
width:100%;
height:100%;
pointer-events:none;
z-index:0;
}
.svg-line{
fill:none;
stroke:#ff9900;
stroke-width:3;
stroke-linecap:round;
stroke-linejoin:round;
opacity:.85;
filter:drop-shadow(0 0 12px rgba(255,153,0,.6));
stroke-dasharray:1000;
stroke-dashoffset:1000;
animation:drawBracket 2s ease forwards;
}
.trophy-line{animation-delay:.6s;}
@keyframes drawBracket{
to{stroke-dashoffset:0;}
}

.round{
display:flex;
flex-direction:column;
justify-content:center;
gap:22px;
}

.round:nth-child(2){
justify-content:space-evenly;
}

.bracket.semi-mode{
    grid-template-columns: 380px 420px 260px;
    justify-content:space-evenly;
    align-items:center;
    gap:80px;
    min-height:500px;
}

.bracket.semi-mode .round{
    justify-content:center;
}

.winner-column{
    display:flex;
    align-items:center;
    justify-content:center;
}
.winner-column .match-card{
    width:320px;
    min-height:220px;
    border:2px solid rgba(255,153,0,.35);
    box-shadow:0 0 40px rgba(255,153,0,.18);
}
.winner-column .name{
    font-size:42px;
    font-weight:900;
}

.final-card{
width:100%;
max-width:420px;
min-height:260px;
margin:auto;
}

.quarter-mode{
grid-template-columns:380px 380px 420px;
gap:60px;
justify-content:center;
align-items:center;
}

.bracket-shell{
overflow:visible;
min-height:auto;
}

/* MOBILE BRACKET FIX */
@media(max-width:768px){
.container{padding:0 12px 60px;}
.bracket-shell{overflow:visible;padding:18px;}
.bracket.semi-mode,
.bracket.quarter-mode{
display:flex;
flex-direction:column;
gap:20px;
min-height:auto;
}
.bracket.semi-mode .round,
.bracket.quarter-mode .round{
width:100%;
}
.match-card,.final-card{
width:100%;
max-width:none;
}
.winner-column{width:100%;}
.winner-column .match-card{
width:100%;
min-height:auto;
}
.winner-column .name{font-size:24px;}
}


</style>
</head>
<body>
<?php include 'includes/public-navbar.php'; ?>

<section class="hero">
  <div class="hero-inner">
    <div class="hero-label">🏆 Season 1 • Playoffs</div>
<?php if($heroMode=='quarter'): ?>
    <h1>Quarter Finals <span>Live</span></h1>
    <p>Top 8 battle for a semifinal place.</p>
<?php elseif($heroMode=='semi'): ?>
    <h1>Semi Finals <span>Live</span></h1>
    <p><?= htmlspecialchars($sf1['home']) ?> vs <?= htmlspecialchars($sf1['away']) ?> • <?= htmlspecialchars($sf2['home']) ?> vs <?= htmlspecialchars($sf2['away']) ?></p>
<?php elseif($heroMode=='final'): ?>
    <h1>Grand Final <span>Live</span></h1>
    <p>The road to the championship ends here.</p>
<?php else: ?>
    <h1>Champion <span>Crowned</span></h1>
    <p>Season 1 winner has been decided.</p>
<?php endif; ?>

    <div class="final-showcase">
      <div class="final-kicker">Finalists</div>
      <div class="final-title">
        <?= htmlspecialchars($final['home']) ?>
        <span class="vs">VS</span>
        <?= htmlspecialchars($final['away']) ?>
      </div>

      <div class="final-scoreboard">
        <div class="final-player">
          <span><?= htmlspecialchars($final['home']) ?></span>
        </div>

        <div class="final-score">
          <div class="numbers"><?= $final['homeWins'] ?> — <?= $final['awayWins'] ?></div>
          <div class="status"><?= $champion ? 'Champion Decided' : seriesStatus($final['homeWins'],$final['awayWins']) ?></div>
        </div>

        <div class="final-player">
          <span><?= htmlspecialchars($final['away']) ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">

  
<?php /* REMOVE DUPLICATE QUARTER FINALS SECTION - PLAYOFFS 3.0 */ ?>
<?php if(false): ?>
<div class="section-title"><span class="accent">Quarter</span> Finals</div>
<div class="advance-banner">
<?php foreach($quarters as $idx=>$q): if(!empty($q['rows'])): ?>
<div class="advance-item">
QF<?= $idx ?> • <?= htmlspecialchars($q['home']) ?> vs <?= htmlspecialchars($q['away']) ?>
</div>
<?php endif; endforeach; ?>
</div>
<?php endif; ?>


<?php /* REMOVE DUPLICATE QUARTER BRACKET SECTION - PLAYOFFS 3.0 */ ?>
<?php if(false): ?>
<!-- QUARTER BRACKET MODE ENABLED -->
<div class="section-title"><span class="accent">Quarter Final</span> Bracket</div>
<div class="advance-banner">
<?php foreach($quarters as $i=>$q): ?>
<?php if(!empty($q['rows'])): ?>
<div class="advance-item">
🏆 QF<?= $i ?> • <?= htmlspecialchars($q['home']) ?> vs <?= htmlspecialchars($q['away']) ?>
</div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>


<div class="section-title"><span class="accent">Tournament</span> Bracket</div>

<?php if($quarterExists): ?>
<div class="bracket-shell">
<div class="bracket quarter-mode">

<div class="round">
<?php foreach($quarters as $i=>$q): if(!empty($q['rows'])): ?>
<div class="match-card">
<div class="match-header"><div class="match-stage">Quarter Final <?= $i ?></div></div>
<div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($q['home']) ?></span></div><div class="series-score"><?= $q['homeWins'] ?></div></div>
<div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($q['away']) ?></span></div><div class="series-score"><?= $q['awayWins'] ?></div></div>
</div>
<?php endif; endforeach; ?>
</div>

<div class="round">
<div class="match-card"><div class="match-header"><div class="match-stage">Semi Final 1</div></div><div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($sf1['home']) ?></span></div></div><div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($sf1['away']) ?></span></div></div></div>
<div class="match-card"><div class="match-header"><div class="match-stage">Semi Final 2</div></div><div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($sf2['home']) ?></span></div></div><div class="player-row"><div class="left"><span class="name"><?= htmlspecialchars($sf2['away']) ?></span></div></div></div>
</div>

<div class="round">
<div class="final-card"><div class="inner"><div class="label">Grand Final</div><div class="players"><?= htmlspecialchars($final['home']) ?> <span class="vs">VS</span> <?= htmlspecialchars($final['away']) ?></div></div></div>
</div>

</div>
</div>
<?php else: ?>

<div class="bracket-shell">
<div class="bracket semi-mode">

<div class="round">
    <div class="match-card">
        <div class="match-header">
            <div class="match-stage">Semi Final 1</div>
        </div>

        <div class="player-row">
            <div class="left">
                <span class="name"><?= htmlspecialchars($sf1['home']) ?></span>
            </div>
            <div class="series-score"><?= $sf1['homeWins'] ?></div>
        </div>

        <div class="player-row">
            <div class="left">
                <span class="name"><?= htmlspecialchars($sf1['away']) ?></span>
            </div>
            <div class="series-score"><?= $sf1['awayWins'] ?></div>
        </div>
    </div>

    <div class="match-card">
        <div class="match-header">
            <div class="match-stage">Semi Final 2</div>
        </div>

        <div class="player-row">
            <div class="left">
                <span class="name"><?= htmlspecialchars($sf2['home']) ?></span>
            </div>
            <div class="series-score"><?= $sf2['homeWins'] ?></div>
        </div>

        <div class="player-row">
            <div class="left">
                <span class="name"><?= htmlspecialchars($sf2['away']) ?></span>
            </div>
            <div class="series-score"><?= $sf2['awayWins'] ?></div>
        </div>
    </div>
</div>

<div class="connector"></div>

<div class="round">
    <div class="final-card">
        <div class="inner">
            <div class="label">Grand Final</div>
            <div class="trophy">🏆</div>
            <div class="players">
                <?= htmlspecialchars($final['home']) ?>
                <span class="vs">VS</span>
                <?= htmlspecialchars($final['away']) ?>
            </div>
            <div class="score">
                <?= $final['homeWins'] ?> — <?= $final['awayWins'] ?>
            </div>
        </div>
    </div>
</div>

<div class="connector reverse"></div>

<div class="round winner-column">
    <div class="match-card">
        <div class="match-header">
            <div class="match-stage">Winner</div>
        </div>

        <div class="player-row">
            <div class="left">
                <span class="name"><?= htmlspecialchars($champion ?: 'TBD') ?></span>
            </div>

            <div class="series-score">
                <?= $champion ? '🏆' : '0' ?>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<?php endif; ?>
</div>


<!--
PLAYOFF FORMAT READY:
4 Players = 2 Semis + Final
6 Players = Quarter/Play-In + Semis + Final
8 Players = Quarter Finals + Semis + Final
Use admin playoff setting to determine bracket rendering in future update.
-->


<?php if($champion): ?>
<section class="champion">
    <div class="content">
        <div class="trophy">🏆</div>
        <h2>Champion of COE Season 1</h2>
        <h1><?= htmlspecialchars($champion) ?></h1>
        <p>The ultimate champion of the playoffs.</p>
    </div>
</section>
<?php endif; ?>

</body>
</html>
