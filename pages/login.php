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
    </style>

    <title>MyJUB</title>
</head>

<body>

    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="./login.php">Log In</a>
            <a href="./register.php">Register</a>

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
                    <a href="./index.html">Home</a>
                </li>
                <li>
                    <a href="./about.html">About</a>
                </li>
                <li>
                    <a href="./myacademics.html">My Academics</a>
                </li>
                <li>
                    <a href="./myfacilities.html">My Facilities</a>
                </li>
                <li>
                    <a href="./call.html">Calls</a>
                </li>
                <li>
                    <a href="./contact.html">Contact</a>
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
            <h1>Log in</h1>
            
                Enter your email and password in order to log in. 
        

        

        <?php
        // Start session
        session_start();
        
        // Check if user has already logged in
        if (isset($_SESSION['userid'])) {
          header("Location: home.php");
          exit;
        }
        
        // Check if form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Get email and password from form
          $email = $_POST['email'];
          $password = $_POST['password'];
        
          // Connect to database
          $conn = mysqli_connect('localhost', 'root', '', 'web-app-db');
        
          // Check if user exists
          $query = "SELECT * FROM users WHERE email = '$email'";
          $result = mysqli_query($conn, $query);
          $user = mysqli_fetch_assoc($result);
        
          if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
              // Set session variables
              $_SESSION['userid'] = $user['userid'];
              $_SESSION['fname'] = $user['fname'];
        
              // Redirect to home page
              header("Location: home.php");
              exit;
            } else {
              // Invalid password
              $error = "Invalid  password";
            }
          } else {
            // User not found
            $error = "user not found";
          }
        }
        ?>
        
        <!-- Login form -->
        <form method="post">
            <div class="form-container">

          <label for="email">Email:</label>
          <input type="email" name="email" required>
        
          <label for="password">Password:</label>
          <input type="password" name="password" required>
        
          <button type="submit">Login</button>
        
          <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
          <?php endif; ?>
          </div>
        </form>
        </div>

    </main>

    <div class="wave">
        <svg id="second" viewBox="0 70 500 60" preserveAspectRatio="none">
            <rect x="0" y="0" width="500" height="500" style="stroke: none;" />
            <path d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z" style="stroke: none;"></path>
        </svg>
    </div>
    <!-- Footer Section -->
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
    const error = document.querySelector('.error');

// Hide the message after 3 seconds (3000 milliseconds)
setTimeout(() => {
  message.style.display = 'none';
}, 3000);
setTimeout(() => {
  error.style.display = 'none';
}, 3000);
    </script>
    
</body>



</html>