<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

if(isset($_POST['add_roadmap'])){

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

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    mysqli_query(

        $conn,

        "INSERT INTO roadmap
        (
            version,
            title,
            description,
            status
        )

        VALUES
        (
            '$version',
            '$title',
            '$description',
            '$status'
        )"

    );

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Roadmap Panel</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;800&display=swap"
rel="stylesheet">

<style>

body{

    background:#050505;
    color:white;
    font-family:'Orbitron',sans-serif;
    padding:40px;

}

.panel{

    max-width:1000px;
    margin:auto;

}

.top-bar{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}

.back-btn{

    text-decoration:none;
    color:#ffb300;

    padding:12px 20px;

    border-radius:14px;

    background:
    rgba(255,153,0,0.12);

    border:
    1px solid rgba(255,153,0,0.15);

}

h1{

    color:#ff9900;

}

input,
textarea,
select{

    width:100%;

    padding:16px;

    margin-bottom:18px;

    border-radius:16px;

    background:#111;

    border:
    1px solid rgba(255,153,0,0.1);

    color:white;

    font-family:'Orbitron',sans-serif;

}

textarea{

    height:180px;

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

    font-weight:800;

    cursor:pointer;

}

.roadmap-card{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-top:20px;

    padding:20px;

    border-radius:20px;

    background:
    rgba(255,255,255,0.03);

    border:
    1px solid rgba(255,153,0,0.08);

}

.version{

    color:#ffb300;

    font-weight:800;

    margin-bottom:10px;

}

.status{

    display:inline-block;

    padding:6px 12px;

    border-radius:12px;

    font-size:12px;

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

.actions{

    display:flex;
    gap:10px;

}

.actions a{

    text-decoration:none;

    padding:10px 14px;

    border-radius:12px;

    font-weight:700;

}

.edit{

    background:
    rgba(0,120,255,0.15);

    color:#4da3ff;

}

.delete{

    background:
    rgba(255,0,60,0.15);

    color:#ff4d6d;

}

</style>

</head>

<body>

<div class="panel">

<div class="top-bar">

<h1>
🛣 ROADMAP PANEL
</h1>

<a href="index.php"
class="back-btn">

← Admin Panel

</a>

</div>

<form method="POST">

<input
type="text"
name="version"
placeholder="Version (v1.0.8)"
required>

<input
type="text"
name="title"
placeholder="Roadmap Title"
required>

<textarea
name="description"
placeholder="Roadmap Details..."
required></textarea>

<select
name="status"
required>

<option value="Planned">

Planned

</option>

<option value="In Progress">

In Progress

</option>

<option value="Completed">

Completed

</option>

</select>

<button
type="submit"
name="add_roadmap">

🚀 Publish Roadmap

</button>

</form>

<hr style="margin:40px 0;
border-color:rgba(255,153,0,0.1);">

<h2>
🛣 Published Roadmaps
</h2>

<?php

$list = mysqli_query(

$conn,

"SELECT *
FROM roadmap
ORDER BY id DESC"

);

while($row=mysqli_fetch_assoc($list)){

?>

<div class="roadmap-card">

<div>

<div class="version">

🚀 <?php echo $row['version']; ?>

</div>

<div>

<?php echo $row['title']; ?>

</div>

<br>

<div class="status

<?php

if($row['status']=="Completed"){

echo "completed";

}
elseif($row['status']=="In Progress"){

echo "progress";

}
else{

echo "planned";

}

?>

">

<?php echo $row['status']; ?>

</div>

</div>

<div class="actions">

<a
class="edit"
href="edit-roadmap.php?id=<?php echo $row['id']; ?>">

✏ Edit

</a>

<a
class="delete"
href="delete-roadmap.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete roadmap?')">

🗑 Delete

</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>