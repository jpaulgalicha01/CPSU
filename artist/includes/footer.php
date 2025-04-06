</div>

</div>

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

<script>
    let toggled = true;
    const toggledMenu = document.getElementById("wrapper");

    function handleToggled() {

        if (toggled) {
            toggledMenu.classList.add("toggled")
            toggled = false;
        } else {
            toggledMenu.classList.remove("toggled")
            toggled = true;
        }
    }
</script>

<!-- 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/ajax.js"></script>


</body>

</html>