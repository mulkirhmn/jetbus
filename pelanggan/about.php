<?php
$page_title = "Tentang Kami";
include 'header.php';
?>

<style>
    .parallax {
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
    }

    .about-header {
        background: url('../assets/img/bgabout.jpg') no-repeat center/cover;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
    }

    .vision-mission {
        background-color: #f8f9fa;
        padding: 50px 0;
    }

    .about-section,
    .values {
        padding: 50px 0;
    }

    .about-section {
        background-color: #f8f9fa;
    }

    .about-section img,
    .values img {
        width: 100%;
        border-radius: 10px;
        object-fit: cover;
    }

    .values {
        background: #e9ecef;
    }

    .values i {
        font-size: 3rem;
        margin-bottom: 10px;
    }
</style>

<div class="coontent">
    <!-- About Header -->
    <div class="about-header parallax" data-aos="fade-down">
        <div class="container">
            <h1 class="fw-bold">Tentang Kami</h1>
            <p>Menjadikan perjalanan Anda lebih nyaman, aman, dan efisien.</p>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <h2>Siapa Kami?</h2>
                    <p>JetBus adalah penyedia layanan transportasi darat terkemuka di Indonesia yang menawarkan perjalanan nyaman, aman, dan terjangkau untuk semua penumpang.</p>
                    <p>Kami selalu meningkatkan kualitas armada dan memperhatikan kebutuhan pelanggan demi kepuasan dan keamanan selama perjalanan.</p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <img src="../assets/img/resepsionis.jpeg" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision and Mission -->
    <section class="vision-mission parallax">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <h3>Visi</h3>
                    <p>Menjadi perusahaan transportasi darat terdepan di Indonesia dengan mengutamakan kenyamanan, keamanan, dan inovasi.</p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan layanan transportasi berkualitas dan terpercaya.</li>
                        <li>Memastikan kenyamanan dan keamanan penumpang.</li>
                        <li>Meningkatkan efisiensi melalui inovasi teknologi.</li>
                        <li>Berkontribusi positif bagi masyarakat dan lingkungan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="values">
        <div class="container text-center">
            <h2 class="mb-4" data-aos="fade-up">Nilai-Nilai Utama Kami</h2>
            <div class="row">
                <div class="col-md-4" data-aos="zoom-in">
                    <i class="bi bi-people-fill text-primary"></i>
                    <h5>Pelayanan Pelanggan</h5>
                    <p>Kami mengutamakan kepuasan pelanggan dengan layanan terbaik.</p>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <i class="bi bi-shield-lock-fill text-success"></i>
                    <h5>Keamanan</h5>
                    <p>Keamanan penumpang adalah prioritas utama kami.</p>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                    <i class="bi bi-lightbulb-fill text-warning"></i>
                    <h5>Inovasi</h5>
                    <p>Kami terus berinovasi untuk pengalaman perjalanan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>