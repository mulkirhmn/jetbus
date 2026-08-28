<?php
$page_title = "Armada";
include 'header.php';
?>
<style>
    .armada-header {
        background: url('assets/img/dalambus.jpg') no-repeat center center/cover;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
    }

    .armada-section {
        padding: 50px 0;
    }

    .armada-card img {
        height: 200px;
        object-fit: cover;
    }
</style>

<!-- Armada Header Section -->
<div class="armada-header" data-aos="fade-down">
    <div class="container">
        <h1 class="fw-bold">Armada Kami</h1>
        <p>Kenali armada kami yang modern dan nyaman.</p>
    </div>
</div>

<!-- Armada Section -->
<section class="armada-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card armada-card">
                    <img src="assets/img/armada-1.jpg" class="card-img-top" alt="Bus Eksekutif">
                    <div class="card-body">
                        <h5 class="card-title">Bus Eksekutif</h5>
                        <p class="card-text">Armada dengan fasilitas premium, cocok untuk perjalanan jarak jauh yang nyaman.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card armada-card">
                    <img src="assets/img/armada-2.jpg" class="card-img-top" alt="Bus Bisnis">
                    <div class="card-body">
                        <h5 class="card-title">Bus Bisnis</h5>
                        <p class="card-text">Pilihan tepat untuk perjalanan dengan harga terjangkau namun tetap nyaman.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card armada-card">
                    <img src="assets/img/armada-3.jpg" class="card-img-top" alt="Bus Reguler">
                    <div class="card-body">
                        <h5 class="card-title">Bus Reguler</h5>
                        <p class="card-text">Armada standar yang melayani perjalanan harian dengan rute tertentu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
    AOS.init({
        duration: 1000, // Durasi animasi (ms)
        once: true // Hanya animasi saat pertama kali scroll
    });
</script>