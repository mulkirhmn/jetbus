<!-- footer.php -->

<!-- Bootstrap dan Data Tables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Scripts -->
<script>
    const toggleSidebar = document.getElementById("tombolSidebar");
    const sidebar = document.getElementById("sidebar");

    toggleSidebar.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    });
</script>

<!-- data tables -->
<script>
    $(document).ready(function() {
        $('#tablePengguna').DataTable();
    });

    $(document).ready(function() {
        $('#tableBus').DataTable();
    });

    $(document).ready(function() {
        $('#tableRute').DataTable();
    });

    $(document).ready(function() {
        $('#tableJadwal').DataTable();
    });

    $(document).ready(function() {
        $('#tableTiket').DataTable();
    });

    $(document).ready(function() {
        $('#tableTransaksi').DataTable();
    });
</script>


</body>

</html>