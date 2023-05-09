
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style>

/* Float four columns side by side */
.column {
  float: left;
  width: 20%;
  padding: 10px 10px;
  
  margin-left: 15px;

}

/* Remove extra left and right margins, due to padding */
.row {
margin: auto auto;
width: 90%;



}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: flex;
  clear: both;
  justify-content: center;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
  align-self: center;
  border: 2px black solid;
}
.button {
  display: inline-block;
  background-color: rgb(45,84,94, 0.9);
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

    </style>

    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>

<div class="view1">
  <p>Here we fetch all the calls and display them in a tabular manner.</p>
  <p>If you want to submit a call, click here.</p> 
  <a href="enter_call.php" class="button">Enter Call</a>

</div>

<div class="row">


<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "web-app-db");



$sql = "SELECT * FROM calls";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $title = $row['title'];
  $description = $row['description'];
  $author = $row['author'];
  $date = $row['data'];

  echo '<div class="column">';
  echo '<div class="card">';
    echo '<h2>' . $title . '</h2>';
    echo '<p>' . $description . '</p>';
    echo '<p>' . $author . '</p>';
    echo '</div>';
    echo '</div>';
}


// Close the database connection
mysqli_close($conn);
?>

</div>


                



<?php include 'frame_down.php'; ?>