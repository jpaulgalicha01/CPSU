</main>

<script>
    const navbar = document.getElementById('sticky');
    function handleScroll() {
    const offset = window.scrollY;
    if (offset > 150) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
    }

    window.addEventListener('scroll', handleScroll);
</script>


<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/ajaxQuery.js"></script>
    </body>
</html>
