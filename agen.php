<?php
$page_title = "Agen";
include 'header.php';
?>
<style>
    /* Parallax Effect */
    .parallax {
        background-attachment: fixed;
        background-size: cover;
        background-position: center center;
    }

    /* Agen Header Section with Parallax */
    .agen-header {
        background: url('assets/img/bgagen.jpg') no-repeat center center/cover;
        background-attachment: fixed;
        /* Parallax Effect */
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
    }

    /* Other Styles */
    .agen-section {
        padding: 50px 0;
    }

    .agen-card {
        background-color: #f8f9fa;
        border: none;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
</style>


<!-- Agen Header Section -->
<div class="agen-header parallax" data-aos="fade-down">
    <div class="container">
        <h1 class="fw-bold">Agen Kami</h1>
        <p>Temukan agen terdekat untuk kemudahan pemesanan.</p>
    </div>
</div>

<!-- Agen Section -->
<section class="agen-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4" data-aos="fade-up">
                <div class="agen-card">
                    <h5>Agen Jakarta</h5>
                    <p>Alamat: Jl. Merdeka No. 1, Jakarta Pusat</p>
                    <p>Telepon: +62 811-123-456</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="agen-card">
                    <h5>Agen Surabaya</h5>
                    <p>Alamat: Jl. Raya Surabaya No. 99, Surabaya</p>
                    <p>Telepon: +62 812-234-567</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="agen-card">
                    <h5>Agen Bandung</h5>
                    <p>Alamat: Jl. Soekarno-Hatta No. 88, Bandung</p>
                    <p>Telepon: +62 813-345-678</p>
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