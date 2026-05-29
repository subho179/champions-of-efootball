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

<title>COE Roadmap</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;800&display=swap"
rel="stylesheet">

<style>

body{
    background:#050505;
    color:white;
    font-family:'Orbitron',sans-serif;
    padding:40px;
}

.home-btn{

    display:inline-block;

    margin-bottom:40px;

    text-decoration:none;

    color:#ffb300;

    padding:12px 20px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

}

.header{

    text-align:center;

    margin-bottom:60px;

}

.header h1{

    color:#ff9900;

    font-size:54px;

}

.header p{

    color:#999;

}

.card{

    padding:30px;

    margin-bottom:25px;

    border-radius:24px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

}

.version{

    display:inline-block;

    padding:8px 16px;

    border-radius:12px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-weight:700;

    margin-bottom:15px;

}

.title{

    font-size:30px;

    margin-bottom:15px;

}

.description{

    line-height:1.8;

    color:#d0d0d0;

    white-space:pre-line;

}

.status{

    display:inline-block;

    margin-top:20px;

    padding:10px 16px;

    border-radius:12px;

    font-weight:700;

}

.completed{

    background:
    rgba(0,255,120,0.12);

    color:#41ff9b;

}

.progress{

    background:
    rgba(0,153,255,0.12);

    color:#4ab8ff;

}

.planned{

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

}

</style>

</head>

<body>

<a href="index.php"
class="home-btn">

← HOME

</a>

<div class="header">

<h1>
🛣 ROADMAP
</h1>

<p>

Track upcoming updates and future plans for COE.

</p>

</div>

<?php

while($row=mysqli_fetch_assoc($roadmaps)){

?>

<div class="card">

<div class="version">

🚀 <?php echo $row['version']; ?>

</div>

<div class="title">

<?php echo $row['title']; ?>

</div>

<div class="description">

<?php echo nl2br($row['description']); ?>

</div>

<div class="status

<?php

if($row['status']=="Completed"){

echo " completed";

}
elseif($row['status']=="In Progress"){

echo " progress";

}
else{

echo " planned";

}

?>

">

<?php echo $row['status']; ?>

</div>

</div>

<?php } ?>

</body>
</html>