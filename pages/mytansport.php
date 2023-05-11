<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
// user is logged in, get their information from the session
$user_id = $_SESSION['userid'];


// continue with the rest of your code
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">

    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>


<div class="view1">
    <h1>Transportations</h1>
    <div class="box">
    <h3>This functionality require us to do some web scrapping. Announcements must be pulled out from the official DB website and displayed to the user. Meanwhile we studied the DOM structure, this task require additional packages and therefore will not be covered in this submission. </h3>
    </div>
</div>


<?php include 'frame_down.php'; ?>