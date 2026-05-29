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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700;800&display=swap"
rel="stylesheet">

<meta charset="utf-8">

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

    display:flex;
    align-items:center;
    gap:12px;

    color:#ff9900;

    font-size:42px;
    font-weight:800;

    margin-bottom:30px;

}



/* CARD */

.change-card{

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

    border-radius:20px;

    padding:22px;

    margin-bottom:18px;

}



/* VERSION */

.version{

    display:inline-block;

    padding:8px 14px;

    border-radius:12px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-size:13px;

    font-weight:700;

    margin-bottom:15px;

}



/* TITLE */

.change-title{

    font-size:24px;

    font-weight:700;

    margin-bottom:15px;

}



/* DESC */

.change-description{

    color:#d0d0d0;

    line-height:1.8;

    white-space:pre-line;

}



/* DATE */

.change-date{

    margin-top:18px;

    color:#888;

    font-size:12px;

}

</style>

</head>

<body>

<div class="modal-title">
 Latest Updates
</div>

<?php

while($row=mysqli_fetch_assoc($changes)){

?>

<div class="change-card">

<div class="version">

 <?php echo $row['version']; ?>

</div>

<div class="change-title">

<?php echo $row['title']; ?>

</div>

<div class="change-description">

<?php echo nl2br($row['description']); ?>

</div>

<div class="change-date">

<?php

echo date(
'd M Y',
strtotime($row['created_at'])
);

?>

</div>

</div>

<?php } ?>

</body>
</html>