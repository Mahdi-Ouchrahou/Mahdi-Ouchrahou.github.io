<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style>
        .view1 {
        
            
        border: 2px black solid;

    }

    .form-container {
        

padding: 20px;
margin-top: 50px;

align-items: center;
justify-content: center;
min-height: 50px;

background-image: linear-gradient(
to bottom right,
#2d545e,
#e1b382


);
z-index: 7;

box-shadow: 8px 8px 8px 8px rgba(34, 60, 80, .16);

    }


    .form-container input[type=text], .form-container input[type=password] {
        border: 2px black solid;
        
        
margin: 5px 0 22px 0;
display: inline-block;
border: none;
background: #f1f1f1;
        
    }
    </style>
    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>


<div class="view1">
<?php
$conn = mysqli_connect("localhost", "root", "", "web-app-db");

if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $author = mysqli_real_escape_string($conn, $_SESSION['userid']);
    $date = date('Y-m-d H:i:s');

    // Validate user input
    $errors = array();

    if (empty($title)) {
        $errors[] = "Title is required";
    }

    if (empty($description)) {
        $errors[] = "Description is required";
    }

    if (!empty($errors)) {
        // Display errors
        echo '<div class="box">';
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo '</div>';
    } else {
        // Insert data into database
        $sql = "INSERT INTO calls (title, description, author, date) VALUES ('$title', '$description', '$author', '$date')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Data stored in a database successfully.</p>";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);

}



?>
<h1>Enter data to submit a new call.</h1>
<form method="post">
    <div class="form-container">
    <label for="title">Title:</label><br>
        <input type="text" name="title" required><br>
        <label for="description">Description:</label><br>
        <textarea name="description" required></textarea><br>
        <input type="submit" value="Submit">
    </div>
        
    </form>

</div>



<?php include 'frame_down.php'; ?>