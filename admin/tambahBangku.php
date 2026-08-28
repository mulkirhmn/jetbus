<?php
$page_title = "Tambah Banyak Bangku";
include "header.php";
include "../koneksi.php";

$id_bus = $_GET['id_bus'];

if (isset($_POST['submit'])) {
    $nomor_bangku = $_POST['no_bangku'];


    foreach ($nomor_bangku as $no) {
        $query = "INSERT INTO bangku (id_bus, no_bangku) VALUES ('$id_bus', '$no')";
        mysqli_query($koneksi, $query);
    }

    echo "<script>alert('Bangku berhasil ditambahkan!'); window.location.href='bangkuBus.php?id=$id_bus';</script>";
}
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>
        <main class="content d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-sm" style="width: 450px;">
                <div class="card-header text-center">
                    <h5 class="mb-0">Tambah Banyak Bangku</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div id="bangkuWrapper">
                            <div class="mb-3 input-group">
                                <input type="text" name="no_bangku[]" class="form-control" placeholder="Nomor Bangku" required>
                                <button type="button" class="btn btn-success add-row">+</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="bangkuBus.php?id=<?= $id_bus; ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.querySelector('.add-row').addEventListener('click', function() {
        let wrapper = document.getElementById('bangkuWrapper');
        let newRow = document.createElement('div');
        newRow.classList.add('mb-3', 'input-group');
        newRow.innerHTML = `
            <input type="text" name="no_bangku[]" class="form-control" placeholder="Nomor Bangku" required>
            <button type="button" class="btn btn-danger remove-row">-</button>
        `;
        wrapper.appendChild(newRow);

        newRow.querySelector('.remove-row').addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>

<?php include "footer.php"; ?>