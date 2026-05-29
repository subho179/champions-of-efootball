<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

$id = intval($_GET['id']);

mysqli_query(

    $conn,

    "DELETE FROM roadmap
    WHERE id='$id'"

);

header("Location: roadmap.php");
exit;

?>