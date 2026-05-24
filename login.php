<?php
include __DIR__ . '/session.php';

include __DIR__ . '/assets/db.php';


$error = "";


// LOGIN

if(isset($_POST['login'])){

    $username = $_POST['username'];

    $password = MD5($_POST['password']);



    $query = mysqli_query($conn,

    "SELECT * FROM users

    WHERE username='$username'
    AND password='$password'"

    );



    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);



        $_SESSION['user_id'] = $user['id'];

        $_SESSION['username'] = $user['username'];

        $_SESSION['role'] = $user['role'];



        // REDIRECT

        if($user['role'] == 'admin'){

            header("Location: admin/index.php");

        }else{

            header("Location: index.php");

        }

    }

    else{

        $error = "Invalid username or password";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

<title>
COE Login
</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#0d0d0d;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

.login-box{
    background:#171717;
    padding:40px;
    width:400px;
    border-radius:20px;
    box-shadow:0 0 30px rgba(255,153,0,0.08);
}

.login-box h1{
    color:#ff9900;
    margin-bottom:30px;
    text-align:center;
}

input{
    width:100%;
    padding:15px;
    margin-bottom:18px;
    background:#222;
    border:1px solid #333;
    border-radius:10px;
    color:white;
}

input:focus{
    outline:none;
    border-color:#ff9900;
}

button{
    width:100%;
    padding:15px;
    background:#ff9900;
    color:black;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#ffb733;
}

.error{
    background:#ff3b3b;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
    text-align:center;
}

</style>

</head>

<body>

<div class="login-box">

<h1>
🏆 COE Login
</h1>


<?php

if($error != ""){

    echo "<div class='error'>$error</div>";

}

?>


<form method="POST">

<input type="text"
       name="username"
       placeholder="Username"
       required>


<input type="password"
       name="password"
       placeholder="Password"
       required>


<button type="submit"
        name="login">

Login

</button>

</form>

</div>

</body>
</html>