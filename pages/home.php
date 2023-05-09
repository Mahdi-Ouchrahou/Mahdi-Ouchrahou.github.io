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


    <title>MyJUB</title>
</head>

<body>

    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="">Log Out</a>

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
    <h1>Welcome, User <?php echo $user_id; ?></h1>
    <p>This is your dashboard.</p>

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
</body>



</html>