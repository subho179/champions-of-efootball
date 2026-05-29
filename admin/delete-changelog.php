<?php

include '../auth.php';
include __DIR__ . '/../assets/db.php';

$id = intval($_GET['id']);

mysqli_query(
    $conn,
    "DELETE FROM changelog WHERE id='$id'"
);

header("Location: changelog.php");
exit;
?>