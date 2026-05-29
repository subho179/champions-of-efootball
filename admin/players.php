<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';



// ADD PLAYER

if (isset($_POST['add_player'])) {

    $player_name =
    mysqli_real_escape_string(
    $conn,
    $_POST['player_name']
    );



    $team_name =
    mysqli_real_escape_string(
    $conn,
    $_POST['team_name']
    );



    /* INSERT PLAYER */

    $insert =

    "INSERT INTO players(

    player_name,
    team_name

    )

    VALUES(

    '$player_name',
    '$team_name'

    )";



    mysqli_query($conn, $insert);



    /* AUTO CREATE STANDINGS */

    $player_id =
    mysqli_insert_id($conn);



    mysqli_query($conn,

    "INSERT INTO standings(

    player_id,
    played,
    wins,
    draws,
    losses,
    goals_for,
    goals_against,
    goal_difference,
    points,
    previous_position

    )

    VALUES(

    '$player_id',
    0,
    0,
    0,
    0,
    0,
    0,
    0,
    0,
    0

    )"

    );



    header("Location: players.php");

    exit();

}



/* DELETE PLAYER */

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];



    /* DELETE STANDINGS */

    mysqli_query($conn,

    "DELETE FROM standings

    WHERE player_id='$id'"

    );



    /* DELETE FIXTURES */

    mysqli_query($conn,

    "DELETE FROM fixtures

    WHERE

    home_player_id='$id'

    OR

    away_player_id='$id'"

    );



    /* DELETE PLAYER */

    mysqli_query($conn,

    "DELETE FROM players

    WHERE id='$id'"

    );



    header("Location: players.php");

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Champions of eFootball - Players

</title>



<link rel="stylesheet"
href="../includes/layout.css">



<style>

.edit-btn{

    background:#3b82f6;

    color:white;

    padding:10px 16px;

    border-radius:10px;

    text-decoration:none;

    margin-right:10px;

}



/* TABLE ROW HOVER */

.player-row{

    transition:0.3s;

}



.player-row:hover{

    background:#1f1f1f;

}



/* DELETE BUTTON */

.delete-btn{

    background:#ff3b3b;

    color:white;

    padding:10px 15px;

    border-radius:8px;

    text-decoration:none;

}



/* DELETE HOVER */

.delete-btn:hover{

    background:#ff5a5a;

}



/* ADD BUTTON */

.add-btn{

    background:#ff9900;

    color:black;

    border:none;

    padding:14px 22px;

    border-radius:10px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;

}



.add-btn:hover{

    background:#ffb733;

    transform:translateY(-2px);

}



/* INPUT */

.player-input{

    width:100%;

    padding:15px;

    margin-bottom:15px;

    background:#222;

    border:1px solid #333;

    border-radius:10px;

    color:white;

}

</style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>



<div class="main-content">

<?php include __DIR__ . '/../includes/topbar.php'; ?>



<div class="content">



<!-- TITLE -->

<h1 style="
color:#ff9900;
margin-bottom:30px;
font-size:38px;
">

👥 Players Management

</h1>



<!-- DASHBOARD -->

<div class="cards"

style="
display:flex;
gap:20px;
flex-wrap:wrap;
margin-bottom:40px;
">

<div class="card"

style="
background:#171717;
padding:25px;
border-radius:16px;
min-width:220px;
box-shadow:0 0 20px rgba(255,153,0,0.08);
">

<h2 style="
color:#ff9900;
margin-bottom:10px;
font-size:18px;
">

Total Players

</h2>



<p style="
font-size:32px;
font-weight:bold;
">

<?php

$count_query =
mysqli_query($conn,

"SELECT * FROM players"

);



echo mysqli_num_rows($count_query);

?>

</p>

</div>

</div>



<!-- ADD PLAYER -->

<div class="form-box"

style="
background:#171717;
padding:25px;
border-radius:16px;
max-width:450px;
margin-bottom:40px;
box-shadow:0 0 20px rgba(255,153,0,0.08);
">

<h2 style="
color:#ff9900;
margin-bottom:20px;
">

Add New Player

</h2>



<form method="POST">



<input type="text"

name="player_name"

placeholder="Enter Player Name"

required

class="player-input">



<input type="text"

name="team_name"

placeholder="Enter Team Name"

required

class="player-input">



<button type="submit"

name="add_player"

class="add-btn">

Add Player

</button>

</form>

</div>



<!-- PLAYERS TABLE -->

<div class="table-container"

style="
overflow-x:auto;
">



<table

style="
width:100%;
border-collapse:collapse;
background:#171717;
border-radius:15px;
overflow:hidden;
">



<tr>

<th style="
background:#ff9900;
color:black;
padding:18px;
">

ID

</th>



<th style="
background:#ff9900;
color:black;
padding:18px;
">

Player Name

</th>



<th style="
background:#ff9900;
color:black;
padding:18px;
">

Team Name

</th>



<th style="
background:#ff9900;
color:black;
padding:18px;
">

Action

</th>

</tr>



<?php

$select =

"SELECT * FROM players
ORDER BY id DESC";



$query =
mysqli_query($conn, $select);



while($row = mysqli_fetch_assoc($query)) {

?>



<tr class="player-row"

style="
border-bottom:1px solid #2b2b2b;
">



<td style="
padding:18px;
text-align:center;
">

<?php echo $row['id']; ?>

</td>



<td style="
padding:18px;
text-align:center;
">

<?php echo $row['player_name']; ?>

</td>



<td style="
padding:18px;
text-align:center;
">

<?php echo $row['team_name']; ?>

</td>



<td style="
padding:18px;
text-align:center;
">



<a href="players.php?delete=<?php
echo $row['id'];
?>"

onclick="return confirm(
'Delete this player?'
)"

class="delete-btn">

Delete

</a>



<a href="edit-player.php?id=<?php
echo $row['id'];
?>"

class="edit-btn">

Edit

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>