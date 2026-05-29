<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

$id = intval($_GET['id']);

$data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM changelog WHERE id='$id'"
    )
);

if(isset($_POST['update'])){

    $version = mysqli_real_escape_string($conn,$_POST['version']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    mysqli_query(

        $conn,

        "UPDATE changelog SET

        version='$version',
        title='$title',
        description='$description'

        WHERE id='$id'"

    );

    header("Location: changelog.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Changelog</title>

<style>

body{
background:#050505;
color:white;
font-family:Arial,sans-serif;
padding:40px;
}

.box{
max-width:800px;
margin:auto;
padding:30px;
background:#111;
border-radius:20px;
}

input,
textarea{

width:100%;
padding:15px;
margin-bottom:20px;
border:none;
border-radius:12px;
background:#1b1b1b;
color:white;

}

textarea{
height:180px;
}

button{

width:100%;
padding:16px;
background:#ff9900;
border:none;
border-radius:12px;
font-weight:bold;
cursor:pointer;

}

.back{

display:inline-block;
margin-bottom:20px;
color:#ff9900;
text-decoration:none;

}

</style>
</head>

<body>

<div class="box">

<a href="changelog.php" class="back">
← Back To Changelog
</a>

<h1>📜 Edit Changelog</h1>

<form method="POST">

<input
type="text"
name="version"
value="<?php echo $data['version']; ?>"
required>

<input
type="text"
name="title"
value="<?php echo $data['title']; ?>"
required>

<textarea
name="description"
required><?php echo $data['description']; ?></textarea>

<button
type="submit"
name="update">

Update Changelog

</button>

</form>

</div>

</body>
</html>