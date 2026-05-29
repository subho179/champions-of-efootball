<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

$id = $_GET['id'];

$news =
mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT *
FROM news
WHERE id='$id'"

)

);



if(isset($_POST['update_news'])){

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

    "UPDATE news
    SET

    title='$title',
    description='$description',
    category='$category'

    WHERE id='$id'"

    );

    header("Location: news.php");

}

?>

<!DOCTYPE html>
<html>
<head>

<title>
Edit News
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



.edit-box{

    max-width:700px;

    margin:auto;

    padding:30px;

    border-radius:24px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.1);

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

    font-weight:800;

    cursor:pointer;

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

<div class="edit-box">

<div class="top-bar">

    <h1>
    ✏ Edit News
    </h1>

    <a href="news.php"
    class="back-btn">

        ← Back to News

    </a>

</div>

<form method="POST">

<input type="text"
name="title"
value="<?php
echo $news['title'];
?>"
required>

<textarea
name="description"
required><?php
echo $news['description'];
?></textarea>

<select name="category">

<option value="<?php
echo $news['category'];
?>">

<?php
echo $news['category'];
?>

</option>

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
name="update_news">

🚀 Update News

</button>

</form>

</div>

</body>
</html>