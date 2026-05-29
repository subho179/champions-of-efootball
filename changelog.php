<?php

include __DIR__ . '/assets/db.php';

$changes = mysqli_query(

$conn,

"SELECT *
FROM changelog
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Changelog
</title>

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



/* HOME BUTTON */

.changelog-top{

    margin-bottom:30px;

}

.home-btn{

    text-decoration:none;

    padding:12px 22px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

    border:
    1px solid rgba(255,153,0,0.14);

    color:#ffb300;

    font-weight:700;

    transition:0.3s;

}

.home-btn:hover{

    background:
    rgba(255,153,0,0.2);

    box-shadow:
    0 0 20px rgba(255,153,0,0.14);

}



/* HEADER */

.changelog-header{

    text-align:center;

    margin-bottom:60px;

}

.changelog-header h1{

    font-size:56px;

    color:#ff9900;

    margin-bottom:14px;

}

.changelog-header p{

    color:#999;

    max-width:700px;

    margin:auto;

    line-height:1.8;

}



/* GRID */

.changelog-grid{

    display:flex;

    flex-direction:column;

    gap:25px;

}



/* CARD */

.changelog-card{

    padding:30px;

    border-radius:24px;

    background:
    rgba(20,20,20,0.85);

    border:
    1px solid rgba(255,153,0,0.1);

    transition:0.3s;

    position:relative;

    overflow:hidden;

}

.changelog-card::before{

    content:"";

    position:absolute;

    width:180px;

    height:180px;

    background:#ff9900;

    filter:blur(100px);

    opacity:0.06;

    top:-40px;

    right:-40px;

}

.changelog-card:hover{

    transform:translateY(-5px);

    border-color:
    rgba(255,153,0,0.35);

}



/* VERSION */

.version{

    display:inline-block;

    padding:8px 16px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-size:13px;

    font-weight:700;

    margin-bottom:20px;

}



/* TITLE */

.change-title{

    font-size:30px;

    font-weight:800;

    margin-bottom:18px;

}



/* DESCRIPTION */

.change-description{

    color:#d0d0d0;

    line-height:1.8;

    white-space:pre-line;

    margin-bottom:20px;

}



/* DATE */

.change-date{

    color:#888;

    font-size:13px;

}



/* EMPTY */

.no-changelog{

    text-align:center;

    padding:100px 20px;

    color:#777;

    font-size:28px;

}



/* MOBILE */

@media(max-width:768px){

    body{

        padding:20px;

    }

    .changelog-header h1{

        font-size:40px;

    }

    .change-title{

        font-size:22px;

    }

}

</style>

</head>

<body>

<div class="changelog-top">

<a href="index.php"
class="home-btn">

← HOME

</a>

</div>



<div class="changelog-header">

<h1>
📜 CHANGELOG
</h1>

<p>

Track every update, feature release,
bug fix and improvement made to
Champions of eFootball.

</p>

</div>



<div class="changelog-grid">

<?php

if(mysqli_num_rows($changes) == 0){

?>

<div class="no-changelog">

📜 No changelog published yet

</div>

<?php

}

while($row = mysqli_fetch_assoc($changes)){

?>

<div class="changelog-card">

<div class="version">

🚀 <?php echo $row['version']; ?>

</div>

<div class="change-title">

<?php echo $row['title']; ?>

</div>

<div class="change-description">

<?php echo nl2br($row['description']); ?>

</div>

<div class="change-date">

🕒
<?php

echo date(
'd M Y - h:i A',
strtotime($row['created_at'])
);

?>

</div>

</div>

<?php } ?>

</div>

</body>

</html>