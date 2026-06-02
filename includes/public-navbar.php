
<head>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Exo+2:wght@400;500;600;700&display=swap"
rel="stylesheet">

<style>

/* ====================================
   COE NAVBAR V2 - SEASON 1
==================================== */




*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

.navbar{

    position:sticky;
    top:0;
    z-index:9999;

    height:90px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 40px;

    background:rgba(8,8,8,.88);

    backdrop-filter:blur(18px);

    border-bottom:1px solid rgba(255,153,0,.12);

    overflow:visible;

}

/* ENERGY BEAM */

.navbar::before{

    content:"";

    position:absolute;

    top:0;
    left:-100%;

    width:200%;
    height:2px;

    background:
    linear-gradient(
        90deg,
        transparent,
        #ff9900,
        transparent
    );

    animation:navBeam 6s linear infinite;

}

@keyframes navBeam{

    100%{
        left:100%;
    }

}

/* LOGO */

.logo-section{

    display:flex;
    align-items:center;

}

.logo-icon{

    width:50px;
    height:50px;

    display:flex;
    align-items:center;
    justify-content:center;

}

.logo-icon img{

    width:100%;
    height:100%;

    object-fit:contain;

    filter:
        drop-shadow(0 0 8px rgba(255,153,0,.5))
        drop-shadow(0 0 20px rgba(255,153,0,.3));

    transition:.22s ease;

}

.logo-icon img:hover{

    transform:scale(1.08);

    filter:
        drop-shadow(0 0 15px rgba(255,153,0,.8))
        drop-shadow(0 0 35px rgba(255,153,0,.5));

}


.logo-info{

    display:flex;
    flex-direction:column;

}

.logo-text{

    font-family:'Orbitron',sans-serif;

    font-size:28px;

    font-weight:800;

    color:white;

    line-height:1;

}

.logo-subtitle{

    font-size:11px;

    color:#888;

    letter-spacing:1px;

    text-transform:uppercase;

}

/* CENTER NAV */

.nav-center{

    display:flex;
    align-items:center;
    gap:35px;

}

.nav-center a,
.dropdown-btn{

    position:relative;

    background:none;
    border:none;

    color:white;

    text-decoration:none;

    font-weight:700;

    font-size:15px;

    cursor:pointer;

    transition:.3s;

}

.nav-center a:hover,
.dropdown-btn:hover{

    color:#ff9900;

}

.nav-center a::after,
.dropdown-btn::after{

    content:"";

    position:absolute;

    left:0;
    bottom:-10px;

    width:0;
    height:2px;

    background:#ff9900;

    transition:.3s;

}

.nav-center a:hover::after,
.dropdown-btn:hover::after{

    width:100%;

}

/* DROPDOWN */

.dropdown{
    position:relative;
    display:flex;
    align-items:center;
}

.dropdown-menu{

    position:absolute;

    top:55px;
    left:0;

    min-width:220px;

    background:rgba(12,12,12,.98);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,153,0,.15);

    border-radius:18px;

    opacity:0;
    visibility:hidden;

    transform:translateY(15px);

    transition:.35s;

    overflow:hidden;

    z-index:99999;

    box-shadow:
    0 10px 40px rgba(0,0,0,.5);

}

.dropdown:hover .dropdown-menu{

    opacity:1;
    visibility:visible;

    transform:translateY(0);

}

.dropdown-menu a{

    display:block;

    padding:16px 20px;

    color:white;

    text-decoration:none;

    transition:.25s;

}

.dropdown-menu a:hover{

    background:
    rgba(255,153,0,.08);

    color:#ff9900;

    padding-left:28px;

}

/* RIGHT */

.nav-right{

    display:flex;
    align-items:center;
    gap:15px;

}

/* LIVE BADGE */

.season-live{

    position:relative;

    overflow:hidden;

    padding:10px 18px;

    border-radius:999px;

    background:
    rgba(255,153,0,.08);

    border:
    1px solid rgba(255,153,0,.15);

    color:#ff9900;

    font-size:13px;

    font-weight:700;

    animation:livePulse 2.5s infinite;

}

.season-live::before{

    content:"";

    position:absolute;

    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:
    linear-gradient(
    90deg,
    transparent,
    rgba(255,255,255,.15),
    transparent
    );

    animation:liveShine 4s infinite;

}

