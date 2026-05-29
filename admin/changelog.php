<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

if(isset($_POST['add_changelog'])){

    $version = mysqli_real_escape_string(
        $conn,
        $_POST['version']
    );

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    mysqli_query(

        $conn,

        "INSERT INTO changelog
        (
            version,
            title,
            description
        )

        VALUES
        (
            '$version',
            '$title',
            '$description'
        )"

    );
}

?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Changelog Admin
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

.changelog-box{

    max-width:900px;

    margin:auto;

    padding:30px;

    border-radius:24px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.1);

}

.top-bar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

}

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

.back-btn:hover{

    transform:translateY(-2px);

    background:
    rgba(255,153,0,0.2);

}

h1{

    color:#ff9900;

}

input,
textarea{

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

    height:180px;

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

}

.admin-news-actions a:first-child{

    background:
    rgba(0,120,255,0.15);

    color:#4da3ff;

}

.admin-news-actions a:last-child{

    background:
    rgba(255,0,60,0.15);

    color:#ff4d6d;

}

hr{

    margin:40px 0;

    border-color:
    rgba(255,153,0,0.1);

}

</style>

</head>

<body>

<div class="changelog-box">

<div class="top-bar">

<h1>
📜 CHANGELOG PANEL
</h1>

<a href="index.php"
class="back-btn">

← Admin Panel

</a>

</div>

<?php
if(isset($_POST['add_changelog'])){
?>

<div class="success">

✅ Changelog Published

</div>

<?php } ?>

<form method="POST">

<input
type="text"
name="version"
placeholder="Version (Example: v1.0.5)"
required>

<input
type="text"
name="title"
placeholder="Update Title"
required>

<textarea
name="description"
placeholder="Enter changelog details..."
required></textarea>

<button
type="submit"
name="add_changelog">

🚀 Publish Changelog

</button>

</form>

<hr>

<h2>
📜 Published Changelogs
</h2>

<?php

$list = mysqli_query(
$conn,
"SELECT * FROM changelog ORDER BY id DESC"
);

while($row = mysqli_fetch_assoc($list)){

?>

<div class="news-admin-card">

<div>

<div class="admin-news-title">

🚀 <?php echo $row['version']; ?>

</div>

<div class="admin-news-category">

<?php echo $row['title']; ?>

</div>

</div>

<div class="admin-news-actions">

<a href="edit-changelog.php?id=<?php echo $row['id']; ?>">

✏ Edit

</a>

<a href="delete-changelog.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete changelog?')">

🗑 Delete

</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>