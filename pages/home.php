<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
// user is logged in, get their information from the session
$userid = $_SESSION['userid'];
$fname = $_SESSION['fname']
// continue with the rest of your code
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
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.pickup {
  background-color: rgba(225,179,130,1);
  color: black;
}
.delete {
    background-color: red;
}
span {
  font-weight: bold;
  color: rgba(225,179,130,1); /* Change this color to whatever you prefer */
  margin-right: 10px;
}
.span {
      background: rgba(225,179,130,0.5);
    color: white;
    }

    .message {
        position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  z-index: 9999;
  text-align: center;
    }
    </style>

    <title>MyJUB</title>
</head>

<body>

    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
        <a href="./logout.php">Logout</a>

        </div>
    </div>
    <header>
        <nav id="nav" class="nav">

            <div id="logo_brand" class="brand">
                <a href="./index.html"><img style="width: 130px; height: 144px;" src="../assets/img/logo4.png" scale="0"
                        alt="logo"></a>
            </div>


            <ul class="navbar">

            <li>
                    <a href="./home.php">Home</a>
                </li>
                
                <li>
                    <a href="./call.php">Calls</a>
                </li>
                <li>
                    <a href="./myacademics.php">Academics</a>
                </li>
                <li>
                    <a href="./mytansport.php">Transportations</a>
                </li>
                <li>
                    <a href="./myweather.php">Weather</a>
                </li>
                <li>
                    <a href="./about.html">About</a>
                </li>
                
                <li class="hamburger">
                    <span class="openbtn" style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </li>
            </ul>
        </nav>



        <div class="wave">
            <svg id="first" viewBox="0 70 500 60" preserveAspectRatio="none">
                <rect x="0" y="0" width="500" height="500" style="stroke: none;" />
                <path d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z" style="stroke: none;"></path>
            </svg>
        </div>
    </header>
    <main>

    <div class="view1">
        
        <h1>Welcome,  <?php echo $fname; ?> !</h1>
        <div class="box">
    <h3>This is your dashboard.</h3>
    <p>Here, you will be able to have a look on the Calls you have picked up. In addition to the Calls that you have submitted along with the name of the user that picked up your call. </p>
    <p>From your picked up calls, you will be able to drop the call. Upon dropping, the call will automatically get removed from your list and you can find it again in the "Calls" catalogue <a href="./call.php">here</a>. </p>
    <p>From your submitted calls you can view the user who picked each of your calls. Additionally, you can delete a call. Upon deletion, a all is deleted from both your list and the Calls catalogue.</p>
    
        </div>
        
        <div class="box">
        <p>You can see the calls you <span>picked up</span>bellow. </p>
        </div>
    
    </div>

    <div class="row">
    <?php
$conn = mysqli_connect("localhost", "root", "", "web-app-db");

$userid = $_SESSION['userid'];
if (isset($_POST['drop'])) {
    $callid = $_POST['callid'];
  
    // Update the picked_up_by column in the calls table
    $sql = "UPDATE calls SET picked_up_by=NULL WHERE callid='$callid'";
    mysqli_query($conn, $sql);
    if(mysqli_query($conn, $sql)) {
      echo '<div class=" message">Record updated successfully</div>';
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }

$sql = "SELECT * FROM calls WHERE picked_up_by='$userid'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $title = $row['title'];
  $description = $row['description'];
  $author = $row['author'];
  $date = $row['data'];
  $callid = $row['callid'];

  $sql2 = "SELECT fname FROM users WHERE userid='$author'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $authorname = $row2['fname'];

  echo '<div class="column">';
  echo '<div class="card">';
  echo '<h2>' . $title . '</h2>';
  echo '<p> <span> Call description: </span>' . $description . '</p>';
  echo '<p> <span> Call made by user: </span> <span class="span">' . $authorname .  '</span></p>';
  echo '<p> <span> At:</span><span class="span">'. $date . '</span></p>';
  echo '<form method="post">';
    echo '<input type="hidden" name="callid" value="' . $callid . '">';
    echo '<button class="button pickup" type="submit" name="drop">Drop</button>';
    echo '</form>';
  echo '</div>';
  echo '</div>';
}
?>

    </div>

    <br>
    <div class="view1">
        <div class="box">
        <p>You can see the calls you <span>created</span>bellow. </p>
        </div>
    
    </div>

    <div class="row">
        <?php 
        $conn = mysqli_connect("localhost", "root", "", "web-app-db");

        // Get the user ID
        $userid = $_SESSION['userid'];
        if (isset($_POST['delete'])) {
            $callid = $_POST['callid'];
          
            // Delete the call from the calls table
            $sql = "DELETE FROM calls WHERE callid='$callid'";
            mysqli_query($conn, $sql);
            if(mysqli_query($conn, $sql)) {
              echo '<div class="message" id="message">Record deleted successfully</div>';
            } else {
              echo "Error deleting record: " . mysqli_error($conn);
            }
          }
        
        // Get the calls created by the user
        $sql = "SELECT * FROM calls WHERE author='$userid'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        
        // Loop through the calls and display them
        while ($row = mysqli_fetch_assoc($result)) {
          $title = $row['title'];
          $description = $row['description'];
          $author = $row['author'];
          $date = $row['data'];
          $callid = $row['callid'];
          $picked_up_by = $row['picked_up_by'];
        
          echo '<div class="column">';
          echo '<div class="card">';
          echo '<h2>' . $title . '</h2>';
          echo '<p> <span> Call description: </span>' . $description . '</p>';
          echo '<p> <span> Call made at: </span>' . $date . '</p>';

          // Display the drop button
  echo '<form method="post">';
  echo '<input type="hidden" name="callid" value="' . $callid . '">';
  echo '<button class="button delete" type="submit" name="delete">Delete</button>';
  echo '</form>';
        
          
        
          echo '</div>';
          echo '</div>';
        }
        
        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>

        

    </main>

    <div class="wave">
        <svg id="second" viewBox="0 70 500 60" preserveAspectRatio="none">
            <rect x="0" y="0" width="500" height="500" style="stroke: none;" />
            <path d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z" style="stroke: none;"></path>
        </svg>
    </div>
    
    <footer class="footer-distributed">

        <div class="footer-right">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

        <div class="footer-left">

            <p class="footer-links">
                <a class="link-1" href="#">Home</a>

                <a href="#">Blog</a>

                <a href="#">About</a>

                <a href="#">Faq</a>

                <a href="#">Contact</a>
            </p>

            <p>Made by Mahdi Ouchrahou &copy; 2023</p>
        </div>

    </footer>

    <script>
        // When the user scrolls down 20px from the top of the document, slide down the navbar
        window.onscroll = function () { scrollFunction() };

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementsByClassName("navbar").style.top = "0";
            } else {
                document.getElementsByClassName("navbar").style.top = "-50px";
            }
        }

        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }

    </script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script>
        $('.flip').click(function () {
            $this = $(this);
            if ($this.hasClass('active')) {

            } else {
                $('.flip').removeClass('active');
                $(this).addClass('active');
            }
        })
    </script>
    <script>
        function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("nav").style.padding = "0px 0px";
    
  } else {
    document.getElementById("nav").style.padding = "30px 0px";
    
  }
}
    </script>
    <script>
    const message = document.querySelector('.message');

// Hide the message after 3 seconds (3000 milliseconds)
setTimeout(() => {
  message.style.display = 'none';
}, 3000);
    </script>
</body>



</html>