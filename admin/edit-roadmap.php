<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

$id = intval($_GET['id']);

$data = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT *
        FROM roadmap
        WHERE id='$id'"

    )

);

if(!$data){

    die("Roadmap not found");

}

if(isset($_POST['update'])){

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

        "UPDATE roadmap SET

        version='$version',
        title='$title',
        description='$description',
        status='$status'

        WHERE id='$id'"

    );

    header("Location: roadmap.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Roadmap</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;800&display=swap"
rel="stylesheet">

<style>

body{
    background:#050505;
    color:white;
    font-family:'Orbitron',sans-serif;
    padding:40px;
}

.box{
    max-width:900px;
    margin:auto;
    padding:30px;
    border-radius:24px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,153,0,0.1);
}

.back-btn{
    display:inline-block;
    margin-bottom:25px;
    text-decoration:none;
    color:#ffb300;
}

input,
textarea,
select{

    width:100%;
    padding:16px;
    margin-bottom:18px;

    background:#111;

    color:white;

    border-radius:14px;

    border:1px solid rgba(255,153,0,0.1);

    font-family:'Orbitron',sans-serif;

}

textarea{
    height:180px;
}

button{

    width:100%;

    padding:16px;

    border:none;

    border-radius:14px;

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ffb300
    );

    font-weight:800;

    cursor:pointer;

}

h1{
    color:#ff9900;
}

</style>

</head>

<body>

<div class="box">

<a href="roadmap.php" class="back-btn">
← Back To Roadmap
</a>

<h1>
🛣 Edit Roadmap
</h1>

<form method="POST">

<input
type="text"
name="version"
value="<?php echo htmlspecialchars($data['version']); ?>"
required>

<input
type="text"
name="title"
value="<?php echo htmlspecialchars($data['title']); ?>"
required>

<textarea
name="description"
required><?php echo htmlspecialchars($data['description']); ?></textarea>

<select
name="status"
required>

<option value="Planned"
<?php if($data['status']=="Planned") echo "selected"; ?>>
Planned
</option>

<option value="In Progress"
<?php if($data['status']=="In Progress") echo "selected"; ?>>
In Progress
</option>

<option value="Completed"
<?php if($data['status']=="Completed") echo "selected"; ?>>
Completed
</option>

</select>

<button
type="submit"
name="update">

🚀 Update Roadmap

</button>

</form>

</div>

</body>
</html>