@keyframes liveShine{

    100%{
        left:100%;
    }

}

@keyframes livePulse{

    0%,100%{

        box-shadow:
        0 0 10px rgba(255,153,0,.2);

    }

    50%{

        box-shadow:
        0 0 25px rgba(255,153,0,.45);

    }

}

/* ADMIN BUTTON */

.admin-btn{

    text-decoration:none;

    padding:12px 22px;

    border-radius:14px;

    color:black;

    font-weight:700;

    background:
    linear-gradient(
    135deg,
    #ff9900,
    #ff6600);

    transition:.35s;

    box-shadow:
    0 0 15px rgba(255,153,0,.25);

}

.admin-btn:hover{

    transform:translateY(-3px);

    box-shadow:
    0 0 30px rgba(255,153,0,.55);

}

/* HAMBURGER */

.menu-toggle{

    display:none;

    width:50px;
    height:50px;

    cursor:pointer;

    justify-content:center;
    align-items:center;
    flex-direction:column;

    gap:6px;

}

.menu-toggle span{

    width:28px;
    height:3px;

    background:#ff9900;

    border-radius:20px;

    transition:.35s;

}

.menu-toggle.active span:nth-child(1){
    transform:translateY(9px) rotate(45deg);
}

.menu-toggle.active span:nth-child(2){
    opacity:0;
}

.menu-toggle.active span:nth-child(3){
    transform:translateY(-9px) rotate(-45deg);
}

/* OVERLAY */

.menu-overlay{

    position:fixed;

    inset:0;

    background:
    rgba(0,0,0,.7);

    backdrop-filter:blur(8px);

    opacity:0;
    visibility:hidden;

    transition:.35s;

    z-index:9500;

}

.menu-overlay.active{

    opacity:1;
    visibility:visible;

}

/* MOBILE MENU */

.mobile-menu{

    position:fixed;

    top:0;
    right:-110%;

    width:100%;

    max-width:420px;

    height:100vh;

    min-height:100vh;

    padding-bottom:120px;

    background:
    linear-gradient(
        180deg,
        #0a0a0a,
        #050505
    );

    padding:90px 20px 120px;

    -webkit-overflow-scrolling:touch;

    overflow-y:auto;

    transition:.4s ease;

    z-index:99999;

    display:flex;
    flex-direction:column;

    gap:14px;

    box-shadow:
    -20px 0 50px rgba(0,0,0,.7);
}

.mobile-menu.active{
    right:0;
}

.mobile-header{

    font-family:'Orbitron',sans-serif;

    font-size:28px;

    color:#ff9900;

    text-align:center;

    margin-bottom:20px;

}

.mobile-menu a{

    display:flex;

    align-items:center;

    width:100%;

    min-height:60px;

    padding:18px 20px;

    border-radius:18px;

    text-decoration:none;

    color:white;

    font-weight:700;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid rgba(255,255,255,.04);

}

.mobile-menu a:hover{

    color:#ff9900;

    transform:translateX(6px);

}

.mobile-header{

    font-size:32px;

    font-weight:800;

    color:#ff9900;

    margin-bottom:15px;

    text-align:center;

}

.mobile-menu details{

    background:
    rgba(255,255,255,.03);

    border:1px solid rgba(255,255,255,.04);

    border-radius:18px;

    overflow:hidden;

}

.mobile-menu summary{

    min-height:60px;

    display:flex;

    align-items:center;

    padding:18px 20px;

    cursor:pointer;

    color:white;

    font-weight:700;

}

.mobile-menu details a{

    margin:8px;

}




.mobile-login{

    display:flex !important;

    justify-content:center;

    align-items:center;

    width:100%;

    min-height:60px;

    background:
    linear-gradient(
        135deg,
        #ff9900,
        #ff6600
    ) !important;

    color:black !important;

    font-weight:800;

}

html,
body{
    overflow-x:hidden;
}

.mobile-menu a,
.mobile-menu details{

    opacity:0;
    transform:translateX(30px);

}

.mobile-menu.active a,
.mobile-menu.active details{

    opacity:1;
    transform:none;

    transition:.35s;
}

.mobile-menu.active a:nth-child(2){transition-delay:.05s;}
.mobile-menu.active a:nth-child(3){transition-delay:.10s;}
.mobile-menu.active a:nth-child(4){transition-delay:.15s;}
.mobile-menu.active a:nth-child(5){transition-delay:.20s;}
.mobile-menu.active a:nth-child(6){transition-delay:.25s;}
.mobile-menu.active .mobile-login{transition-delay:.30s;}




.mobile-season{

    margin-top:10px;

    color:#ff9900;

    font-size:13px;

    opacity:.8;

}

/* MOBILE */

@media(max-width:1024px){

    .nav-center{
        display:none;
    }

    .season-live{
        display:none;
    }

    .menu-toggle{
        display:flex;
    }

    .logo-subtitle{
        display:none;
    }

    .navbar{
        padding:0 20px;
        height:80px;
    }

    .logo-text{
        font-size:22px;
    }

}

/* SMALL MOBILE */

@media(max-width:600px){

    .admin-btn{
        display:none;
    }

    .mobile-menu{
        width:100%;
    }

}


@media (max-height:700px){

    .mobile-menu{
        padding:70px 16px 80px;
        gap:8px;
    }

    .mobile-header{
        font-size:24px;
        margin-bottom:8px;
    }

    .mobile-season{
        font-size:11px;
        margin-top:4px;
    }

    .mobile-menu a,
    .mobile-menu summary{
        min-height:48px;
        padding:12px 16px;
        font-size:14px;
    }

    .mobile-menu details a{
        margin:4px;
    }
}


#page-transition{

    position:fixed;

    inset:0;

    background:#050505;

    z-index:999999;

    opacity:0;

    pointer-events:none;

    transition:opacity .25s ease;

}

