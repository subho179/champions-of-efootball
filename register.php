<?php

include __DIR__ . '/assets/db.php';



$settings = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT * FROM website_settings LIMIT 1"
)

);

$message = "";



/* REGISTER */

if(isset($_POST['register'])){

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



    $whatsapp =
    mysqli_real_escape_string(
    $conn,
    $_POST['whatsapp']
    );



    $favorite_team =
    mysqli_real_escape_string(
    $conn,
    $_POST['favorite_team']
    );



    $rules_accepted = "yes";



    /* PROFILE PIC */

    $profile_pic = "";



    if(isset($_FILES['profile_pic'])){

        $filename =
        time() . "_" .
        $_FILES['profile_pic']['name'];



        $target =
        "assets/uploads/" .
        $filename;



        move_uploaded_file(

        $_FILES['profile_pic']['tmp_name'],

        $target

        );



        $profile_pic = $target;

    }



    mysqli_query($conn,

    "INSERT INTO registrations (

    player_name,
    team_name,
    whatsapp,
    favorite_team,
    profile_pic,
    rules_accepted

    )

    VALUES (

    '$player_name',
    '$team_name',
    '$whatsapp',
    '$favorite_team',
    '$profile_pic',
    '$rules_accepted'

    )"

    );



    $message =
    'Registration Submitted Successfully!';

}

?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Registration
</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}



body{

    background:
    radial-gradient(circle at top,
    #1a1a1a,
    #050505);

    color:white;

    min-height:100vh;

    overflow-x:hidden;

}



/* CONTAINER */

.register-container{

    width:100%;

    max-width:520px;

    margin:80px auto;

    padding:45px;

    background:
    rgba(18,18,18,0.85);

    border:
    1px solid rgba(255,153,0,0.12);

    border-radius:28px;

    backdrop-filter:blur(14px);

    position:relative;

    overflow:hidden;

}



/* GLOW */

.register-container::before{

    content:"";

    position:absolute;

    width:240px;

    height:240px;

    background:#ff9900;

    filter:blur(120px);

    opacity:0.08;

    top:-60px;

    right:-60px;

}



/* TITLE */

.register-title{

    text-align:center;

    margin-bottom:35px;

}

.register-title h1{

    font-size:42px;

    color:#ff9900;

    margin-bottom:12px;

}

.register-title p{

    color:#bdbdbd;

}



/* INPUT */

.input-box{

    margin-bottom:22px;

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

    border:
    1px solid rgba(255,153,0,0.08);

}



/* FILE INPUT */

.input-box input[type="file"]{

    padding:14px;

    color:#bdbdbd;

}



/* RULES */

.rules-box{

    margin-bottom:25px;

    color:#d1d1d1;

    font-size:15px;

}

.rules-box input{

    margin-right:10px;

    transform:scale(1.2);

}



/* BUTTON */

.register-btn{

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

.register-btn:hover{

    transform:translateY(-2px);

    box-shadow:
    0 0 25px rgba(255,153,0,0.5);

}



/* MESSAGE */

.message{

    text-align:center;

    margin-bottom:20px;

    color:#4dff88;

    font-weight:bold;

}



/* CLOSED */

.closed-box{

    text-align:center;

    padding:60px 20px;

}

.closed-box i{

    font-size:70px;

    color:#ff3333;

    margin-bottom:25px;

}

.closed-box h2{

    font-size:36px;

    margin-bottom:15px;

}

.closed-box p{

    color:#bdbdbd;

    line-height:1.7;

}



/* MOBILE */

@media(max-width:768px){

    .register-container{

        margin:40px 20px;

        padding:35px 25px;

    }

}

.rules-box a{

    color:#ff9900;

    text-decoration:none;

    font-weight:bold;

}



.rules-box a:hover{

    text-decoration:underline;

}

</style>

</head>

<body>

<?php include 'includes/public-navbar.php'; ?>



<div class="register-container">

<?php

if($settings['registration_status']
== 'closed'){

?>

<div class="closed-box">

    <i class="fas fa-lock"></i>

    <h2>
        Registrations Closed
    </h2>

    <p>

        Player registrations are currently closed.
        Please wait for the next season announcement.

    </p>

</div>

<?php

}else{

?>

<div class="register-title">

    <h1>
        Join COE
    </h1>

    <p>

        Register for the next
        Champions of eFootball season.

    </p>

</div>



<?php if($message != ""){ ?>

<div class="message">

<?php echo $message; ?>

</div>

<?php } ?>



<form method="POST"
enctype="multipart/form-data">



    <div class="input-box">

        <input type="text"
        name="player_name"
        placeholder="Player Name"
        required>

    </div>



    <div class="input-box">

        <input type="text"
        name="team_name"
        placeholder="Team Name"
        required>

    </div>



    <div class="input-box">

        <input type="file"
        name="profile_pic"
        accept="image/*"
        required>

    </div>



    <div class="input-box">

        <input type="text"
        name="whatsapp"
        placeholder="WhatsApp Number"
        required>

    </div>



    <div class="input-box">

        <input type="text"
        name="favorite_team"
        placeholder="Favorite International Team"
        required>

    </div>



   <div class="rules-box">

<label>

<input type="checkbox"
name="rules"
required>

I agree to the

<a href="rules.php"
target="_blank">

Rules & Regulations

</a>

</label>

</div>


    <button type="submit"
    name="register"
    class="register-btn">

    Register Now

    </button>

</form>

<?php } ?>

</div>

</body>
</html>