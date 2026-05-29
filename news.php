<?php

include __DIR__ . '/assets/db.php';

$news =
mysqli_query(

$conn,

"SELECT *
FROM news
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

<title>
COE News
</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;800&display=swap"
rel="stylesheet">

<style>

body{

    background:#050505;

    color:white;

    font-family:'Orbitron',sans-serif;

    padding:40px;

}



.news-grid{

    display:flex;

    flex-direction:column;

    gap:24px;

}



.news-card{

    padding:28px;

    border-radius:28px;

    background:
    linear-gradient(
    135deg,
    rgba(255,255,255,0.03),
    rgba(255,153,0,0.02)
    );

    border:
    1px solid rgba(255,153,0,0.08);

    transition:0.3s;

}



.news-card:hover{

    transform:translateY(-4px);

    border-color:
    rgba(255,153,0,0.2);

    box-shadow:
    0 0 28px rgba(255,153,0,0.08);

}



.news-category{

    display:inline-block;

    padding:8px 14px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-size:13px;

    margin-bottom:18px;

}



.news-title{

    font-size:30px;

    font-weight:800;

    margin-bottom:16px;

}



.news-description{

    color:#cfcfcf;

    line-height:1.7;

    margin-bottom:18px;

}



.news-time{

    color:#888;

    font-size:13px;

}

.no-news{

    text-align:center;

    padding:80px 20px;

    font-size:28px;

    color:#777;

}

/* HEADER */

.news-header{

    text-align:center;

    margin-bottom:50px;

}



/* TITLE */

.news-header h1{

    font-size:54px;

    color:#ff9900;

    margin-bottom:14px;

    text-shadow:
    0 0 18px rgba(255,153,0,0.2);

}



/* SUBTEXT */

.news-header p{

    color:#a0a0a0;

    font-size:16px;

    max-width:700px;

    margin:auto;

    line-height:1.7;

}

/* CATEGORY */

.news-category{

    display:inline-block;

    padding:8px 16px;

    border-radius:14px;

    font-size:13px;

    font-weight:700;

    margin-bottom:18px;

    border:1px solid transparent;

}



/* UPDATE */

.news-category.update{

    background:
    rgba(0,140,255,0.14);

    color:#52a8ff;

    border-color:
    rgba(82,168,255,0.25);

    box-shadow:
    0 0 18px rgba(82,168,255,0.12);

}



/* MATCHDAY */

.news-category.matchday{

    background:
    rgba(255,153,0,0.14);

    color:#ffb300;

    border-color:
    rgba(255,179,0,0.22);

    box-shadow:
    0 0 18px rgba(255,179,0,0.12);

}



/* ANNOUNCEMENT */

.news-category.announcement{

    background:
    rgba(170,0,255,0.14);

    color:#d580ff;

    border-color:
    rgba(213,128,255,0.22);

    box-shadow:
    0 0 18px rgba(213,128,255,0.12);

}



/* PATCH */

.news-category.patch{

    background:
    rgba(0,255,120,0.14);

    color:#4dff9a;

    border-color:
    rgba(77,255,154,0.22);

    box-shadow:
    0 0 18px rgba(77,255,154,0.12);

}



/* MVP */

.news-category.mvp{

    background:
    rgba(255,215,0,0.14);

    color:#ffd95c;

    border-color:
    rgba(255,217,92,0.25);

    box-shadow:
    0 0 18px rgba(255,217,92,0.12);

}

/* CATEGORY CARD GLOW */

.news-card.update{

    border-color:
    rgba(82,168,255,0.14);

}



.news-card.matchday{

    border-color:
    rgba(255,179,0,0.14);

}



.news-card.announcement{

    border-color:
    rgba(213,128,255,0.14);

}



.news-card.patch{

    border-color:
    rgba(77,255,154,0.14);

}



.news-card.mvp{

    border-color:
    rgba(255,217,92,0.14);

}

/* TOP BAR */

.news-top-bar{

    display:flex;

    justify-content:flex-start;

    margin-bottom:35px;

}



/* HOME BUTTON */

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

    backdrop-filter:blur(12px);

}



/* HOVER */

.home-btn:hover{

    transform:translateY(-2px);

    background:
    rgba(255,153,0,0.2);

    box-shadow:
    0 0 20px rgba(255,153,0,0.14);

}

</style>

</head>
<body>

<div class="news-top-bar">

    <a href="index.php"
    class="home-btn">

        ← HOME

    </a>

</div>

<div class="news-header">

    <h1>
     LATEST NEWS
    </h1>

    <p>

        Latest tournament updates,
        announcements and esports activity.

    </p>

</div>

<div class="news-grid">

<?php

if(mysqli_num_rows($news) == 0){

?>

<div class="no-news">

 No news published yet

</div>

<?php } ?>

<?php
while($item =
mysqli_fetch_assoc($news)){
?>

<div class="news-card <?php
echo strtolower($item['category']);
?>">

<div class="news-category <?php
echo strtolower($item['category']);
?>">

<?php
echo $item['category'];
?>

</div>



<div class="news-title">

<?php
echo $item['title'];
?>

</div>



<div class="news-description">

<?php
echo $item['description'];
?>

</div>



<div class="news-time">

🕒
<?php
echo date(
'd M Y - h:i A',
strtotime(
$item['created_at']
)
);
?>

</div>

</div>

<?php } ?>

</div>

</body>
</html>