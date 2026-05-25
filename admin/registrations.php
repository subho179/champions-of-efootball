<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';




/* OPEN REGISTRATION */

if(isset($_GET['open'])){

    mysqli_query(

    $conn,

    "UPDATE website_settings
    SET registration_status='open'
    WHERE id=1"

    );

    header("Location: registrations.php");

}



/* CLOSE REGISTRATION */

if(isset($_GET['close'])){

    mysqli_query(

    $conn,

    "UPDATE website_settings
    SET registration_status='closed'
    WHERE id=1"

    );

    header("Location: registrations.php");

}



/* APPROVE PLAYER */

if(isset($_GET['approve'])){

    $id = intval($_GET['approve']);



    $player = mysqli_fetch_assoc(

    mysqli_query(

    $conn,

    "SELECT * FROM registrations
    WHERE id='$id'"

    )

    );



    if($player){

        mysqli_query(

        $conn,

        "INSERT INTO players (

player_name,
team_name,
favorite_team,
profile_pic

)

VALUES (

'".$player['player_name']."',
'".$player['team_name']."',
'".$player['favorite_team']."',
'".$player['profile_pic']."'

)"

        );



        mysqli_query(

        $conn,

        "UPDATE registrations
        SET status='approved'
        WHERE id='$id'"

        );

    }



    header("Location: registrations.php");

}



/* REJECT PLAYER */

if(isset($_GET['reject'])){

    $id = intval($_GET['reject']);



    mysqli_query(

    $conn,

    "UPDATE registrations
    SET status='rejected'
    WHERE id='$id'"

    );



    header("Location: registrations.php");

}



$settings = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT * FROM website_settings LIMIT 1"

)

);



$registrations = mysqli_query(

$conn,

"SELECT * FROM registrations
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>
Registration Management
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

    padding:30px;

}



/* TITLE */

.page-title{

    font-size:42px;

    color:#ff9900;

    margin-bottom:30px;

}



/* TOP BAR */

.top-bar{

    display:flex;

    gap:20px;

    flex-wrap:wrap;

    margin-bottom:40px;

}



/* BUTTON */

.action-btn{

    padding:14px 24px;

    border-radius:12px;

    text-decoration:none;

    font-weight:bold;

    transition:0.3s;

}



/* OPEN */

.open-btn{

    background:#22c55e;

    color:white;

}



/* CLOSE */

.close-btn{

    background:#ef4444;

    color:white;

}



/* STATUS */

.status-box{

    padding:14px 24px;

    border-radius:12px;

    background:
    rgba(255,153,0,0.12);

    border:
    1px solid rgba(255,153,0,0.15);

}



/* TABLE */

.table-container{

    overflow-x:auto;

}



table{

    width:100%;

    border-collapse:collapse;

    background:
    rgba(255,255,255,0.03);

    border-radius:20px;

    overflow:hidden;

}



th{

    background:#ff9900;

    color:black;

    padding:18px;

    text-align:left;

}



td{

    padding:18px;

    border-bottom:
    1px solid rgba(255,255,255,0.06);

}



/* BADGE */

.badge{

    padding:8px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:bold;

}



.pending{

    background:#facc15;

    color:black;

}



.approved{

    background:#22c55e;

    color:white;

}



.rejected{

    background:#ef4444;

    color:white;

}



/* ACTIONS */

.table-actions{

    display:flex;

    gap:10px;

    flex-wrap:wrap;

}



.approve-btn{

    background:#22c55e;

    color:white;

    padding:10px 16px;

    border-radius:10px;

    text-decoration:none;

}



.reject-btn{

    background:#ef4444;

    color:white;

    padding:10px 16px;

    border-radius:10px;

    text-decoration:none;

}



/* MOBILE */

@media(max-width:768px){

    body{

        padding:20px;

    }

    .page-title{

        font-size:30px;

    }

}

</style>

</head>

<body>

<h1 class="page-title">

⚡ Registration Management

</h1>



<div class="top-bar">

<?php

if($settings['registration_status']
== 'open'){

?>

<a href="?close=1"
class="action-btn close-btn">

Close Registration

</a>

<?php

}else{

?>

<a href="?open=1"
class="action-btn open-btn">

Open Registration

</a>

<?php } ?>



<div class="status-box">

Registration Status:
<b>

<?php
echo strtoupper(
$settings['registration_status']
);
?>

</b>

</div>

</div>



<div class="table-container">

<table>

<tr>

<th>ID</th>
<th>Player</th>
<th>WhatsApp</th>
<th>Team</th>
<th>Status</th>
<th>Actions</th>

</tr>

<?php

while($row = mysqli_fetch_assoc(
$registrations
)){

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['player_name']; ?>
</td>

<td>
<?php echo $row['whatsapp']; ?>
</td>

<td>
<?php echo $row['favorite_team']; ?>
</td>

<td>

<span class="badge
<?php echo $row['status']; ?>">

<?php echo ucfirst(
$row['status']
); ?>

</span>

</td>

<td>

<div class="table-actions">

<?php

if($row['status']
== 'pending'){

?>

<a href="?approve=<?php
echo $row['id'];
?>"

class="approve-btn">

Approve

</a>



<a href="?reject=<?php
echo $row['id'];
?>"

class="reject-btn">

Reject

</a>

<?php } ?>

</div>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>