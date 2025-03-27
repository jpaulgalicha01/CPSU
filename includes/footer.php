<?php
if (isset($_SESSION['alert']) && $_SESSION['alert'] == "Show") {
?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "<?= $_SESSION['icon'] ?>",
            title: "<?= $_SESSION['title_alert'] ?>",
        });
    </script>
<?php
    unset($_SESSION['alert']);
    unset($_SESSION['icon']);
    unset($_SESSION['title_alert']);
}
?>


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