
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
<?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo '<div class="message">' . $message . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
h2 {
            color: black;
        }
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
  box-shadow: 0 4px 8px 0 rgb(45,84,94, 0.9);
  padding: 16px;
  text-align: center;
  background-color: rgb(45,84,94, 0.9);
  align-self: center;
  color: white;
  height: 200px; /* set a fixed height */
  overflow: scroll;
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
  box-shadow: 0 4px 8px 0 rgb(45,84,94, 0.9);
}
.pickup {
  background-color: rgba(225,179,130,1);
  color: black;
  display: inline-block;
  
  
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 8px 0 rgb(45,84,94, 0.9);
}
span {
  font-weight: bold;
  color: rgba(225,179,130,1); /* Change this color to whatever you prefer */
  margin-right: 10px;
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

    .span {
      background: rgba(225,179,130,0.5);
    color: white;
    }

    </style>

    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>

<div class="view1">
 
  <h1>Calls</h1>
  
  <div class="box">
  <p>Here we fetch all the calls and display them in a tabular manner.</p>
  <p>In each call you find the <span>Title</span>, the <span>Description</span>, the name of the <span>Author</span> and if applicable, the name of the <span>user who picked up</span> the call.</p>
  </div>
  <div class="box">
  <p>If you want to submit a call, click here.</p> 
  <a href="enter_call.php" class="button">Enter Call</a>

  </div>
  
</div>

<div class="row">


<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "web-app-db");

if (isset($_POST['pickup'])) {
  $callid = $_POST['callid'];
  $userid = $_SESSION['userid'];

  // Update the picked_up_by column in the calls table
  $sql = "UPDATE calls SET picked_up_by='$userid' WHERE callid='$callid'";
  mysqli_query($conn, $sql);
  if(mysqli_query($conn, $sql)) {
    echo '<div class="message" id="message">You Picked up the call successfully.</div>';
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

$sql = "SELECT c.*, u.fname AS author_name, p.fname AS picked_up_by_name
        FROM calls c 
        LEFT JOIN users u ON c.author = u.userid
        LEFT JOIN users p ON c.picked_up_by = p.userid";
$result = mysqli_query($conn, $sql);
if (!$result) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
while ($row = mysqli_fetch_assoc($result)) {
  $title = $row['title'];
  $description = $row['description'];
  $author = $row['author_name'];
  $date = $row['data'];
  $callid = $row['callid'];
  $picked_up_by = $row['picked_up_by'];
  

  echo '<div class="column">';
  echo '<div class="card">';
  echo '<h2>' . $title . '</h2>';
  echo '<p> <span> Call description: </span>' . $description . '</p>';
  echo '<p> <span> Call made by user: </span> <span class="span">' . $author .  '</span></p>';
  echo '<p> <span> At:</span><span class="span">'. $date . '</span></p>';

    if ($picked_up_by == NULL) {
      // Display the pick up button
      echo '<form method="post">';
      echo '<input type="hidden" name="callid" value="' . $callid . '">';
      echo '<button class="pickup" type="submit" name="pickup">Pick up</button>';
      echo '</form>';
  } else {
      // Display the user who picked up the call
      echo '<button class"pickup"  >Picked up by: <span>' . $row['picked_up_by_name'] . '</span></button>';
       
  }

  echo '</div>';
  echo '</div>';
}


// Close the database connection
mysqli_close($conn);
?>

</div>


                



<?php include 'frame_down.php'; ?>