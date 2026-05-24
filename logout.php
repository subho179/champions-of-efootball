<?php

include __DIR__ . '/session.php';

session_destroy();

header("Location: login.php");

?>