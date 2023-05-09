  

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