#page-transition.active{

    opacity:1;

}



    to{opacity:1;}
}

</style>

</head>

<div class="navbar">

    <div class="logo-section">

        <div class="logo-icon">
    <img src="assets/images/coe-hub.png" alt="COE Logo">
</div>

        <div class="logo-info">

            <div class="logo-text">
                COE
            </div>

            <div class="logo-subtitle">
                Champions of eFootball
            </div>

        </div>

    </div>

    <div class="nav-center">

        <a href="index.php">HOME</a>

        <div class="dropdown">

            <button class="dropdown-btn">

                TOURNAMENT

                <span>▼</span>

            </button>

            <div class="dropdown-menu">

                <a href="standings.php">
                    Standings
                </a>

                <a href="fixtures.php">
                    Fixtures
                </a>

                <a href="results.php">
                    Results
                </a>

            </div>

        </div>

        <a href="stats.php">
            STATS
        </a>

        <a href="playoffs.php">
            PLAYOFFS
        </a>

    </div>

    <div class="nav-right">

        <div class="season-live">

            ⚡ SEASON 1 LIVE

        </div>

        <a href="login.php"
           class="admin-btn">

            ADMIN

        </a>

        <div class="menu-toggle"
             onclick="toggleMenu()">

            <span></span>
            <span></span>
            <span></span>

        </div>

    </div>

</div>

<div class="menu-overlay"
     id="menuOverlay"
     onclick="toggleMenu()">
</div>

<div class="mobile-menu"
     id="mobileMenu">

<div class="mobile-header">

    🏆 COE

    <div class="mobile-season">
        ⚡ SEASON 1 LIVE
    </div>

</div>

    <a href="index.php">HOME</a>

    

<a href="standings.php">STANDINGS</a>

<a href="fixtures.php">FIXTURES</a>

<a href="results.php">RESULTS</a>

<a href="stats.php">
        STATS
    </a>

    <a href="playoffs.php">
        PLAYOFFS
    </a>

    <a href="login.php"
       class="mobile-login">

        ADMIN LOGIN

    </a>

</div>

<div id="page-transition"></div>

<body>

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

    document
    .querySelector(".menu-toggle")
    .classList
    .toggle("active");

}

document.addEventListener('DOMContentLoaded',()=>{

const transition =
document.getElementById('page-transition');

document
.querySelectorAll('a')
.forEach(link=>{

const href = link.getAttribute('href');

if(
href &&
!href.startsWith('#') &&
!href.startsWith('javascript:')
){

link.addEventListener('click',e=>{

if(link.target === '_blank') return;

e.preventDefault();

transition.classList.add('active');

setTimeout(()=>{
window.location.href = href;
},100);

});

}

});

window.addEventListener('pageshow',()=>{

transition.classList.remove('active');

});

});
</script>
</body>

