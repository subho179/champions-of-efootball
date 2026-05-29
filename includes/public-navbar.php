<head>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Exo+2:wght@400;500;600;700&display=swap"
rel="stylesheet">

</head>

<div class="navbar">

    <!-- LOGO -->

    <div class="logo">

        <span class="logo-icon">
            🏆
        </span>

        <span class="logo-text">

            COE

        </span>

    </div>



    <!-- DESKTOP NAV -->

    <div class="nav-links">

        <a href="index.php">HOME</a>

        <a href="standings.php">STANDINGS</a>

        <a href="fixtures.php">FIXTURES</a>

        <a href="results.php">RESULTS</a>

        <a href="stats.php">STATS</a>

        <a href="playoffs.php">PLAYOFFS</a>

    </div>



    <!-- DESKTOP LOGIN -->

    <div class="desktop-login">

        <a href="login.php"
           class="login-btn">

           Admin Login

        </a>

    </div>



    <!-- MOBILE TOGGLE -->

    <div class="menu-toggle"
         onclick="toggleMenu()">

         ☰

    </div>

</div>



<!-- OVERLAY -->

<div class="menu-overlay"
     id="menuOverlay"
     onclick="toggleMenu()">

</div>



<!-- MOBILE MENU -->

<div class="mobile-menu"
     id="mobileMenu">

    <a href="index.php">HOME</a>

    <a href="standings.php">STANDINGS</a>

    <a href="fixtures.php">FIXTURES</a>

    <a href="results.php">RESULTS</a>

    <a href="stats.php">STATS</a>

    <a href="playoffs.php">PLAYOFFS</a>

    <a href="login.php"
       class="mobile-login">

        Admin Login

    </a>

</div>



<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Exo 2',sans-serif;
}

body{

    font-family:'Exo 2',sans-serif;

}



/* TITLES */

h1,h2,h3,h4,h5,h6,
.logo,
.hero-title,
.section-title{

    font-family:'Orbitron',sans-serif;

}

/* NAVBAR */

.navbar{

    width:100%;
    
    max-width:100vw;

    height:85px;

    padding:0 50px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    position:sticky;

    top:0;

    z-index:1000;

    background:
    rgba(10,10,10,0.88);

    backdrop-filter:blur(14px);

    border-bottom:
    1px solid rgba(255,153,0,0.12);

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

    text-shadow:
    0 0 15px #ff9900;

}

.logo-text{

    font-size:30px;

    font-weight:bold;

    color:white;

    letter-spacing:2px;

}



/* DESKTOP LINKS */

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



/* HOVER */

.nav-links a:hover{

    color:#ff9900;

    text-shadow:
    0 0 10px #ff9900;

}



/* UNDERLINE */

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

    background:
    linear-gradient(
        135deg,
        #ff9900,
        #ff6600
    );

    color:black;

    padding:12px 22px;

    border-radius:12px;

    text-decoration:none;

    font-weight:bold;

    box-shadow:
    0 0 15px rgba(255,153,0,0.4);

    transition:0.3s;

}

.login-btn:hover{

    transform:translateY(-2px);

    box-shadow:
    0 0 25px rgba(255,153,0,0.8);

}



/* MOBILE TOGGLE */

.menu-toggle{

    display:none;

    font-size:34px;

    color:#ff9900;

    cursor:pointer;

}



/* OVERLAY */

.menu-overlay{

    position:fixed;

    top:0;

    left:0;

    width:100%;

    height:100vh;

    background:
    rgba(0,0,0,0.55);

    backdrop-filter:blur(4px);

    opacity:0;

    visibility:hidden;

    transition:0.3s;

    z-index:1500;

}



/* ACTIVE OVERLAY */

.menu-overlay.active{

    opacity:1;

    visibility:visible;

}



/* MOBILE MENU */

.mobile-menu{

    position:fixed;

    top:0;

    right:-100%;

    width:320px;

    max-width:85%;

    height:100vh;
    
    overflow-y:auto;

    background:
    rgba(8,8,8,0.98);

    backdrop-filter:blur(18px);

    display:flex;

    flex-direction:column;

    padding:120px 25px 40px;

    gap:18px;

    transition:0.35s ease;

    z-index:2000;

    border-left:
    1px solid rgba(255,153,0,0.18);

    box-shadow:
    -10px 0 40px rgba(0,0,0,0.6);

}



/* ACTIVE */

.mobile-menu.active{

    right:0;

}



/* LINKS */

.mobile-menu a{

    width:100%;

    padding:18px 20px;

    border-radius:16px;

    background:
    rgba(255,255,255,0.03);

    color:white;

    text-decoration:none;

    font-size:20px;

    font-weight:bold;

    transition:0.3s;

    border:
    1px solid rgba(255,153,0,0.05);

}



/* HOVER */

.mobile-menu a:hover{

    background:
    rgba(255,153,0,0.1);

    color:#ff9900;

    transform:translateX(6px);

}



/* MOBILE LOGIN */

.mobile-login{

    margin-top:10px;

    background:
    linear-gradient(
        135deg,
        #ff9900,
        #ff6600
    ) !important;

    color:black !important;

    text-align:center;

    box-shadow:
    0 0 20px rgba(255,153,0,0.4);

}



/* MOBILE */

@media(max-width:900px){

    .nav-links{

        display:none;

    }

    .desktop-login{

        display:none;

    }

    .menu-toggle{

        display:block;

    }

    .navbar{

        padding:0 25px;

    }

}



/* DESKTOP */

@media(min-width:901px){

    .mobile-menu{

        display:none;

    }

    .menu-overlay{

        display:none;

    }

}

</style>



<script>

function toggleMenu(){

    document
    .getElementById("mobileMenu")
    .classList
    .toggle("active");


    document
    .getElementById("menuOverlay")
    .classList
    .toggle("active");

}

</script>