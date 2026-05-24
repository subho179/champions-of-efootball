<?php

include __DIR__ . '/session.php';


// NOT LOGGED IN

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");

    exit();

}

?>