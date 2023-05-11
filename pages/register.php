

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">


    <title>MyJUB</title>

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
span a {
  color: rgb(45,84,94, 0.9); /* set the color to blue */
  text-decoration: none; /* add an underline */
  font-weight: bold; /* make the text bold */
  margin-left: 5px; /* add a margin to separate the link from the previous text */
}
    </style>
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
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$conn = mysqli_connect("localhost", "root", "", "web-app-db");

if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    
    // Validate user input
    $errors = array();

    if (empty($fname)) {
        $errors[] = "First name is required";
    }

    if (empty($lname)) {
        $errors[] = "Last name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        // Check if email is already in use
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email is already in use";
        }
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($college)) {
        $errors[] = "College is required";
    }

    if (empty($block)) {
        $errors[] = "Block is required";
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
        $sql = "INSERT INTO users (fname, lname, email, password, college, block) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$college', '$block')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "Data stored in a database successfully. You are registered! Try to Log In!";
        header("Location: login.php?message=$message");
        exit();
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
        exit();

        
    }
}

mysqli_close($conn);
}



?>
        
        <form method="post">
            <div class="form-container">
                        <label for="fname"> First name </label> <br>
                        <input type="text" id="fname" name="fname"> <br>
                        <label for="lname">Last name</label> <br>
                        <input type="text" id="lname" name="lname"> <br>
                        <label for="email">Email address</label> <br>
                        <input type="email" name="email" id="email"> <br>
                        
                        <label for="password">Password</label> <br>
                        <input type="password" name="password" id="password"><br>
        
                        
                        <label for="college">Choose your college:</label> <br>
<select name="college" id="college">
  <option value="Krupp">Krupp College</option>
  <option value="C3">C3 College </option>
  <option value="Mercator">Mercator College </option>
  <option value="Nord">Nord College </option>
</select> <br><br>
    
                        <label for="block"> Enter your block </label> <br>
                        <select name="block" id="block">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        </select> <br> <br>
                        
    
                        
        
                        
                        <input type="submit" value="Register" name="submit" class="button">
                        <input type="reset" class="button"> <br>
                        <p>Already a user, try to <span><a href="./login.php">Log in</a></span> .</p>
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

    