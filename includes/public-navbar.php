<div class="navbar">

    <!-- LOGO -->

    <div class="logo">

        <span class="logo-icon">🏆</span>

        <span class="logo-text">

            COE

        </span>

    </div>



    <!-- NAVIGATION -->

    <div class="nav-links">

        <a href="index.php">Home</a>

        <a href="standings.php">Standings</a>

        <a href="fixtures.php">Fixtures</a>

        <a href="results.php">Results</a>

        <a href="stats.php">Stats</a>

        <a href="playoffs.php">Playoffs</a>

    </div>



    <!-- LOGIN BUTTON -->

    <div>

        <a href="login.php"
           class="login-btn">

           Admin Login

        </a>

    </div>

</div>



<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#070707;
    color:white;
}



/* NAVBAR */

.navbar{

    width:100%;

    height:85px;

    padding:0 50px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    position:sticky;

    top:0;

    z-index:1000;

    background:rgba(10,10,10,0.85);

    backdrop-filter:blur(12px);

    border-bottom:1px solid rgba(255,153,0,0.15);

}



/* LOGO */

.logo{

    display:flex;

    align-items:center;

    gap:12px;

}

.logo-icon{

    font-size:34px;

    color:#ff9900;

    text-shadow:0 0 15px #ff9900;

}

.logo-text{

    font-size:30px;

    font-weight:bold;

    color:white;

    letter-spacing:2px;

}



/* NAV LINKS */

.nav-links{

    display:flex;

    gap:35px;

}

.nav-links a{

    text-decoration:none;

    color:#ddd;

    font-weight:bold;

    transition:0.3s;

    position:relative;

}



/* HOVER EFFECT */

.nav-links a:hover{

    color:#ff9900;

    text-shadow:0 0 10px #ff9900;

}



/* UNDERLINE ANIMATION */

.nav-links a::after{

    content:"";

    position:absolute;

    width:0;

    height:2px;

    background:#ff9900;

    left:0;

    bottom:-6px;

    transition:0.3s;

}

.nav-links a:hover::after{

    width:100%;

}



/* LOGIN BUTTON */

.login-btn{

    background:linear-gradient(
        135deg,
        #ff9900,
        #ff6600
    );

    color:black;

    padding:12px 22px;

    border-radius:12px;

    text-decoration:none;

    font-weight:bold;

    box-shadow:0 0 15px rgba(255,153,0,0.4);

    transition:0.3s;

}

.login-btn:hover{

    transform:translateY(-2px);

    box-shadow:0 0 25px rgba(255,153,0,0.8);

}



/* MOBILE */

@media(max-width:900px){

    .navbar{

        flex-direction:column;

        height:auto;

        padding:25px;

        gap:20px;

    }

    .nav-links{

        flex-wrap:wrap;

        justify-content:center;

        gap:20px;

    }

}

</style>