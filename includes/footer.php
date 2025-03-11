<footer>
    <div class="container-fluid text-center">
        <div class="row bg-dark">
            <div class="col-12">
                <p class="text-white p-2">Mukha@<?= date("Y") ?></p>
            </div>
        </div>
    </div>
</footer>

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