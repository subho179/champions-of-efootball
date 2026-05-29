<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

if(isset($_POST['add_news'])){

    $title =
    mysqli_real_escape_string(
    $conn,
    $_POST['title']
    );

    $description =
    mysqli_real_escape_string(
    $conn,
    $_POST['description']
    );

    $category =
    mysqli_real_escape_string(
    $conn,
    $_POST['category']
    );

    mysqli_query(

    $conn,

    "INSERT INTO news(
    title,
    description,
    category
    )

    VALUES(
    '$title',
    '$description',
    '$category'
    )"

    );

}

?>

<!DOCTYPE html>
<html>
<head>

<title>
COE News Admin
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



.news-box{

    max-width:700px;

    margin:auto;

    padding:30px;

    border-radius:24px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.1);

}



h1{

    color:#ff9900;

    margin-bottom:30px;

}



input,
textarea,
select{

    width:100%;

    margin-bottom:20px;

    padding:16px;

    border-radius:16px;

    border:
    1px solid rgba(255,153,0,0.1);

    background:#111;

    color:white;

    font-family:'Orbitron',sans-serif;

}



textarea{

    height:140px;

    resize:none;

}



button{

    width:100%;

    padding:16px;

    border:none;

    border-radius:16px;

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ffb300
    );

    color:black;

    font-size:16px;

    font-weight:800;

    cursor:pointer;

}



.success{

    background:
    rgba(0,255,120,0.12);

    color:#4dff9a;

    padding:14px;

    border-radius:14px;

    margin-bottom:20px;

}

/* ADMIN NEWS */

.news-admin-card{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:20px;

    margin-top:20px;

    border-radius:20px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

}



.admin-news-title{

    font-size:20px;

    font-weight:700;

    margin-bottom:8px;

}



.admin-news-category{

    display:inline-block;

    padding:6px 12px;

    border-radius:12px;

    background:
    rgba(255,153,0,0.12);

    color:#ffb300;

    font-size:12px;

}



.admin-news-actions{

    display:flex;

    gap:12px;

}



.admin-news-actions a{

    text-decoration:none;

    padding:10px 16px;

    border-radius:12px;

    font-size:14px;

    font-weight:700;

    transition:0.3s;

}



/* EDIT */

.admin-news-actions a:first-child{

    background:
    rgba(0,120,255,0.15);

    color:#4da3ff;

}



/* DELETE */

.admin-news-actions a:last-child{

    background:
    rgba(255,0,60,0.15);

    color:#ff4d6d;

}



/* HOVER */

.admin-news-actions a:hover{

    transform:translateY(-2px);

}

/* TOP BAR */

.top-bar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

}



/* BACK BUTTON */

.back-btn{

    text-decoration:none;

    padding:12px 20px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

    border:
    1px solid rgba(255,153,0,0.15);

    color:#ffb300;

    font-size:14px;

    font-weight:700;

    transition:0.3s;

}



/* HOVER */

.back-btn:hover{

    transform:translateY(-2px);

    background:
    rgba(255,153,0,0.2);

    box-shadow:
    0 0 18px rgba(255,153,0,0.12);

}

</style>

</head>
<body>

<div class="news-box">

<div class="top-bar">

    <h1>
    📰 COE NEWS PANEL
    </h1>

    <a href="index.php"
    class="back-btn">

        ← Admin Panel

    </a>

</div>

<?php
if(isset($_POST['add_news'])){
?>

<div class="success">

✅ News Published

</div>

<?php } ?>

<form method="POST">

<input type="text"
name="title"
placeholder="News Title"
required>

<textarea
name="description"
placeholder="News Description"
required></textarea>

<select name="category">

<option value="UPDATE">
UPDATE
</option>

<option value="MATCHDAY">
MATCHDAY
</option>

<option value="ANNOUNCEMENT">
ANNOUNCEMENT
</option>

<option value="PATCH">
PATCH
</option>

<option value="MVP">
MVP
</option>

</select>

<button type="submit"
name="add_news">

🚀 Publish News

</button>

</form>

<hr style="margin:40px 0;
border-color:rgba(255,153,0,0.1);">

<h2>
📰 Published News
</h2>

<?php

$allNews =
mysqli_query(

$conn,

"SELECT *
FROM news
ORDER BY id DESC"

);

while($item =
mysqli_fetch_assoc($allNews)){

?>

<div class="news-admin-card">

    <div>

        <div class="admin-news-title">

            <?php
            echo $item['title'];
            ?>

        </div>

        <div class="admin-news-category">

            <?php
            echo $item['category'];
            ?>

        </div>

    </div>



    <div class="admin-news-actions">

        <a href="edit-news.php?id=<?php
        echo $item['id'];
        ?>">

            ✏ Edit

        </a>



        <a href="delete-news.php?id=<?php
        echo $item['id'];
        ?>"

        onclick="return confirm(
        'Delete this news?'
        );">

            🗑 Delete

        </a>

    </div>

</div>

<?php } ?>

</div>

</body>
</html>