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
    .error {
        position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: red;
  color: white;
  padding: 10px;
  z-index: 9999;
  text-align: center;
    }
    .message {
        position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: green;
  color: white;
  padding: 10px;
  z-index: 9999;
  text-align: center;
    }
    .button {
    background-color: rgba(225,179,130,1);
    color: black;
    display: inline-block;
    padding: 10px;
    margin-left: 10px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin: 4px;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgb(45,84,94, 0.9);
  }
  input, textarea {
      padding: 1rem;
      border-radius: 25px;
      border: none;
      background-color: #fff;
      font-family: inherit;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      min-width: 300px;
      font-size: 1rem;
  }
  input:focus {
      outline: none;
  }
  #form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 1rem;
    padding: 10px;
  }
    </style>
    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>


<div class="view1">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = mysqli_connect("localhost", "root", "", "web-app-db");
    
    if (!$conn) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = date('Y-m-d H:i:s');
    $author = $_SESSION['userid'];
    

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
        echo '<div class="error">';
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo '</div>';
    } else {
        // Insert data into database
        $sql = "INSERT INTO calls (title, description, author, data) VALUES ('$title', '$description', $author, '$date')";

        if (mysqli_query($conn, $sql)) {
            $message = "Data stored in a database successfully. You will find you submitted call bellow.";
            header("Location: call.php?message=$message");
            exit();
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
    }
}
    mysqli_close($conn);

}




?>
<h1>Enter data to submit a new call.</h1>
<form method="post" id="form">
    <div class="form-container">
    <label for="title">Title:</label><br>
        <input type="text" name="title" ><br>
        <label for="description">Description:</label><br>
        <textarea name="description" ></textarea><br><br>
        <input type="submit" value="Submit" name="submit" class="button">
    </div>
        
    </form>

</div>


<?php include 'frame_down.php'; ?>