<?php
if(session_status() == PHP_SESSION_NONE){

   include __DIR__ . '/../session.php';

}
?>

<div class="topbar">

    <div class="topbar-left">

        <h2>
            🏆 Champions of eFootball
        </h2>

    </div>


    <div class="topbar-right">

        <div class="user-box">

            <span class="username">

                👤

                <?php

                if(isset($_SESSION['username'])){

                    echo $_SESSION['username'];

                }else{

                    echo "Guest";

                }

                ?>

            </span>


            <a href="../logout.php"
               class="logout-btn">

               Logout

            </a>

        </div>

    </div>

</div>



<style>

.topbar{
    height:80px;
    background:#171717;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    border-bottom:1px solid #222;
}

.topbar-left h2{
    color:#ff9900;
}

.user-box{
    display:flex;
    align-items:center;
    gap:15px;
}

.username{
    color:white;
    font-weight:bold;
}

.logout-btn{
    background:#ff9900;
    color:black;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.logout-btn:hover{
    background:#ffb733;
}

</style>