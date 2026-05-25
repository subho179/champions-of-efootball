<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';



$id = intval($_GET['id']);



$player = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT * FROM players
WHERE id='$id'"

)

);



if(!$player){

    die("Player Not Found");

}



/* UPDATE PLAYER */

if(isset($_POST['update_player'])){

    $player_name =
    mysqli_real_escape_string(
    $conn,
    $_POST['player_name']
    );



    mysqli_query(

    $conn,

    "UPDATE players

    SET player_name='$player_name'

    WHERE id='$id'"

    );



    header("Location: players.php");

}

?>

<!DOCTYPE html>
<html>

<head>

<title>
Edit Player
</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    background:#050505;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    min-height:100vh;

}



/* CARD */

.edit-card{

    width:100%;

    max-width:500px;

    padding:40px;

    background:
    rgba(255,255,255,0.04);

    border-radius:25px;

    border:
    1px solid rgba(255,153,0,0.12);

}



/* TITLE */

.edit-title{

    font-size:38px;

    color:#ff9900;

    margin-bottom:30px;

    text-align:center;

}



/* INPUT */

.input-box{

    margin-bottom:25px;

}

.input-box input{

    width:100%;

    padding:18px;

    border:none;

    outline:none;

    border-radius:14px;

    background:
    rgba(255,255,255,0.05);

    color:white;

    font-size:16px;

}



/* BUTTON */

.update-btn{

    width:100%;

    padding:18px;

    border:none;

    border-radius:14px;

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ff6600
    );

    color:black;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;

}

.update-btn:hover{

    transform:translateY(-2px);

    box-shadow:
    0 0 25px rgba(255,153,0,0.5);

}

</style>

</head>

<body>

<div class="edit-card">

<h1 class="edit-title">

✏️ Edit Player

</h1>



<form method="POST">

<div class="input-box">

<input type="text"

name="player_name"

value="<?php
echo $player['player_name'];
?>"

required>

</div>



<button type="submit"

name="update_player"

class="update-btn">

Update Player

</button>

</form>

</div>

</body>
</html>