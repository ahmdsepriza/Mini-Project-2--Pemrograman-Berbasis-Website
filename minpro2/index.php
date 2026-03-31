<?php
include __DIR__ . '/koneksi.php';

// Ambil data dari database
$profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile LIMIT 1"));
$about = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about LIMIT 1"));
$experience = mysqli_query($conn, "SELECT * FROM experience");
$skills = mysqli_query($conn, "SELECT * FROM skills");
$certificates = mysqli_query($conn, "SELECT * FROM certificates");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $profile['name'] ?? 'Portfolio'; ?> | Portfolio</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#home">
      <?= $profile['name'] ?? 'Ahmad Sepriza'; ?>
    </a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="home" class="hero-section d-flex align-items-center" style="margin-top:100px;">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-6">
        <div class="badge bg-success mb-3">
          👋 Hi, I'm <?= $profile['name'] ?? ''; ?>
        </div>

        <h1 class="fw-bold">
          <?= $profile['description'] ?? 'UI/UX Designer Based in Indonesia'; ?>
        </h1>

        <p class="mt-3 text-muted">
          I create intuitive and engaging digital experiences that combine aesthetics and usability.
        </p>

        <div class="mt-4">
          <button class="btn btn-success me-3">Get In Touch →</button>
          <button class="btn btn-outline-dark">Download CV ↓</button> 
        </div>
      </div>

      <div class="col-lg-6 text-center mt-5 mt-lg-0">
        <img src="assets/img/<?= $profile['image'] ?? 'pp.png'; ?>" 
     class="img-fluid" 
     style="width:600px;">
      </div>

    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="py-5">
  <div class="container">
    <h2 class="text-center">About Me</h2>

    <div class="row mt-5">

      <div class="col-lg-6">
        <p><?= $about['description'] ?? 'Saya adalah mahasiswa Universitas Mulawarman yang memiliki minat pada Design UI/UX'; ?></p>

        <h5 class="mt-4">Experience</h5>
        <ul>
          <?php if(mysqli_num_rows($experience) > 0): ?>
            <?php while($exp = mysqli_fetch_assoc($experience)) : ?>
              <li><?= $exp['title']; ?></li>
            <?php endwhile; ?>
          <?php else: ?>
            <li>Intern Unmul Store 2026</li>
            <li>Organazion Inforsa 2026</li>
            <li>Staff Prabowo 2026</li>
            <li>Ketua Furab Fansbase 2026</li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="col-lg-6">
  <h5>Skills</h5>

  <?php if(mysqli_num_rows($skills) > 0): ?>
    <?php while($skill = mysqli_fetch_assoc($skills)) : ?>
      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <span><?= $skill['skill_name'] ?? 'Skill'; ?></span>
          <span><?= $skill['level'] ?? 0; ?>%</span>
        </div>
        <div class="progress">
          <div class="progress-bar bg-success"
               style="width:<?= $skill['level'] ?? 0; ?>%">
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Tidak ada data skill</p>
  <?php endif; ?>
</div>

<!-- CERTIFICATES -->
<section id="certificates" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center">Certificates</h2>

    <div class="row mt-5">
      <?php if(mysqli_num_rows($certificates) > 0): ?>
        <?php while($cert = mysqli_fetch_assoc($certificates)) : ?>
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
             <img src="assets/img/<?= $cert['image'] ?? 'default.png'; ?>">
              <div class="card-body">
                <h5><?= $cert['title']; ?></h5>
                <p class="text-muted"><?= $cert['year']; ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center">Tidak ada sertifikat</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-3">
  <p>© <?= date("Y"); ?> <?= $profile['name'] ?? ''; ?></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>