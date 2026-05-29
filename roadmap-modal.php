<?php

include __DIR__ . '/assets/db.php';

$roadmaps = mysqli_query(

    $conn,

    "SELECT *
    FROM roadmap
    ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700;800&display=swap"
rel="stylesheet">

<style>

body{

    margin:0;
    padding:25px;

    background:#050505;

    color:white;

    font-family:'Orbitron',sans-serif;

}

/* TITLE */

.modal-title{

    text-align:center;

    color:#ff9900;

    font-size:30px;

    font-weight:800;

    margin-bottom:25px;

}

/* TIMELINE */

.timeline{

    position:relative;

    max-width:1000px;

    margin:auto;

}

.timeline::before{

    content:"";

    position:absolute;

    left:50%;

    top:0;

    width:4px;

    height:100%;

    transform:translateX(-50%);

    background:linear-gradient(
        to bottom,
        #41ff9b,
        #3db7ff,
        #ffb300
    );

    box-shadow:
    0 0 25px rgba(255,179,0,.5);

}

/* ITEM */

.timeline-item{

    position:relative;

    width:40%;

    margin-bottom:25px;

}

.timeline-item.left{

    left:0;

    padding-right:40px;

}

.timeline-item.right{

    left:50%;

    padding-left:40px;

}

/* DOT */

.timeline-item::before{

    content:"";

    position:absolute;

    top:22px;

    width:16px;

    height:16px;

    border-radius:50%;

    background:#ffb300;

    box-shadow:
    0 0 15px rgba(255,179,0,.8);

    z-index:10;

}

.timeline-item.left::before{

    right:-67.5px;

}

.timeline-item.right::before{

    left:-7.5px;

}

/* CARD */

.timeline-card{

    background:
    rgba(255,255,255,.03);

    border:
    1px solid rgba(255,153,0,.08);

    border-radius:16px;

    padding:14px;

    transition:.3s;

}

.timeline-card:hover{

    transform:translateY(-4px);

}

/* VERSION */

.version{

    display:inline-block;

    padding:5px 10px;

    border-radius:12px;

    background:
    rgba(255,153,0,.12);

    color:#ffb300;

    font-size:11px;

    font-weight:700;

    margin-bottom:15px;

}

/* TITLE */

.roadmap-title{

    font-size:18px;

    font-weight:700;

    margin-bottom:10px;

}

/* DESCRIPTION */

.roadmap-description{

    color:#d0d0d0;

    line-height:1.5;

    margin-bottom:12px;

    white-space:pre-line;

    font-size:12px;

}

/* STATUS */

.status{

    display:inline-block;

    padding:5px 10px;

    border-radius:12px;

    font-size:10px;

    font-weight:700;

}

.completed{

    background:
    rgba(0,255,120,.12);

    color:#41ff9b;

}

.progress{

    background:
    rgba(0,153,255,.12);

    color:#3db7ff;

}

.planned{

    background:
    rgba(255,153,0,.12);

    color:#ffb300;

}

/* MOBILE */

@media(max-width:768px){

.timeline::before{

    left:18px;

}

.timeline-item{

    width:100%;

    left:0 !important;

    padding-left:40px !important;

    padding-right:0 !important;

    margin-bottom:15px;

}

.timeline-item::before{

    left:10px !important;

    width:12px;
    height:12px;

}

.timeline-card{

    padding:12px;

}

.roadmap-title{

    font-size:16px;

}

.roadmap-description{

    font-size:11px;

}

.modal-title{

    font-size:24px;

}

}

</style>

</head>

<body>

<div class="modal-title">

🛣 ROADMAP

</div>

<div class="timeline">

<?php

$i = 0;

while($row=mysqli_fetch_assoc($roadmaps)){

$class = "";

if($row['status']=="Completed"){

    $class = "completed";

}
elseif($row['status']=="In Progress"){

    $class = "progress";

}
else{

    $class = "planned";

}

$side = ($i % 2 == 0)
?
"left"
:
"right";

?>

<div class="timeline-item <?php echo $side; ?>">

<div class="timeline-card">

<div class="version">

🚀 <?php echo htmlspecialchars($row['version']); ?>

</div>

<div class="roadmap-title">

<?php echo htmlspecialchars($row['title']); ?>

</div>

<div class="roadmap-description">

<?php echo nl2br(htmlspecialchars($row['description'])); ?>

</div>

<div class="status <?php echo $class; ?>">

<?php echo htmlspecialchars($row['status']); ?>

</div>

</div>

</div>

<?php

$i++;

}

?>

</div>

</body>
</html>